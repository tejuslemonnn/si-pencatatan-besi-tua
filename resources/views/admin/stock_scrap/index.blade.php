@extends('sb-admin/app')
@section('title', 'Data Kapal')

@section('content')

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row my-2">
        {{-- <div class="col-md-2 col-12">
            <label for="from_date">Tanggal Mulai<span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="min" name="min">
        </div>

        <div class="col-md-2 col-12 mb-4">
            <label for="to_date">Tanggal Selesai<span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="max" name="max">
        </div> --}}

        <div class="overflow-x-auto">

            <table id="example" class="table table-bordered display nowrap">
                <thead>
                    <tr>
                        <th rowspan="2" class="text-center" style="vertical-align: middle;">TOTAL TIMBANGAN SB</th>
                        <th rowspan="2" class="text-center" style="vertical-align: middle;">TOTAL TIMBANGAN PABRIK</th>
                        <th rowspan="2" class="text-center" style="vertical-align: middle;">TOTAL TIMBANGAN NETTO</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($data as $row)
                        <tr>
                            {{-- <td>{{ ($data->currentPage() - 1) * $data->perPage() + $loop->iteration }}</td> --}}
                            <td>{{ $row->sb_total }}</td>
                            <td>{{ $row->pabrik_total }}</td>
                            <td>{{ $row->netto_total }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{ $data->links() }}

    </div>
@endsection
