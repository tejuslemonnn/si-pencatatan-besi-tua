@extends('sb-admin/app')
@section('title', 'Material Request')
    
@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Material Request</h1>

    @if ( auth()->user()->role != "admin_pengajuan")
    <div class="mt-3">
        <a href="/create-material" class="btn btn-secondary"><i class="fas fa-plus"></i> Create</a>
    </div>
    @endif
    

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<div class="row my-2">
    <div class="col-md-2 col-12">
        <label for="from_date">Start Expired Date<span class="text-danger">*</span></label>
        <input type="text" class="form-control" id="min" name="min">
    </div>

    <div class="col-md-2 col-12">
        <label for="to_date">End Expired Date<span class="text-danger">*</span></label>
        <input type="text" class="form-control" id="max" name="max">
    </div>

</div>

<table id="example" class="table table-striped display nowrap">
    <thead>
        <tr>
            <th>No</th>
            <th>Material No</th>
            <th>Date</th>
            <th>Expired</th>
            <th>Request By</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody> 
@php
   $no = 1;
@endphp
        @foreach($data as $row)
        <tr>
            <td>{{ ($data->currentPage() - 1) * $data->perPage() + $loop->iteration }}</td>
            <td>{{ $row->material_no }}</td>
            <td>{{ $row->schedule }}</td>
            <td>{{ $row->expired }}</td>
            <td>{{ $row->requestMaterial->name }}</td>
            @if ($row->status == 0)
                <td><button type="submit" class="btn btn-warning text-white">Waitting Approval</button></td>
            @else
                <td><button type="submit" class="btn btn-success text-white">Approval</button></td>
            @endif
             
            <td>
                <a href= "/view-material/{{ $row->id }}" class="btn btn-info"><i class="fas fa-eye"></i> Detail</a>
                @if ( auth()->user()->role != "admin_pengajuan" && $row->status != 1)
                <a href="{{ route('updateIndexMaterial', ['materialId' => $row->id]) }}" method="GET" class="btn btn-primary"><i class="fa-regular fa-pen-to-square"></i> Ubah</a>
                <form action="/delete-material/{{ $row->id }}" method="GET" style="display: inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger"><i class="fas fa-solid fa-trash"></i> Hapus</button>
                </form>
                @elseif($row->status == 0 && auth()->user()->role == "admin_pengajuan")
                    <form action="{{  route('approveMaterial', [ 'id' => $row->id ]) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-success">Approve</button>
                    </form>
                @endif
            </td>
        </tr>
         
       @endforeach
    </tbody>
</table>


{{ $data->links() }}

@endsection