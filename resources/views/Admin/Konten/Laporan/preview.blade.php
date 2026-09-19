@extends('Admin.Layout.master')

@section('title', 'Preview Laporan - Kelurahan Binong')

@section('content')

<div class="content-header">


<div>
    <h1>Preview Laporan</h1>
    <p>Pratinjau laporan sebelum diunduh dalam format PDF</p>
</div>


</div>

<div class="breadcrumb">


<a href="{{ route('dashboard') }}">
    <i class="fas fa-home"></i>
    Dashboard
</a>

<span>/</span>

<a href="{{ route('laporan.index') }}">
    Laporan Bulanan
</a>

<span>/</span>

<span>Preview</span>


</div>

<div class="preview-card">


<div class="preview-header">

    <div class="preview-title">

        <div class="pdf-icon">
            <i class="fas fa-file-pdf"></i>
        </div>

        <div>
            <h2>{{ $namaMenu }}</h2>

            <p>
                Laporan Bulanan ·
                {{ $namaBulan }}
                {{ $tahun }}
            </p>
        </div>

    </div>

    <div class="period-large">
        {{ $namaBulan }} {{ $tahun }}
    </div>

</div>

<div class="report-meta">

    <div class="meta-item">
        <span class="meta-label">Kelurahan</span>
        <strong>Kelurahan Binong</strong>
    </div>

    <div class="meta-item">
        <span class="meta-label">Jenis Data</span>
        <strong>{{ $namaMenu }}</strong>
    </div>

    <div class="meta-item">
        <span class="meta-label">Periode</span>
        <strong>{{ $namaBulan }} {{ $tahun }}</strong>
    </div>

    <div class="meta-item">
        <span class="meta-label">Jumlah Data</span>
        <strong>{{ $data->count() }} Data</strong>
    </div>

</div>


</div>

<div class="preview-card">


<div class="section-header">

    <div>
        <h2>Data Laporan</h2>

        <p>
            Data yang akan dimasukkan ke dalam dokumen PDF
        </p>
    </div>

</div>

