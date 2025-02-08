@extends('sb-admin/app')
@section('title', 'Edit Data Kapal')

@section('content')
    <!-- Page Heading -->
    <form action="{{ route('data-kapal.update', ['data_kapal' => $dataKapal->id]) }}" method="POST" id="add_form">
        @csrf
        @method('PUT')
        <button type="submit" class="btn btn-primary d-none" id="submit_button">Submit</button>

        @if (session('error'))
            <div class="alert alert-danger mt-3">
                {{ session('error') }}
            </div>
        @endif
        <hr>

        <div class="form-group col-12">
            <label for="nama_kapal">Nama Kapal</label>
            <input type="text" name="nama_kapal" class="form-control" placeholder="Nama Kapal"
                value="{{ $dataKapal->nama_kapal }}">
        </div>

        <div class="form-group col-12">
            <label for="tanggal_datang">Tanggal Datang</label>
            <input type="date" class="form-control" id="tanggal_datang" name="tanggal_datang"
                value="{{ $dataKapal->tanggal_datang }}"required>
        </div>

        <div class="form-group col-12">
            <label for="total_modal">Total Modal</label>
            <input type="number" class="form-control" id="total_modal" name="total_modal"
                value="{{ $dataKapal->total_modal }}" required>
        </div>

    </form>



    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
    <script>
        $(document).ready(function() {
            $("#total_modal").on('input', function() {
                let totalModal = $(this).val();
                if (totalModal === '' || totalModal < 0) {
                    $(this).val(0);
                }
            });

            $(".add_item-btn").click(function(e) {
                e.preventDefault();
                $("#show_item").append(
                    `
            <tr>
                      <td>
                    <input type="text" name="product[]" class="form-control">
                     </td>
                     <td>
                       <textarea class="form-control" name="description[]" id="description" style="resize: none"></textarea>
                     </td>
                     <td>
                       <input type="number" name="qty[]" class="form-control">
                     </td>
                     <td>
                        <button class="btn btn-danger remove_item_btn">-</button>
                     </td>
                     </tr>
            `
                );
            });

            $(document).on('click', '.remove_item_btn', function(e) {
                e.preventDefault();
                let row_item = $(this).parent().parent();
                $(row_item).remove();
            })
        });
    </script>
@endsection
