<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Stock Count</title>
</head>

<body>

    <div class="form-group row col-md-10">
        <label class="col-sm-2 col-form-label" style=" font-weight: bold;">Stock Count No :</label>
        <div class="col-sm-4">
            <p style="margin-top: 6px; "> {{ $stockcount->sc_no }}</p>
        </div>
    </div>

    <div class="form-group row col-md-10">
        <label class="col-sm-2 col-form-label" style=" font-weight: bold;">Inventory Refrence :</label>
        <div class="col-sm-4">
            <p style="margin-top: 6px; "> {{ $stockcount->inventory }}</p>
        </div>
    </div>

    <div class="form-group row col-md-10">
        <label class="col-sm-2 col-form-label" style=" font-weight: bold;">Warehouse :</label>
        <div class="col-sm-4">
            <p style="margin-top: 6px; "> {{ $stockcount->stockWarehouse->name }}</p>
        </div>
    </div>

    <div class="portlet-body">

        <form action="#" method="POST">
            <table style="border-collapse: collapse; width: 100%;" border="1">
                <thead>
                    <tr>
                        <th width="5%">No.</th>
                        <th>Product</th>
                        <th>Description</th>
                        <th>QTY</th>
                    </tr>
                </thead>
                <tbody>
                <tbody>
                    @foreach ($stockcount->detailstockcount as $index => $detailstockcount)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $detailstockcount->productStockCount->name }}</td>
                            <td>{{ $detailstockcount->description }}</td>
                            <td>{{ $detailstockcount->qty }}</td>
                        </tr>
                    @endforeach
                </tbody>
                </tbody>
            </table>
        </form>
        <!-- END Datatable -->
    </div>

    <hr>


    <!-- Signatures at Bottom Left and Bottom Right -->
    <div style="position: fixed; bottom: 20px; left: 20px;">
        <p>_________________________</p>
        <p>Prepared By</p>
    </div>

    <div style="position: fixed; bottom: 20px; right: 20px;">
        <p>_________________________</p>
        <p>Approved By</p>
    </div>
    <!-- End Signatures -->
</body>

</html>
