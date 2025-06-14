@extends('sb-admin/app')
@section('title', 'Delivery Order')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Delivery Order</h1>

    @if (auth()->user()->role != 'admin_pengajuan')
        <div class="my-3">
            <a href="/create-DO" class="btn btn-secondary"><i class="fas fa-plus"></i> Create</a>
        </div>
    @endif


    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row my-2">
        <div class="col-md-2 col-12">
            <label for="from_date">Start Delivery Date<span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="min" name="min">
        </div>

        <div class="col-md-2 col-12">
            <label for="to_date">End Delivery Date<span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="max" name="max">
        </div>
    </div>

    <table id="example" class="table table-striped display nowrap">
        <thead>
            <tr>
                <th>No</th>
                <th>DO No.</th>
                <th>Source Warehouse</th>
                <th>Delivery Date</th>
                <th>To Warehouse</th>
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
                        {{ $row->do_no }}
                    </td>
                    <td>
                        {{ $row->sourceWarehouse->name }}
                    </td>
                    <td>{{ $row->delivery_date }}</td>
                    <td>
                        {{ $row->destinationWarehouse->name }}
                    </td>
                    @if ($row->status === 0)
                        <td><button type="submit" class="btn btn-warning text-white">Waitting Approval</button></td>
                    @else
                        <td><button type="submit" class="btn btn-success text-white">Approval</button></td>
                    @endif
                    <td>
                        <a href= "{{ route('viewDO', ['id' => $row->id]) }}" class="btn btn-info"><i class="fas fa-eye"></i>
                            Detail</a>

                        @if (auth()->user()->role != 'admin_pengajuan' && $row->status != 1)
                            <a href="{{ route('editDO', ['id' => $row->id]) }}" class="btn btn-primary"><i
                                    class="fa-regular fa-pen-to-square"></i> Ubah</a>
                            <form action="{{ route('destroyDO', ['id' => $row->id]) }}" method="GET"
                                style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"><i class="fas fa-solid fa-trash"></i>
                                    Hapus</button>
                            </form>
                        @elseif($row->status === 0 && auth()->user()->role == 'admin_pengajuan')
                            <form action="{{ route('approveDO', ['id' => $row->id]) }}" method="POST"
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
