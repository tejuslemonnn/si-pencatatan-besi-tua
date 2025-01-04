<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Events\MaterialEvent;
use App\Models\MaterialModel;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\DetailMaterialModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use App\Notifications\MaterialNotification;
use Illuminate\Validation\ValidationException;

class MaterialController extends Controller
{
    protected $MaterialModel;

    public function __construct()
    {
        $MaterialModel = new MaterialModel();
    }

    public function index()
    {
        return view('admin.materialreq', [
            'title' => 'material request',
            'active' => 'material request',
            'data' =>  $query = auth()->user()->role == "admin_pengajuan" ?
            MaterialModel::where(function ($query) {
                $query->where('expired', '>', date("Y-m-d"))
                    ->orWhereNull('expired');
            })->orderBy("created_at", "desc")->paginate(10) :
            MaterialModel::where('user_id', auth()->user()->id)
            ->where(function ($query) {
                $query->where('expired', '>', date("Y-m-d"))
                    ->orWhereNull('expired');
            })->orderBy("created_at", "desc")->paginate(10)
        ]);
    }

    public function indexcreate()
    {
        return view('admin.create-material', [
            'title' => 'creatematerial request',
            'active' => 'create material request',
            'warehouses' => User::where('role', '!=', "admin_pengajuan")->get()
        ]);
    }


    public function store(Request $req)
    {
        try {
            $validateData = $req->validate([
                "material_no" => "required|unique:materialreqs",
                "request" => "required",
                "destination" => "required",
                "product.*" => "required",
                "qty.*" => "required",
                "schedule" => "required",
                "expired" => "required",
                "description.*" => "nullable",
            ]);
            $validateData['status'] = false;
            $materialReqData = [
                'material_no' => "M-$validateData[material_no]",
                'user_id' => auth()->user()->id,
                'request' => $validateData['request'],
                'destination' => $validateData['destination'],
                'schedule' => $validateData['schedule'],
                'expired' => $validateData['expired'],
                'status' => $validateData['status'],
            ];
    
            if ($req->product == null) {
                return redirect()->back()->with('error', 'Required Item!')->withInput();
            }
    
            $material = MaterialModel::create($materialReqData);
    
            foreach ($req->product as $key => $product) {
                $detailmaterial = [
                    'material_id' => $material->getOriginal()['id'],
                    'product' => $req->product[$key],
                    'qty' => $req->qty[$key],
                    'description' => $req->description[$key],
                ];
                DetailMaterialModel::create($detailmaterial);
    
                $admins = User::where('role', 'admin_pengajuan')
                    ->get();
    
                $usersource = User::where('id', $material->getOriginal()['request'])->first();
    
                foreach ($admins as $key => $admin) {
                    $admin->notify(new MaterialNotification($usersource, "Material Required Approve!"));
                    event(new MaterialEvent($admin->id, auth()->user()->name, "Material Required Approve!"));
                }
            }
            return redirect('/materialreq');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (QueryException $e) {
            if ($e->errorInfo[1] === 1062) {
                return redirect()->back()->with('error', 'Material Number already exists.')->withInput();
            }
            return redirect()->back()->with('error', 'Database error.')->withInput();
        }
    }

    public function detailmaterial($materialId)
    {
        $material = MaterialModel::where('id', $materialId)->with('detailMaterial')->first();
        $detailMaterials = $material->detailMaterial;

        return view('admin/view-material', [
            'material' => $material,
            'detail_material' => $detailMaterials
        ]);
    }

    public function destroymaterial($id)
    {
        $material = MaterialModel::find($id);
        $detailmaterial = DetailMaterialModel::where('material_id', $id);

        if ($material) {
            $material->delete();
            $detailmaterial->delete();
        } else {
            // Tangani jika data tidak ditemukan
        }

        return redirect('/materialreq');
    }

    public function edit($id)
    {
        $material = MaterialModel::with('requestMaterial')->find($id);
        $detailmaterials = DetailMaterialModel::where('material_id', $id)->get();
        $warehouses = User::where('id', '<>', auth()->user()->id)->get();
        return view('admin/edit-material', compact('material', 'detailmaterials', 'warehouses'));
    }

    public function update(Request $req, $id)
    {
        $validateData = $req->validate([
            "request" => "required",
            "destination" => "required",
            "schedule" => "required",
            "expired" => "required",
            "product.*" => "required",
            "qty.*" => "required",
            "description.*" => "nullable",
        ]);




        $material = MaterialModel::findOrFail($id);

        if ($req->product == null) {
            return redirect()->back()->with('error', 'Required Item!')->withInput();
        }

        $materialReqData = [
            'request' => $validateData['request'],
            'destination' => $validateData['destination'],
            'schedule' => $validateData['schedule'],
            'expired' => $validateData['expired'],
        ];

        // Create new detail materials
        DetailMaterialModel::where('material_id', $id)->delete();

        foreach ($req->product as $key => $product) {
            $detailmaterialReq = [
                'material_id' => $material->id,
                'product' => $product,
                'qty' => $req->qty[$key],
                'description' => $req->description[$key],
            ];
            DetailMaterialModel::create($detailmaterialReq);
        }

        $material->update($materialReqData);
        $material->save();

        // Optionally, you can redirect or return a response after the update
        return redirect('/materialreq')->with('success', 'Material updated successfully.');
    }

    public function approve($id)
    {
        $material = MaterialModel::find($id);
        $material->status = 1;
        $material->expired = null;
        $material->save();

        $usersource = User::where('id', $material->request)->first();
        $userDestination = User::where('id', $material->destination)->first();

        // warehouse source notif
        $usersource->notify(new MaterialNotification($usersource, "Material Request Approved!"));
        event(new MaterialEvent($usersource->id, $usersource->name, "Material Request Approved!"));

        // warehouse destination notif
        $userDestination->notify(new MaterialNotification($usersource, "Material Request!"));
        event(new MaterialEvent($userDestination->id, $usersource->name, "Material Request!"));

        return redirect('/materialreq')->with('success', 'Material Request Approved!');
    }

    public function generatepdf($id)
    {
        $material = MaterialModel::find($id);
        $detailmaterials = DetailMaterialModel::where('material_id', $id)->get();
        $data = ['material' => $material, 'detailmaterials' => $detailmaterials];

        $pdf = PDF::loadView('admin.material-pdf', $data);
        return $pdf->download('material_' . $material->material_no . '.pdf');

    }
}

