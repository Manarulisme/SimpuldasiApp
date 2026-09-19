@extends('Admin.Layout.master')

@section('title', 'Laporan Bulanan - Kelurahan Binong')

@section('content')

<div class="content-header">
    <div>
        <h1>Laporan Bulanan</h1>
        <p>Pembuatan dan riwayat laporan data Kelurahan Binong</p>
    </div>
</div>

@if(session('success')) <div class="alert alert-success"> <i class="fas fa-check-circle"></i> <span>{{ session('success') }}</span> </div>
@endif

@if(session('error')) <div class="alert alert-danger"> <i class="fas fa-exclamation-circle"></i> <span>{{ session('error') }}</span> </div>
@endif

<div class="report-layout">


{{-- FORM PEMBUATAN LAPORAN --}}
<div class="report-card">

    <div class="report-card-header">
        <div class="report-icon">
            <i class="fas fa-file-pdf"></i>
        </div>

        <div>
            <h2>Buat Laporan Bulanan</h2>
            <p>Pilih data, bulan, dan tahun laporan</p>
        </div>
    </div>

    <form action="{{ route('laporan.preview') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="menu">
                Data yang Dilaporkan
                <span class="required">*</span>
            </label>

            <select
                name="menu"
                id="menu"
                class="form-control"
                required
            >
                <option value="">-- Pilih Data --</option>

                @foreach($daftarMenu as $key => $menu)
                    <option
                        value="{{ $key }}"
                        {{ old('menu') == $key ? 'selected' : '' }}
                    >
                        {{ is_array($menu) ? $menu['nama'] : $menu }}
                    </option>
                @endforeach
            </select>

            @error('menu')
                <small class="error-text">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-row">

            <div class="form-group">
                <label for="bulan">
                    Bulan
                    <span class="required">*</span>
                </label>

                <select
                    name="bulan"
                    id="bulan"
                    class="form-control"
                    required
                >
                    <option value="">-- Pilih Bulan --</option>

                    @foreach($daftarBulan as $nomor => $nama)
                        <option
                            value="{{ $nomor }}"
                            {{ old('bulan', now()->month) == $nomor ? 'selected' : '' }}
                        >
                            {{ $nama }}
                        </option>
                    @endforeach
                </select>

                @error('bulan')
                    <small class="error-text">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="tahun">
                    Tahun
                    <span class="required">*</span>
                </label>

                <select
                    name="tahun"
                    id="tahun"
                    class="form-control"
                    required
                >
                    @for($tahun = $tahunSekarang; $tahun >= $tahunSekarang - 5; $tahun--)
                        <option
                            value="{{ $tahun }}"
                            {{ old('tahun', $tahunSekarang) == $tahun ? 'selected' : '' }}
                        >
                            {{ $tahun }}
                        </option>
                    @endfor
                </select>

                @error('tahun')
                    <small class="error-text">{{ $message }}</small>
                @enderror
            </div>

        </div>

        <div class="report-info">
            <div class="report-info-icon">
                <i class="fas fa-info-circle"></i>
            </div>

            <div>
                <strong>Informasi Laporan</strong>
                <p>
                    Pilih data dan periode yang ingin dibuatkan laporan.
                    Setelah itu sistem akan menampilkan preview sebelum
                    laporan diunduh dalam format PDF.
                </p>
            </div>
        </div>

        <div class="form-footer">
            <a href="{{ url('/dashboard') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i>
                Kembali
            </a>

            <button type="submit" class="btn btn-primary">
                <i class="fas fa-eye"></i>
                Tampilkan Preview
            </button>
        </div>

    </form>

</div>