<div class="table-wrapper">

    @if($data->count())

        @if($menu === 'datapkl')

            <table class="preview-table">

                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama PKL</th>
                        <th>Jenis Dagangan</th>
                        <th>Lokasi</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach($data as $index => $item)

                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->nama_pkl ?: '-' }}</td>
                            <td>{{ $item->jenis_dagangan ?: '-' }}</td>
                            <td>{{ $item->lokasi ?: '-' }}</td>
                            <td>{{ $item->keterangan ?: '-' }}</td>
                        </tr>

                    @endforeach

                </tbody>

            </table>

        @elseif($menu === 'datartrw')

            <table class="preview-table">

                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nomor RT</th>
                        <th>Nama Ketua RT</th>
                        <th>Nomor RW</th>
                        <th>Nama Ketua RW</th>
                        <th>Mulai</th>
                        <th>Berakhir</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach($data as $index => $item)

                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->nomor_rt ?: '-' }}</td>
                            <td>{{ $item->nama_rt ?: '-' }}</td>
                            <td>{{ $item->nomor_rw ?: '-' }}</td>
                            <td>{{ $item->nama_rw ?: '-' }}</td>

                            <td>
                                @if($item->tanggal_mulai)
                                    {{ $item->tanggal_mulai instanceof \Carbon\Carbon
                                        ? $item->tanggal_mulai->format('d/m/Y')
                                        : \Carbon\Carbon::parse($item->tanggal_mulai)->format('d/m/Y') }}
                                @else
                                    -
                                @endif
                            </td>

                            <td>
                                @if($item->tanggal_berakhir)
                                    {{ $item->tanggal_berakhir instanceof \Carbon\Carbon
                                        ? $item->tanggal_berakhir->format('d/m/Y')
                                        : \Carbon\Carbon::parse($item->tanggal_berakhir)->format('d/m/Y') }}
                                @else
                                    -
                                @endif
                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        @elseif($menu === 'datalinmas')

            <table class="preview-table">

                <thead>
                    <tr>
                        <th>No</th>
                        <th>RW</th>
                        <th>Jumlah Linmas</th>
                        <th>Nama</th>
                        <th>NIK</th>
                        <th>Alamat</th>
                        <th>Pekerjaan</th>
                        <th>Poskamling</th>
                        <th>Titik Poskamling</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach($data as $index => $item)

                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->rw ?: '-' }}</td>
                            <td>{{ $item->jumlah_linmas ?? 0 }}</td>
                            <td>{{ $item->nama ?: '-' }}</td>
                            <td>{{ $item->nik ?: '-' }}</td>
                            <td>{{ $item->alamat ?: '-' }}</td>
                            <td>{{ $item->pekerjaan ?: '-' }}</td>
                            <td>{{ $item->jumlah_poskamling ?? 0 }}</td>
                            <td>{{ $item->titik_poskamling ?: '-' }}</td>
                        </tr>

                    @endforeach

                </tbody>

            </table>

        @elseif($menu === 'dataumkm')

            <table class="preview-table">

                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Pelaku</th>
                        <th>Jenis Usaha</th>
                        <th>Alamat</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach($data as $index => $item)

                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->nama_pelaku_usaha ?? '-' }}</td>
                            <td>{{ $item->jenis_usaha ?? '-' }}</td>
                            <td>{{ $item->alamat_usaha ?? '-' }}</td>
                            <td>{{ $item->keterangan ?? '-' }}</td>
                        </tr>

                    @endforeach

                </tbody>

            </table>

        @else

            @php
                $firstItem = $data->first();

                $excludeColumns = [
                    'id',
                    'created_at',
                    'updated_at',
                    'google_sync_status',
                    'google_synced_at'
                ];

                $columns = [];

                if ($firstItem) {
                    $columns = array_keys($firstItem->getAttributes());

                    $columns = array_values(
                        array_filter(
                            $columns,
                            function ($column) use ($excludeColumns) {
                                return !in_array($column, $excludeColumns);
                            }
                        )
                    );
                }
            @endphp

            @if(count($columns))

                <table class="preview-table">

                    <thead>

                        <tr>

                            <th>No</th>

                            @foreach($columns as $column)

                                <th>
                                    {{ \Illuminate\Support\Str::headline($column) }}
                                </th>

                            @endforeach

                        </tr>

                    </thead>

                    <tbody>

                        @foreach($data as $index => $item)

                            <tr>

                                <td>
                                    {{ $index + 1 }}
                                </td>

                                @foreach($columns as $column)

                                    @php
                                        $value = $item->{$column};
                                    @endphp

                                    <td>

                                        @if(is_null($value) || $value === '')
                                            -
                                        @elseif(is_bool($value))
                                            {{ $value ? 'Ya' : 'Tidak' }}
                                        @else
                                            {{ $value }}
                                        @endif

                                    </td>

                                @endforeach

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            @else

                <div class="generic-data">

                    <div class="generic-icon">
                        <i class="fas fa-database"></i>
                    </div>

                    <h3>
                        {{ $data->count() }} Data Siap Dilaporkan
                    </h3>

                    <p>
                        Data untuk
                        <strong>{{ $namaMenu }}</strong>
                        tersedia dan siap dibuat menjadi laporan PDF.
                    </p>

                </div>

            @endif

        @endif

    @else

        <div class="empty-state">

            <i class="fas fa-folder-open"></i>

            <h3>Belum Ada Data</h3>

            <p>
                Belum terdapat data untuk
                {{ $namaMenu }}
                yang dapat ditampilkan.
            </p>

        </div>

    @endif

</div>


</div>

<div class="action-card">


<a
    href="{{ route('laporan.index') }}"
    class="btn btn-secondary"
>
    <i class="fas fa-arrow-left"></i>
    Kembali
</a>

<form
    action="{{ route('laporan.pdf') }}"
    method="POST"
    id="formDownloadPdf"
>

    @csrf

    <input
        type="hidden"
        name="menu"
        value="{{ $menu }}"
    >

    <input
        type="hidden"
        name="bulan"
        value="{{ $bulan }}"
    >

    <input
        type="hidden"
        name="tahun"
        value="{{ $tahun }}"
    >

    <button
        type="submit"
        class="btn btn-pdf"
        id="btnDownloadPdf"
    >
        <i class="fas fa-file-pdf"></i>
        Download PDF
    </button>

</form>


</div>

@endsection

@push('styles')

<style>

.content-header {
    margin-bottom: 15px;
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

.breadcrumb {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 8px;
    margin-bottom: 22px;
    color: #9ca3af;
    font-size: 13px;
}

.breadcrumb a {
    color: #087443;
    text-decoration: none;
}

.breadcrumb a:hover {
    text-decoration: underline;
}

.preview-card {
    background: #ffffff;
    border: 1px solid #e5e7eb;
    border-radius: 12px;
    margin-bottom: 20px;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(16, 47, 71, 0.05);
}

.preview-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
    padding: 24px;
    border-bottom: 1px solid #edf0f2;
}

.preview-title {
    display: flex;
    align-items: center;
    gap: 14px;
}

.pdf-icon {
    width: 50px;
    height: 50px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #fef2f2;
    color: #b91c1c;
    font-size: 21px;
    flex-shrink: 0;
}

