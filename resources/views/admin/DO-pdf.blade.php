<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Interwarehouse Transfer Request</title>
</head>

<body>

    <div class="form-group row col-md-10">
        <label class="col-sm-2 col-form-label" style=" font-weight: bold;">DO No :</label>
        <div class="col-sm-4">
            <p style="margin-top: 6px; "> {{ $DO->do_no }}
            </p>
        </div>
    </div>

    <div class="form-group row col-md-10">
        <label class="col-sm-2 col-form-label" style=" font-weight: bold;">Source Warehouse :</label>
        <div class="col-sm-4">
            <p style="margin-top: 6px; "> {{ $DO->sourceWarehouse->name }}
            </p>
        </div>
    </div>

    <div class="form-group row col-md-10">
        <label class="col-sm-2 col-form-label" style=" font-weight: bold;">Destination Warehouse :</label>
        <div class="col-sm-4">
            <p style="margin-top: 6px; "> {{ $DO->destinationWarehouse->name }}
            </p>
        </div>
    </div>

    <div class="form-group row col-md-10">
        <label class="col-sm-2 col-form-label" style=" font-weight: bold;">Schedule Date :</label>
        <div class="col-sm-4">
            <p style="margin-top: 6px; "> {{ $DO->created_date }}</p>
        </div>
    </div>

    <div class="form-group row col-md-10">
        <label class="col-sm-2 col-form-label" style=" font-weight: bold;">Expiry Date :</label>
        <div class="col-sm-4">
            <p style="margin-top: 6px; "> {{ $DO->delivery_date }}</p>
        </div>
    </div>

    <hr>

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
                    @foreach ($DO->DetailDO as $index => $detailDO)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                @foreach ($products as $product)
                                    @if ($product->id == $detailDO->product)
                                        {{ $product->name }}
                                    @break
                                @endif
                    @endforeach
                    </td>
                    <td>{{ $detailDO->description }}</td>
                    <td>{{ $detailDO->qty }}</td>
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