{{-- RIWAYAT LAPORAN --}}
<div class="report-card">

    <div class="table-panel-header">
        <div>
            <h2>Riwayat Laporan</h2>
            <p>Daftar laporan yang pernah dibuat</p>
        </div>

        <div class="total-data">
            {{ $laporan->count() }} Laporan
        </div>
    </div>

    <div class="table-wrapper">

        <table id="tableLaporan" class="display laporan-table">

            <thead>
                <tr>
                    <th>No</th>
                    <th>Data</th>
                    <th>Periode</th>
                    <th>Nama File</th>
                    <th>Status</th>
                    <th>Dibuat</th>
                </tr>
            </thead>

            <tbody>

                @forelse($laporan as $index => $item)

                    <tr>

                        <td>{{ $index + 1 }}</td>

                        <td>
                            <div class="report-name">
                                {{ $daftarMenu[$item->menu]['nama'] ?? $item->menu }}
                            </div>
                        </td>

                        <td>
                            <span class="period-badge">
                                {{ $daftarBulan[$item->bulan] ?? '-' }}
                                {{ $item->tahun }}
                            </span>
                        </td>

                        <td>
                            @if($item->nama_file)
                                <span class="file-name">
                                    <i class="fas fa-file-pdf"></i>
                                    {{ $item->nama_file }}
                                </span>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>

                        <td>

                            @if($item->status === 'generated')

                                <span class="status-badge status-success">
                                    <i class="fas fa-check-circle"></i>
                                    Berhasil
                                </span>

                            @elseif($item->status === 'failed')

                                <span class="status-badge status-danger">
                                    <i class="fas fa-times-circle"></i>
                                    Gagal
                                </span>

                            @else

                                <span class="status-badge status-warning">
                                    <i class="fas fa-clock"></i>
                                    {{ ucfirst($item->status) }}
                                </span>

                            @endif

                        </td>

                        <td>
                            <span class="date-info">
                                {{ $item->created_at ? $item->created_at->format('d/m/Y H:i') : '-' }}
                            </span>
                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="6">

                            <div class="empty-state">
                                <i class="fas fa-file-alt"></i>
                                <h3>Belum Ada Laporan</h3>
                                <p>
                                    Belum ada laporan bulanan yang dibuat.
                                </p>
                            </div>

                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>


</div>

@endsection

@push('styles')