.preview-title h2 {
    margin: 0;
    color: #102f47;
    font-size: 19px;
}

.preview-title p {
    margin: 5px 0 0;
    color: #6b7280;
    font-size: 13px;
}

.period-large {
    padding: 8px 13px;
    background: #ecfdf3;
    color: #087443;
    border-radius: 7px;
    font-size: 13px;
    font-weight: 700;
    white-space: nowrap;
}

.report-meta {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
}

.meta-item {
    padding: 18px 24px;
    border-right: 1px solid #edf0f2;
}

.meta-item:last-child {
    border-right: 0;
}

.meta-label {
    display: block;
    margin-bottom: 5px;
    color: #9ca3af;
    font-size: 11px;
    text-transform: uppercase;
    letter-spacing: 0.4px;
}

.meta-item strong {
    color: #102f47;
    font-size: 14px;
}

.section-header {
    padding: 20px 24px;
    border-bottom: 1px solid #edf0f2;
}

.section-header h2 {
    margin: 0;
    color: #102f47;
    font-size: 17px;
}

.section-header p {
    margin: 4px 0 0;
    color: #6b7280;
    font-size: 13px;
}

.table-wrapper {
    width: 100%;
    overflow-x: auto;
    padding: 0 20px 20px;
}

.preview-table {
    width: 100%;
    min-width: 800px;
    border-collapse: collapse;
    font-size: 12px;
}

.preview-table th {
    padding: 12px 10px;
    text-align: left;
    color: #102f47;
    background: #f8faf9;
    border-bottom: 2px solid #e5e7eb;
    white-space: nowrap;
}

.preview-table td {
    padding: 11px 10px;
    color: #4b5563;
    border-bottom: 1px solid #edf0f2;
    vertical-align: top;
}

.preview-table tbody tr:hover {
    background: #fafdfb;
}

.generic-data {
    text-align: center;
    padding: 60px 20px;
}

.generic-icon {
    width: 60px;
    height: 60px;
    margin: 0 auto 15px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    background: #ecfdf3;
    color: #087443;
    font-size: 24px;
}

.generic-data h3 {
    margin: 0 0 7px;
    color: #102f47;
    font-size: 17px;
}

.generic-data p {
    margin: 0;
    color: #6b7280;
    font-size: 13px;
}

.empty-state {
    text-align: center;
    padding: 60px 20px;
    color: #9ca3af;
}

.empty-state i {
    display: block;
    margin-bottom: 13px;
    font-size: 42px;
}

.empty-state h3 {
    margin: 0 0 6px;
    color: #6b7280;
    font-size: 17px;
}

.empty-state p {
    margin: 0;
    font-size: 13px;
}

.action-card {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 10px;
    margin-bottom: 25px;
}

.action-card form {
    margin: 0;
}

.btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    min-height: 42px;
    padding: 10px 18px;
    border: 0;
    border-radius: 7px;
    text-decoration: none;
    cursor: pointer;
    font-family: inherit;
    font-size: 13px;
    font-weight: 600;
    transition: 0.2s;
}

.btn-secondary {
    color: #374151;
    background: #f3f4f6;
    border: 1px solid #e5e7eb;
}

.btn-secondary:hover {
    background: #e5e7eb;
}

.btn-pdf {
    color: #ffffff;
    background: #087443;
}

.btn-pdf:hover {
    background: #065f37;
}

.btn-pdf:disabled {
    opacity: 0.7;
    cursor: not-allowed;
}

@media (max-width: 768px) {

    .preview-header {
        align-items: flex-start;
        flex-direction: column;
    }

    .report-meta {
        grid-template-columns: 1fr 1fr;
    }

    .meta-item {
        border-right: 1px solid #edf0f2;
        border-bottom: 1px solid #edf0f2;
    }

    .meta-item:nth-child(2n) {
        border-right: 0;
    }

}

@media (max-width: 600px) {

    .report-meta {
        grid-template-columns: 1fr;
    }

    .meta-item {
        border-right: 0;
    }

    .action-card {
        flex-direction: column-reverse;
        align-items: stretch;
    }

    .action-card .btn {
        width: 100%;
    }

}

</style>

@endpush

@push('scripts')

<script>

document.addEventListener('DOMContentLoaded', function () {

    const formPdf = document.getElementById('formDownloadPdf');
    const btnPdf = document.getElementById('btnDownloadPdf');

    if (formPdf && btnPdf) {

        formPdf.addEventListener('submit', function () {

            btnPdf.disabled = true;

            btnPdf.innerHTML =
                '<i class="fas fa-spinner fa-spin"></i> Membuat PDF...';

        });

    }

});

</script>

@endpush
