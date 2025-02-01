@extends('sb-admin/app')
@section('title', 'Data Kapal')

@section('content')

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

        <div class="col-md-2 col-12 mb-4">
            <label for="to_date">End Date<span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="max" name="max">
        </div>

        <div class="overflow-x-auto">
            <table id="example" class="table table-bordered display nowrap">
                <thead>
                    <tr>
                        <th class="text-center" style="vertical-align: middle;">NO</th>
                        <th class="text-center" style="vertical-align: middle;">NAMA</th>
                        <th class="text-center" style="vertical-align: middle;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($data as $row)
                        <tr>
                            <td>{{ ($data->currentPage() - 1) * $data->perPage() + $loop->iteration }}</td>
                            <td>{{ $row->nama }}</td>

                            {{-- @if ($row->status == 0)
                    <td><button type="submit" class="btn btn-warning text-white">Waitting Approval</button>
                    </td>
                    @else
                    <td><button type="submit" class="btn btn-success text-white">Approval</button></td>
                    @endif --}}
                            <td>
                                <a href="{{ route('perusahaan.show', ['perusahaan' => $row->id]) }}" class="btn btn-info"><i
                                        class="fas fa-eye"></i>
                                    Detail</a>

                                @if (auth()->user()->role == 'admin_perusahaan' && $row->status != 1)
                                    <a href="{{ route('perusahaan.edit', ['perusahaan' => $row->id]) }}"
                                        class="btn btn-warning"><i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('perusahaan.destroy', ['perusahaan' => $row->id]) }}"
                                        method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">
                                            <i class="fas fa-trash"></i>
                                            Delete</button>
                                    </form>
                                @elseif($row->status == 0 && auth()->user()->role == 'kepala_perusahaan')
                                    {{-- <form action="{{ route('approveITR', ['id' => $row->id]) }}" method="POST"
                        style="display: inline-block;">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-success">Approve</button>
                        </form> --}}
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{ $data->links() }}

    </div>
@endsection
