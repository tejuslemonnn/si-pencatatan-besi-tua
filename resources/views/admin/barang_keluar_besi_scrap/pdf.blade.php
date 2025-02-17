<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Barang Masuk Besi Scrap</title>
</head>

<body>
    <h3 style="text-align: center;">Barang Masuk Besi Scrap</h3>

    <div style="margin-top: 20px;">
        <div style="font-weight: bold; margin-bottom: 10px;">Kode:
            <div style="margin-top: 6px;">{{ $data->kode }}</div>
        </div>

        <div style="margin-top: 20px;">
            <div style="font-weight: bold; margin-bottom: 10px;">Tanggal:</div>
            <div style="margin-top: 6px;">{{ $data->tanggal }}</div>
        </div>

        <div style="margin-top: 20px;">
            <div style="font-weight: bold; margin-bottom: 10px;">Kapal:</div>
            <div style="margin-top: 6px;">{{ $data->dataKapal->nama_kapal }}</div>
        </div>

        {{-- <div style="margin-top: 20px;">
            <div style="font-weight: bold; margin-bottom: 10px;">Nama Barang:</div>
            <div style="margin-top: 6px;">{{ $data->produk->nama }}</div>
        </div> --}}
        <div style="margin-top: 20px">
            <div style="font-weight: bold; margin-bottom: 10px;">Timbangan SB</div>
        </div>

        <div style="margin-top: 20px;">
            <div style="font-weight: bold; margin-bottom: 10px;">Bruto SB</div>
            <div style="margin-top: 6px;">{{ $data->bruto_sb }}</div>
        </div>

        <div style="margin-top: 20px;">
            <div style="font-weight: bold; margin-bottom: 10px;">Tara SB</div>
            <div style="margin-top: 6px;">{{ $data->tara_sb }}</div>
        </div>

        <div style="margin-top: 20px;">
            <div style="font-weight: bold; margin-bottom: 10px;">Netto SB</div>
            <div style="margin-top: 6px;">{{ $data->netto_sb }}</div>
        </div>

        <div style="margin-top: 20px">
            <div style="font-weight: bold; margin-bottom: 10px;">Timbangan Pabrik</div>
        </div>

        <div style="margin-top: 20px;">
            <div style="font-weight: bold; margin-bottom: 10px;">Bruto Pabrik</div>
            <div style="margin-top: 6px;">{{ $data->bruto_pabrik }}</div>
        </div>

        <div style="margin-top: 20px;">
            <div style="font-weight: bold; margin-bottom: 10px;">Tara Pabrik</div>
            <div style="margin-top: 6px;">{{ $data->tara_pabrik }}</div>
        </div>

        <div style="margin-top: 20px;">
            <div style="font-weight: bold; margin-bottom: 10px;">Netto Pabrik</div>
            <div style="margin-top: 6px;">{{ $data->netto_pabrik }}</div>
        </div>
        <div style="margin-top: 20px;">
            <div style="font-weight: bold; margin-bottom: 10px;">Potongan</div>
            <div style="margin-top: 6px;">{{ $data->pot }}</div>
        </div>
        <div style="margin-top: 20px;">
            <div style="font-weight: bold; margin-bottom: 10px;">Netto Bersih</div>
            <div style="margin-top: 6px;">{{ $data->netto_bersih }}</div>
        </div>

        <div style="margin-top: 20px;">
            <div style="font-weight: bold; margin-bottom: 10px;">Harga</div>
            <div style="margin-top: 6px;">Rp. {{number_format($data->harga, 0, ',', '.')}}</div>
        </div>

        <div style="margin-top: 20px;">
            <div style="font-weight: bold; margin-bottom: 10px;">Total</div>
            <div style="margin-top: 6px;">Rp. {{ number_format($data->jumlah_harga, 0, ',', '.') }}</div>
        </div>
        
        <div style="margin-top: 20px;">
            <div style="font-weight: bold; margin-bottom: 10px;">Perusahaan</div>
            <div style="margin-top: 6px;">{{ $data->perusahaan->nama }}</div>
        </div>

        <hr style="margin-top: 20px;">

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
