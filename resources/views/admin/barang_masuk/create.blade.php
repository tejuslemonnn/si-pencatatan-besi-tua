@extends('sb-admin/app')
@section('title', 'Tambah Data Barang Masuk')

@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">
                <i class="fa-solid fa-box me-2"></i>Tambah Data Barang Masuk
            </h5>
        </div>
        <div class="card-body">
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Bootstrap Tabs -->
            <ul class="nav nav-tabs" id="barangMasukCreateTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="besi-tua-tab" data-bs-toggle="tab" data-bs-target="#besi-tua-form"
                        type="button" role="tab" aria-controls="besi-tua-form" aria-selected="true">
                        <i class="fas fa-cube me-2"></i>Besi Tua
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="besi-scrap-tab" data-bs-toggle="tab" data-bs-target="#besi-scrap-form"
                        type="button" role="tab" aria-controls="besi-scrap-form" aria-selected="false">
                        <i class="fas fa-recycle me-2"></i>Besi Scrap
                    </button>
                </li>
            </ul>

            <div class="tab-content mt-4" id="barangMasukCreateTabsContent">
                <!-- Besi Tua Form -->
                <div class="tab-pane fade show active" id="besi-tua-form" role="tabpanel" aria-labelledby="besi-tua-tab">
                    <form action="{{ route('barang-masuk.store') }}" method="POST" id="besi_tua_form">
                        @csrf
                        <input type="hidden" name="type" value="besi_tua">

                        <div class="row">
                            <!-- Kode Field -->
                            <div class="col-md-6 mb-3">
                                <label for="kode_besi_tua" class="form-label">Kode <span
                                        class="text-danger">*</span></label>
                                <div class="input-group">
                                    @php
                                        use Carbon\Carbon;
                                        $currentDate = Carbon::now()->format('Y/m/d');
                                    @endphp
                                    <span class="input-group-text">BM-BT-{{ $currentDate }}-</span>
                                    <input type="text" name="kode" class="form-control" id="kode_besi_tua"
                                        value="{{ $newKodeBesiTua }}" readonly>
                                </div>
                            </div>

                            <!-- Tanggal Field -->
                            <div class="col-md-6 mb-3">
                                <label for="tanggal_besi_tua" class="form-label">Tanggal <span
                                        class="text-danger">*</span></label>
                                <input type="date" name="tanggal" class="form-control" id="tanggal_besi_tua"
                                    value="{{ old('tanggal') }}" required>
                            </div>

                            <!-- Kapal Field -->
                            <div class="col-md-6 mb-3">
                                <label for="data_kapal_id_besi_tua" class="form-label">Kapal <span
                                        class="text-danger">*</span></label>
                                <select name="data_kapal_id" id="data_kapal_id_besi_tua" class="form-control" required>
                                    <option value="">Pilih Kapal</option>
                                    @foreach ($dataKapals as $kapal)
                                        <option value="{{ $kapal->id }}"
                                            {{ old('data_kapal_id') == $kapal->id ? 'selected' : '' }}>
                                            {{ $kapal->nama_kapal }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Produk Field -->
                            <div class="col-md-6 mb-3">
                                <label for="produk_id_besi_tua" class="form-label">Produk <span
                                        class="text-danger">*</span></label>
                                <select name="produk_id" id="produk_id_besi_tua" class="form-control" required>
                                    <option value="">Pilih Produk</option>
                                    @foreach ($products as $product)
                                        <option value="{{ $product->id }}"
                                            {{ old('produk_id') == $product->id ? 'selected' : '' }}>
                                            {{ $product->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Weight Section -->
                            <div class="col-12">
                                <div class="card bg-light">
                                    <div class="card-header">
                                        <h6 class="card-title mb-0">Data Timbangan</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-4 mb-3">
                                                <label for="bruto_besi_tua" class="form-label">Bruto (Kg)</label>
                                                <input type="number" name="bruto" class="form-control"
                                                    id="bruto_besi_tua" value="{{ old('bruto') }}" step="0.01">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="tara_besi_tua" class="form-label">Tara (Kg)</label>
                                                <input type="number" name="tara" class="form-control"
                                                    id="tara_besi_tua" value="{{ old('tara') }}" step="0.01">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="netto_besi_tua" class="form-label">Netto (Kg)</label>
                                                <input type="number" name="netto" class="form-control"
                                                    id="netto_besi_tua" value="{{ old('netto') }}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Perusahaan Field -->
                            <div class="col-md-6 mb-3">
                                <label for="perusahaan_id_besi_tua" class="form-label">Perusahaan <span
                                        class="text-danger">*</span></label>
                                <select name="perusahaan_id" id="perusahaan_id_besi_tua" class="form-control" required>
                                    <option value="">Pilih Perusahaan</option>
                                    @foreach ($perusahaans as $perusahaan)
                                        <option value="{{ $perusahaan->id }}"
                                            {{ old('perusahaan_id') == $perusahaan->id ? 'selected' : '' }}>
                                            {{ $perusahaan->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <button type="button" class="btn btn-outline-secondary btn-reset">
                                <i class="fas fa-undo me-2"></i>Reset Form
                            </button>
                            <div class="d-flex gap-2">
                                <a href="{{ route('barang-masuk.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left me-2"></i>Kembali
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-2"></i>Simpan Data Besi Tua
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Besi Scrap Form -->
                <div class="tab-pane fade" id="besi-scrap-form" role="tabpanel" aria-labelledby="besi-scrap-tab">
                    <form action="{{ route('barang-masuk.store') }}" method="POST" id="besi_scrap_form">
                        @csrf
                        <input type="hidden" name="type" value="besi_scrap">

                        <div class="row">
                            <!-- Kode Field -->
                            <div class="col-md-6 mb-3">
                                <label for="kode_besi_scrap" class="form-label">Kode <span
                                        class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text">BM-BS-{{ $currentDate }}-</span>
                                    <input type="text" name="kode" class="form-control" id="kode_besi_scrap"
                                        value="{{ $newKodeBesiScrap }}" readonly>
                                </div>
                            </div>

                            <!-- Tanggal Field -->
                            <div class="col-md-6 mb-3">
                                <label for="tanggal_besi_scrap" class="form-label">Tanggal <span
                                        class="text-danger">*</span></label>
                                <input type="date" name="tanggal" class="form-control" id="tanggal_besi_scrap"
                                    value="{{ old('tanggal') }}" required>
                            </div>

                            <!-- Kapal Field -->
                            <div class="col-md-6 mb-3">
                                <label for="data_kapal_id_besi_scrap" class="form-label">Kapal <span
                                        class="text-danger">*</span></label>
                                <select name="data_kapal_id" id="data_kapal_id_besi_scrap" class="form-control" required>
                                    <option value="">Pilih Kapal</option>
                                    @foreach ($dataKapals as $kapal)
                                        <option value="{{ $kapal->id }}"
                                            {{ old('data_kapal_id') == $kapal->id ? 'selected' : '' }}>
                                            {{ $kapal->nama_kapal }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Perusahaan Field -->
                            <div class="col-md-6 mb-3">
                                <label for="perusahaan_id_besi_scrap" class="form-label">Perusahaan <span
                                        class="text-danger">*</span></label>
                                <select name="perusahaan_id" id="perusahaan_id_besi_scrap" class="form-control" required>
                                    <option value="">Pilih Perusahaan</option>
                                    @foreach ($perusahaans as $perusahaan)
                                        <option value="{{ $perusahaan->id }}"
                                            {{ old('perusahaan_id') == $perusahaan->id ? 'selected' : '' }}>
                                            {{ $perusahaan->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Timbangan SB Section -->
                            <div class="col-12 mb-4">
                                <div class="card bg-light">
                                    <div class="card-header">
                                        <h6 class="card-title mb-0">
                                            <i class="fas fa-weight me-2"></i>Timbangan SB
                                        </h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-4 mb-3">
                                                <label for="bruto_sb" class="form-label">Bruto (Kg)</label>
                                                <input type="number" name="bruto_sb" class="form-control"
                                                    id="bruto_sb" value="{{ old('bruto_sb') }}" step="0.01">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="tara_sb" class="form-label">Tara (Kg)</label>
                                                <input type="number" name="tara_sb" class="form-control" id="tara_sb"
                                                    value="{{ old('tara_sb') }}" step="0.01">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="netto_sb" class="form-label">Netto (Kg)</label>
                                                <input type="number" name="netto_sb" class="form-control"
                                                    id="netto_sb" value="{{ old('netto_sb') }}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Timbangan Pabrik Section -->
                            <div class="col-12 mb-4">
                                <div class="card bg-light">
                                    <div class="card-header">
                                        <h6 class="card-title mb-0">
                                            <i class="fas fa-industry me-2"></i>Timbangan Pabrik
                                        </h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-4 mb-3">
                                                <label for="bruto_pabrik" class="form-label">Bruto (Kg)</label>
                                                <input type="number" name="bruto_pabrik" class="form-control"
                                                    id="bruto_pabrik" value="{{ old('bruto_pabrik') }}" step="0.01">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="tara_pabrik" class="form-label">Tara (Kg)</label>
                                                <input type="number" name="tara_pabrik" class="form-control"
                                                    id="tara_pabrik" value="{{ old('tara_pabrik') }}" step="0.01">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="netto_pabrik" class="form-label">Netto (Kg)</label>
                                                <input type="number" name="netto_pabrik" class="form-control"
                                                    id="netto_pabrik" value="{{ old('netto_pabrik') }}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Final Calculation Section -->
                            <div class="col-12">
                                <div class="card bg-primary text-white">
                                    <div class="card-header">
                                        <h6 class="card-title mb-0">
                                            <i class="fas fa-calculator me-2"></i>Perhitungan Akhir
                                        </h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="pot" class="form-label">POT (Kg)</label>
                                                <input type="number" name="pot" class="form-control" id="pot"
                                                    value="{{ old('pot') }}" step="0.01">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="netto_bersih" class="form-label">Netto Bersih (Kg)</label>
                                                <input type="number" name="netto_bersih" class="form-control"
                                                    id="netto_bersih" value="{{ old('netto_bersih') }}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <button type="button" class="btn btn-outline-secondary btn-reset"
                                click="resetForm('#besi_scrap_form')">
                                <i class="fas fa-undo me-2"></i>Reset Form
                            </button>
                            <div class="d-flex gap-2">
                                <a href="{{ route('barang-masuk.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left me-2"></i>Kembali
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-2"></i>Simpan Data Besi Scrap
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script>
        $(document).ready(function() {
            // Initialize Select2 for all select elements
            function initializeSelect2() {
                $('select[id$="_besi_tua"], select[id$="_besi_scrap"]').select2({
                    width: '100%',
                    placeholder: function() {
                        return $(this).find('option:first').text();
                    }
                });
            }

            // Reset form function
            function resetForm(formId) {
                console.log('Resetting form:', formId);

                const form = $(formId)[0];
                if (form) {
                    // Reset the form
                    form.reset();

                    // Clear all validation states
                    $(formId + ' .is-invalid').removeClass('is-invalid');
                    $(formId + ' .is-valid').removeClass('is-valid');

                    // Reset all calculated fields to 0
                    $(formId + ' input[readonly]').val('0');

                    // Reset Select2 dropdowns
                    $(formId + ' select').val(null).trigger('change');

                    // Clear any custom error messages
                    $(formId + ' .invalid-feedback').remove();

                    // Reset kode fields
                    if (formId === '#besi_tua_form') {
                        $('#kode_besi_tua').val('{{ $newKodeBesiTua }}');
                    } else if (formId === '#besi_scrap_form') {
                        $('#kode_besi_scrap').val('{{ $newKodeBesiScrap }}');
                    }

                    console.log('Form reset:', formId);
                }
            }

            // Reset all forms function
            function resetAllForms() {
                resetForm('#besi_tua_form');
                resetForm('#besi_scrap_form');
            }

            // Initialize Select2 on page load
            initializeSelect2();

            // Handle tab switching with form reset
            $('button[data-bs-toggle="tab"]').on('show.bs.tab', function(e) {
                const targetTab = $(e.target).attr('data-bs-target');

                // Show confirmation dialog before switching tabs
                if (isFormDirty()) {
                    const confirmSwitch = confirm(
                        'Switching tabs will reset all form data. Are you sure you want to continue?');
                    if (!confirmSwitch) {
                        e.preventDefault();
                        return false;
                    }
                }

                // Reset all forms when switching tabs
                resetAllForms();
            });

            // Re-initialize Select2 when tab is shown
            $('button[data-bs-toggle="tab"]').on('shown.bs.tab', function(e) {
                initializeSelect2();

                // Set current date as default for the active tab
                const targetTab = $(e.target).attr('data-bs-target');
                const today = new Date().toISOString().split('T')[0];

                if (targetTab === '#besi-tua-form') {
                    $('#tanggal_besi_tua').val(today);
                } else if (targetTab === '#besi-scrap-form') {
                    $('#tanggal_besi_scrap').val(today);
                }
            });

            // Function to check if form has been modified
            function isFormDirty() {
                let isDirty = false;

                // Check text inputs, number inputs, and date inputs
                $('#besi_tua_form input[type="text"]:not([readonly]), #besi_tua_form input[type="number"]:not([readonly]), #besi_tua_form input[type="date"]')
                    .each(function() {
                        if ($(this).val() && $(this).val() !== '0') {
                            isDirty = true;
                            return false;
                        }
                    });

                $('#besi_scrap_form input[type="text"]:not([readonly]), #besi_scrap_form input[type="number"]:not([readonly]), #besi_scrap_form input[type="date"]')
                    .each(function() {
                        if ($(this).val() && $(this).val() !== '0') {
                            isDirty = true;
                            return false;
                        }
                    });

                // Check select dropdowns
                $('#besi_tua_form select, #besi_scrap_form select').each(function() {
                    if ($(this).val()) {
                        isDirty = true;
                        return false;
                    }
                });

                return isDirty;
            }

            // Add reset button functionality
            $('.btn-reset').on('click', function(e) {
                e.preventDefault();
                const confirmReset = confirm(
                    'Are you sure you want to reset the form? All data will be lost.');
                if (confirmReset) {
                    const activeTab = $('.tab-pane.active').attr('id');
                    if (activeTab === 'besi-tua-form') {
                        resetForm('#besi_tua_form');
                    } else if (activeTab === 'besi-scrap-form') {
                        resetForm('#besi_scrap_form');
                    }
                }
            });

            // Besi Tua calculations
            function updateNettoBesiTua() {
                let bruto = parseFloat($('#bruto_besi_tua').val()) || 0;
                let tara = parseFloat($('#tara_besi_tua').val()) || 0;
                let netto = bruto > 0 && tara >= 0 ? bruto - tara : 0;
                $('#netto_besi_tua').val(netto > 0 ? netto.toFixed(2) : '0');
            }

            $('#bruto_besi_tua, #tara_besi_tua').on('input', updateNettoBesiTua);

            // Besi Scrap calculations
            function updateNettoSB() {
                let bruto = parseFloat($('#bruto_sb').val()) || 0;
                let tara = parseFloat($('#tara_sb').val()) || 0;
                let netto = bruto > 0 && tara >= 0 ? bruto - tara : 0;
                $('#netto_sb').val(netto > 0 ? netto.toFixed(2) : '0');
            }

            function updateNettoPabrik() {
                let bruto = parseFloat($('#bruto_pabrik').val()) || 0;
                let tara = parseFloat($('#tara_pabrik').val()) || 0;
                let netto = bruto > 0 && tara >= 0 ? bruto - tara : 0;
                $('#netto_pabrik').val(netto > 0 ? netto.toFixed(2) : '0').trigger('change');
            }

            function updateNettoBersih() {
                let nettoPabrik = parseFloat($('#netto_pabrik').val()) || 0;
                let pot = parseFloat($('#pot').val()) || 0;
                let nettoBersih = nettoPabrik > 0 && pot >= 0 ? nettoPabrik - pot : 0;
                $('#netto_bersih').val(nettoBersih > 0 ? nettoBersih.toFixed(2) : '0');
            }

            // Bind events for Besi Scrap calculations
            $('#bruto_sb, #tara_sb').on('input', updateNettoSB);
            $('#bruto_pabrik, #tara_pabrik').on('input', updateNettoPabrik);
            $('#pot').on('input', updateNettoBersih);
            $('#netto_pabrik').on('change', updateNettoBersih);

            // Form validation
            $('form').on('submit', function(e) {
                let form = $(this);
                let isValid = true;

                // Check required fields
                form.find('input[required], select[required]').each(function() {
                    if (!$(this).val()) {
                        isValid = false;
                        $(this).addClass('is-invalid');

                        // Add error message if not exists
                        if (!$(this).next('.invalid-feedback').length) {
                            $(this).after(
                                '<div class="invalid-feedback">This field is required.</div>');
                        }
                    } else {
                        $(this).removeClass('is-invalid');
                        $(this).next('.invalid-feedback').remove();
                    }
                });

                if (!isValid) {
                    e.preventDefault();

                    // Show alert with better message
                    const activeTabName = $('.nav-link.active').text().trim();
                    alert(`Mohon lengkapi semua field yang wajib diisi pada form ${activeTabName}!`);

                    // Focus on first invalid field
                    form.find('.is-invalid').first().focus();
                }
            });

            // Set initial date on page load
            const today = new Date().toISOString().split('T')[0];
            $('#tanggal_besi_tua').val(today);

            // Prevent accidental page refresh
            window.addEventListener('beforeunload', function(e) {
                if (isFormDirty()) {
                    e.preventDefault();
                    e.returnValue = '';
                }
            });
        });
    </script>
@endsection
