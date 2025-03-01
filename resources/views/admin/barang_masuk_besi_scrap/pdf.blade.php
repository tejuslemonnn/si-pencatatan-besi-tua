<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Barang Masuk Besi Scrap</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 50px;
        }
        .header img {
            width: 100px;
            height: auto;
        }
        .info-table {
            width: 100%;
            margin-bottom: 40px;
        }
        .info-table td {
            border: none;
            padding: 5px;
            font-size: 12px;
        }
        .info-table td:first-child {
            width: 50%;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            margin-bottom: 30px;
        }
        th, td {
            border: 1px solid black;
            padding: 5px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        .signature-table {
            width: 100%;
            margin-top: 80px;
        }
        .signature-table td {
            border: none;
            text-align: center;
            padding-top: 40px;
        }
        .signature-table td:first-child {
            width: 50%;
        }
    </style>
</head>
<body>

    <div class="header">
        <h2>Surat Barang Masuk Besi Scrap</h2>
    </div>

    <table class="info-table">
        <tr>
            <td style="text-align: left"><strong>Kode:</strong> {{$data->kode}}</td>
            <td style="text-align: right"><strong>Tanggal Surat:</strong> {{ date('d F Y') }}</td>
        </tr>
        <tr>
            <td style="text-align: left"><strong>Penerima:</strong> CV. Java Metalindo</td>
        </tr>
    </table>

    <table>
        <tr>
            <th rowspan="2">Kapal</th>
            <th colspan="3">Timbangan SB (Kg)</th>
            <th colspan="3">Timbangan Pabrik (Kg)</th>
            <th rowspan="2">Netto Bersih (Kg)</th>
        </tr>
        <tr>
            <th>Bruto</th>
            <th>Tara</th>
            <th>Netto</th>
            <th>Bruto</th>
            <th>Tara</th>
            <th>Netto</th>
        </tr>
        <tr>
            <td>{{$data->dataKapal->nama_kapal}}</td>
            <td>{{$data->bruto_sb}}</td>
            <td>{{$data->tara_sb}}</td>
            <td>{{$data->netto_sb}}</td>
            <td>{{$data->bruto_pabrik}}</td>
            <td>{{$data->tara_pabrik}}</td>
            <td>{{$data->netto_pabrik}}</td>
            <td>{{$data->netto_bersih}}</td>
        </tr>
    </table>

    <p>Catatan: Harap dilakukan pengecekan kembali sebelum diterima.</p>

    <table class="signature-table">
        <tr>
            <td></td>
            <td>_________________________<br><strong>Penerima</strong><br>CV. Java Metalindo</td>
        </tr>
    </table>

</body>
</html>
