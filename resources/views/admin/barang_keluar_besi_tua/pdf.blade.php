<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Barang Keluar Besi Tua</title>
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
        <h2>Surat Barang Keluar Besi Tua</h2>
    </div>

    <table class="info-table">
        <tr>
            <td style="text-align: left"><strong>Kode:</strong> {{$data->kode}}</td>
            <td style="text-align: right"><strong>Tanggal Surat:</strong> {{ date('d F Y') }}</td>
        </tr>
        <tr>
            <td style="text-align: left"><strong>Penerima:</strong> {{$data->perusahaan->nama}}</td>
        </tr>
    </table>

    <table>
        <tr>
            <th rowspan="2">Kapal</th>
            <th rowspan="2">Nama Barang</th>
            <th colspan="3">Timbangan SB (Kg)</th>
            <th rowspan="2">Harga</th>
            <th rowspan="2">Total</th>
        </tr>
        <tr>
            <th>Bruto</th>
            <th>Tara</th>
            <th>Netto</th>
        </tr>
        <tr>
            <td>{{$data->dataKapal->nama_kapal}}</td>
            <td>{{$data->produk->nama}}</td>
            <td>{{$data->bruto}}</td>
            <td>{{$data->tara}}</td>
            <td>{{$data->netto}}</td>
            <td>Rp.{{number_format($data->produk->harga, 0, ',', '.')}}</td>
            <td>Rp.{{number_format($data->jumlah_harga, 0, ',', '.')}}</td>
        </tr>
    </table>

    <p>Catatan: Harap dilakukan pengecekan kembali sebelum diterima.</p>

    <table class="signature-table">
        <tr>
            <td>_________________________<br><strong>Pengirim</strong><br>CV. Java Metalindo</td>
            <td>_________________________<br><strong>Penerima</strong><br>{{$data->perusahaan->nama}}</td>
        </tr>
    </table>

</body>
</html>