<style>

    .content-header {
        margin-bottom: 24px;
    }

    .content-header h1 {
        margin: 0;
        color: #102f47;
        font-size: 28px;
        font-weight: 700;
    }

    .content-header p {
        margin: 6px 0 0;
        color: #6b7280;
        font-size: 14px;
    }

    .alert {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 13px 16px;
        border-radius: 8px;
        margin-bottom: 20px;
        font-size: 14px;
    }

    .alert-success {
        background: #ecfdf3;
        color: #087443;
        border: 1px solid #b7ebcc;
    }

    .alert-danger {
        background: #fef2f2;
        color: #b91c1c;
        border: 1px solid #fecaca;
    }

    .report-layout {
        display: flex;
        flex-direction: column;
        gap: 24px;
    }

    .report-card {
        background: #ffffff;
        border-radius: 12px;
        border: 1px solid #e5e7eb;
        box-shadow: 0 2px 8px rgba(16, 47, 71, 0.05);
        overflow: hidden;
    }

    .report-card-header {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 22px 24px;
        border-bottom: 1px solid #edf0f2;
    }

    .report-icon {
        width: 46px;
        height: 46px;
        border-radius: 10px;
        background: #ecfdf3;
        color: #087443;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
    }

    .report-card-header h2 {
        margin: 0;
        color: #102f47;
        font-size: 18px;
        font-weight: 700;
    }

    .report-card-header p {
        margin: 4px 0 0;
        color: #6b7280;
        font-size: 13px;
    }

    .report-card form {
        padding: 24px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        color: #102f47;
        font-size: 14px;
        font-weight: 600;
    }

    .required {
        color: #dc2626;
    }

    .form-control {
        width: 100%;
        min-height: 44px;
        padding: 10px 13px;
        border: 1px solid #d1d5db;
        border-radius: 7px;
        background: #ffffff;
        color: #374151;
        font-size: 14px;
        outline: none;
        transition: 0.2s;
    }

    .form-control:focus {
        border-color: #087443;
        box-shadow: 0 0 0 3px rgba(8, 116, 67, 0.08);
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 18px;
    }

    .error-text {
        display: block;
        margin-top: 6px;
        color: #dc2626;
        font-size: 12px;
    }

    .report-info {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        padding: 14px 16px;
        margin-top: 4px;
        border-radius: 8px;
        background: #f3f8f5;
        border: 1px solid #d8ebe1;
    }

    .report-info-icon {
        color: #087443;
        font-size: 17px;
        padding-top: 2px;
    }

    .report-info strong {
        display: block;
        color: #102f47;
        font-size: 13px;
        margin-bottom: 4px;
    }

    .report-info p {
        margin: 0;
        color: #5f6b76;
        font-size: 12px;
        line-height: 1.6;
    }

    .form-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 10px;
        padding-top: 22px;
        margin-top: 22px;
        border-top: 1px solid #edf0f2;
    }

    .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        min-height: 42px;
        padding: 10px 17px;
        border-radius: 7px;
        text-decoration: none;
        border: none;
        cursor: pointer;
        font-size: 13px;
        font-weight: 600;
        transition: 0.2s;
    }

    .btn-primary {
        background: #087443;
        color: #ffffff;
    }

    .btn-primary:hover {
        background: #065f37;
    }

    .btn-secondary {
        background: #f3f4f6;
        color: #374151;
    }

    .btn-secondary:hover {
        background: #e5e7eb;
    }

    .table-panel-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 15px;
        padding: 20px 24px;
        border-bottom: 1px solid #edf0f2;
    }

    .table-panel-header h2 {
        margin: 0;
        color: #102f47;
        font-size: 18px;
    }

    .table-panel-header p {
        margin: 4px 0 0;
        color: #6b7280;
        font-size: 13px;
    }

    .total-data {
        color: #087443;
        background: #ecfdf3;
        border: 1px solid #cdebd9;
        padding: 7px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        white-space: nowrap;
    }

    .table-wrapper {
        width: 100%;
        overflow-x: auto;
        padding: 0 20px 20px;
    }

    .laporan-table {
        width: 100% !important;
        border-collapse: collapse;
        font-size: 13px;
    }

    .laporan-table thead th {
        color: #102f47;
        font-weight: 700;
        background: #f8faf9;
        white-space: nowrap;
    }

    .laporan-table tbody td {
        vertical-align: middle;
    }

    .report-name {
        font-weight: 600;
        color: #102f47;
    }

    .period-badge {
        display: inline-block;
        padding: 5px 9px;
        border-radius: 6px;
        background: #f3f4f6;
        color: #374151;
        font-size: 12px;
        white-space: nowrap;
    }

    .file-name {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        color: #b91c1c;
        font-size: 12px;
    }

    .text-muted {
        color: #9ca3af;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 5px 9px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 600;
        white-space: nowrap;
    }

    .status-success {
        color: #087443;
        background: #ecfdf3;
    }

    .status-danger {
        color: #b91c1c;
        background: #fef2f2;
    }

    .status-warning {
        color: #92400e;
        background: #fffbeb;
    }

    .date-info {
        color: #6b7280;
        white-space: nowrap;
        font-size: 12px;
    }

    .empty-state {
        text-align: center;
        padding: 50px 20px;
        color: #9ca3af;
    }

    .empty-state i {
        font-size: 40px;
        margin-bottom: 12px;
    }

    .empty-state h3 {
        margin: 0 0 5px;
        color: #6b7280;
        font-size: 16px;
    }

    .empty-state p {
        margin: 0;
        font-size: 13px;
    }

    @media (max-width: 700px) {

        .content-header h1 {
            font-size: 23px;
        }

        .form-row {
            grid-template-columns: 1fr;
            gap: 0;
        }

        .form-footer {
            flex-direction: column-reverse;
            align-items: stretch;
        }

        .form-footer .btn {
            width: 100%;
        }

        .table-panel-header {
            align-items: flex-start;
            flex-direction: column;
        }

    }

</style>

@endpush

@push('scripts')

<script>
    document.addEventListener('DOMContentLoaded', function () {

        if (typeof DataTable !== 'undefined') {

            new DataTable('#tableLaporan', {
                pageLength: 10,

                lengthMenu: [
                    [10, 25, 50, 100],
                    [10, 25, 50, 100]
                ],

                order: [],

                columnDefs: [
                    {
                        targets: [0, 5],
                        orderable: false
                    }
                ],

                language: {
                    search: 'Cari:',
                    lengthMenu: 'Tampilkan _MENU_ data',
                    info: 'Menampilkan _START_ sampai _END_ dari _TOTAL_ laporan',
                    infoEmpty: 'Tidak ada laporan',
                    zeroRecords: 'Data tidak ditemukan',
                    emptyTable: 'Belum ada laporan',
                    paginate: {
                        first: 'Pertama',
                        last: 'Terakhir',
                        next: 'Berikutnya',
                        previous: 'Sebelumnya'
                    }
                }
            });

        }

    });
</script>

@endpush
