<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Material Request</title>
</head>

<body>
    <div style="margin-top: 20px;">
        <div style="font-weight: bold; margin-bottom: 10px;">Material No:</div>
        <div style="margin-top: 6px;">{{ $material->material_no }}</div>
    </div>

    <div style="margin-top: 20px;">
        <div style="font-weight: bold; margin-bottom: 10px;">Request By:</div>
        <div style="margin-top: 6px;">{{ $material->requestMaterial->name }}</div>
    </div>

    <div style="margin-top: 20px;">
        <div style="font-weight: bold; margin-bottom: 10px;">Destination Refrence:</div>
        <div style="margin-top: 6px;">{{ $material->destinationWarehouse->name }}</div>
    </div>

    <div style="margin-top: 20px;">
        <div style="font-weight: bold; margin-bottom: 10px;">Schedule Date:</div>
        <div style="margin-top: 6px;">{{ $material->schedule }}</div>
    </div>

    <div style="margin-top: 20px;">
        <div style="font-weight: bold; margin-bottom: 10px;">Expiry Date:</div>
        <div style="margin-top: 6px;">{{ $material->expired }}</div>
    </div>

    <hr style="margin-top: 20px;">

    <div style="margin-top: 20px;">
        <table style="border-collapse: collapse; width: 100%;" border="1">
            <thead>
                <tr>
                    <th style="width: 5%; text-align: center;">No.</th>
                    <th style="text-align: center;">Product</th>
                    <th style="text-align: center;">QTY</th>
                    <th style="text-align: center;">Description</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($detailmaterials as $index => $row)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $row->product }}</td>
                        <td>{{ $row->qty }}</td>
                        <td>{{ $row->description }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
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
