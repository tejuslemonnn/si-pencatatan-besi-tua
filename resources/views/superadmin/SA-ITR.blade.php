@extends('sb-admin/app')
@section('title', 'Interwarehouse Transfer Request')
    
@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Interwarehouse Transfer Request</h1>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<table class="table">
    <thead>
        <tr>
            <th>Refrence</th>
            <th>Source Warehouse</th>
            <th>Destination Warehouse</th>
            <th>Date</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
       {{--  @foreach($users as $user) --}}
        <tr>
            <td>ITR/01</td>
            <td>Main Warehouse</td>
            <td>Warehouse2</td>
            <td>12/12/2023</td>
            <td><button type="submit" class="btn btn-warning ">Waitting Approval</button>
                <button type="submit" class="btn btn-success ">Approval</button>
            </td>
            <td>
                <a href= "/view-ITR" class="btn btn-info">Detail</a>
            </td>
        </tr>
      {{--  @endforeach --}}
    </tbody>
</table>
@endsection