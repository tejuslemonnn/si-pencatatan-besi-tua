@extends('sb-admin/app')
@section('title', 'Expired Draft')
    
@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Expired Material</h1>

    {{-- @if ( auth()->user()->role != "admin_pengajuan")
    <div class="mt-3">
        <a href="#" class="btn btn-secondary">Create</a>
    </div>
    @endif --}}
    

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<table class="table">
    <thead>
        <tr>
            <th>No</th>
            <th>Date</th>
            <th>Expired</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    @php
    $no = 1;
    @endphp
            @foreach ($data as $index => $row)
            <tr>
                <td>{{ $index+1 }}</td>
                <td>{{ $row->schedule }}</td>
                <td>{{ $row->expired }}</td>
                <td><button class="btn btn-danger text-white">Expired</button></td>
                <td>
                    <a href= "/view-material/{{ $row->id }}" class="btn btn-info">Detail</a> 
                    <button class="btn btn-success" data-toggle="modal" data-target="#exampleModal">Active</button> 
                </td>
                </tr>
            @endforeach
    </tbody>
</table>

{{ $data->links() }}

{{-- modal --}}
@if (count($data) != 0)
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('activeMaterial', ['id' => $row->id]) }}" method="post">
          @csrf
          @method('PUT')
          <div class="modal-body">
              <div class="form-group">
                  <label for="expired">Expiry Date</label>
                  <input type="date" class="form-control" id="expired" name="expired" value="{{ $row->expired }}" required min="{{ date('Y-m-d') }}">
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
      </form>
    </div>
  </div>
</div>
@endif

@endsection