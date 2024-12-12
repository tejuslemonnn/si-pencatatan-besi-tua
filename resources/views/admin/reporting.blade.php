@extends('sb-admin/app')
@section('title', 'Interwarehouse Transfer Request')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Reporting</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row my-2">
        <div class="col-md-2 col-12">
            <label for="from_date">Start Date<span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="min" name="min">
        </div>

        <div class="col-md-2 col-12">
            <label for="to_date">End Date<span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="max" name="max">
        </div>

        <table id="example" class="table table-striped display nowrap">
            <thead>
                <tr>
                    <th>No</th>
                    <th>ITR No</th>
                    <th>Source Warehouse</th>
                    <th>Date</th>
                    <th>Destination Warehouse</th>
                    <th>Product</th>
                    <th>Current QTY</th>
                    <th>In QTY</th>
                    <th>Out QTY</th>
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
                            {{ optional($row->itr)->itr_no }}
                        </td>
                        <td>
                            {{ $row->warehouse->name }}
                        </td>
                        <td>{{ $row->created_at->format('Y-m-d') }}</td>
                        <td>
                            {{ $row->fromWarehouse->name }}
                        </td>
                        <td>
                            {{ $row->product_name }}
                        </td>
                        <td>
                            {{ $row->current_qty }}
                        </td>
                        @if ($row->warehouse_id == auth()->user()->id)
                            <td class="text-success">
                                +{{ $row->in_qty }}
                            </td>
                            <td class="text-danger">
                                -{{ $row->out_qty }}
                            </td>
                        @endif

                        @if ($row->from_warehouse_id == auth()->user()->id)
                            <td class="text-success">
                                +{{ $row->out_qty }}
                            </td>
                            <td class="text-danger">
                                -{{ $row->in_qty }}
                            </td>
                        @endif
                        <td>
                            <a href="/view-ITR/{{ $row->itr_id }}" class="btn btn-info">Detail</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $data->links() }}

    @endsection
