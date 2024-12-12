<?php

namespace App\Http\Controllers;

use App\Models\ProductModel;
use Illuminate\Http\Request;
use App\Models\DetailMaterialModel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        return view('admin.product', [
            'title' => 'product',
            'active' => 'product',
            'data' => ProductModel::where('user_id', auth()->user()->id)->orderBy("created_at", "desc")->paginate(9)
        ]);
    }

    public function indexcreate()
    {
        return view('admin/create-product');
    }

    public function store(Request $req)
    {
        $validateData = $req->validate([
            "name" => "required",
            "code" => "required",
            "image" => "required|image",
            "price" => "required",
            "qty" => "nullable",
            "description" => "nullable",
        ]);

        $productData = [
            'user_id' => auth()->user()->id,
            "name" => $validateData['name'],
            "code" => $validateData['code'],
            "image" => $validateData['image'],
            "price" => $validateData["price"],
            "qty" => $validateData["qty"],
            "description" => $validateData["description"]
        ];

        if ($req->hasFile('image')) {
            $imagePath = $req->file('image')->store('public/product-img');
            $filename = basename($imagePath);
            $productData['image'] = $filename;
        }

        $product = ProductModel::create($productData);
        return redirect('/product');
    }

public function detailproduct($productId)
{
    $product = ProductModel::where('id', $productId)->first();

    return view('admin/view-product', [
        'product' => $product,
    ]);
}

 public function destroyproduct($id)
 {
     $product = ProductModel::find($id);
 
     if ($product) {
         $product->delete();
     } else {
         // Tangani jika data tidak ditemukan
     }
 
     return redirect('/product');
 }

 public function edit($id)
 {
     $product = ProductModel::where('id', $id)->first();
    
     return view('admin/edit-product', [
         'product' => $product,
     ]);
 }
 public function update($id, Request $req)
 {
     $validateData = $req->validate([
         "name" => "required",
         "code" => "required",
         "price" => "required",
         "qty" => "nullable",
         "description" => "nullable",
     ]);

     $product = ProductModel::findOrFail($id);

     if ($req->hasFile('image')) {
         $imagePath = $req->file('image')->store('public/product-img');
         $filename = basename($imagePath);
         $validateData['image'] = $filename;

         if ($product->image && Storage::exists('public/product-img/'.$product->image)) {
             Storage::delete('public/product-img/'.$product->image);
         }
     }
    
     $product->update($validateData);

     return redirect('/product')->with('success', 'ITR updated successfully.');
 }
}
