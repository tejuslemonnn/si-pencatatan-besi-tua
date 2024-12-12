@extends('sb-admin/app')
@section('title', 'Interwarehouse Transfer Request')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Interwarehouse Transfer Request</h1>

    @if (auth()->user()->role != 'admin_pengajuan')
        <div class="my-3">
            <a href="/create-ITR" class="btn btn-secondary"><i class="fas fa-plus"></i> Create</a>
        </div>
    @endif

    @if (session('success'))
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

        <table id="example" class="table table-striped display nowrap">
            <thead>
                <tr>
                    <th>No</th>
                    <th>ITR No</th>
                    <th>Date</th>
                    <th>Expired</th>
                    <th>Source Warehouse</th>
                    <th>Destination Warehouse</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;
                @endphp
                @foreach ($data as $row)
                    <tr>
                        <td>{{ ($data->currentPage() - 1) * $data->perPage() + $loop->iteration }}</td>
                        <td>
                            {{ $row->itr_no }}
                        </td>
                        <td>{{ $row->schedule }}</td>
                        <td>{{ $row->expired }}</td>
                        <td>
                            {{ $row->sourceWarehouse->name }}
                        </td>
                        <td>
                            {{ $row->destinationWarehouse->name }}
                        </td>
                        
                        @if ($row->status == 0)
                            <td><button type="submit" class="btn btn-warning text-white">Waitting Approval</button></td>
                        @else
                            <td><button type="submit" class="btn btn-success text-white">Approval</button></td>
                        @endif
                        <td>
                            <a href="/view-ITR/{{ $row->id }}" class="btn btn-info"><i class="fas fa-eye"></i> Detail</a>

                            @if (auth()->user()->role != 'admin_pengajuan' && $row->status != 1)
                                <a href="/edit-ITR/{{ $row->id }}" class="btn btn-primary"><i class="fa-regular fa-pen-to-square"></i> Edit</a>
                                <form action="/delete-ITR/{{ $row->id }}" method="GET" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"><i class="fas fa-solid fa-trash"></i> Delete</button>
                                </form>
                            @elseif($row->status == 0 && auth()->user()->role == 'admin_pengajuan')
                                <form action="{{ route('approveITR', ['id' => $row->id]) }}" method="POST"
                                    style="display: inline-block;">
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
