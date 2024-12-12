@extends('sb-admin/app')
@section('title', 'Report')
    
@section('content')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Reporting</h1>

<hr>
<h5 class="mb-4 text-gray-800">Product Report Data</h5>

<div class="portlet-body">
    <form action="##" method="POST" target="_blank">
        <div class="row">
            <input type="hidden" name="_token" value="ubqZkGbnjpavuprrvwSNL4pQCVGqhb35tq3Gn5a6">          
            <div class="col-md-2 col-12">
                <label for="from_date">Start Date<span class="text-danger">*</span></label>
                <input type="date" class="form-control "
                    id="from_date" name="from_date" placeholder="Masukkan Tanggal DO"
                    value="2023-05-03">
                                                </div>

            <div class="col-md-2 col-12">
                <label for="to_date">End Date<span class="text-danger">*</span></label>
                <input type="date" class="form-control "
                    id="to_date" name="to_date" placeholder="Masukkan Tanggal Delivery"
                    value="2023-05-03">
                                                </div>
            <div class="col-md-2 col-12">
                <label for="">Filter</label><br>
                <button type="button" class="btn btn-secondary" name="filter"
                    id="filter">Submit</button>
                <button type="button" class="btn btn-warning" name="refresh"
                    id="refresh">Refresh</button>
            </div>
            <div class="col-md-2 col-12">
                <label for="">Export</label><br>               
                <button type="submit" class="btn btn-danger" name="action" value="pdf"
                    id="pdf">PDF</button>
            </div>
        </div>
    </form>
    <hr>
    <!-- BEGIN Datatable -->
    <table id="datatable" class="table table-bordered table-striped table-hover">
        <thead>
            <tr>
                <th width="5%">No.</th>
                <th>Product</th>
                <th>QTY</th>
                <th>Source Warehouse</th>
                <th>Destination Warehouse</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
</div>
@endsection