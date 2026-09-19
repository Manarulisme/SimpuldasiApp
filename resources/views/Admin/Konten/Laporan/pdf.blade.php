<!DOCTYPE html>

<html lang="id">

<head>

```
<meta charset="UTF-8">

<title>{{ $judulLaporan }}</title>

<style>

    @page {
        margin: 25px 25px 30px 25px;
    }

    * {
        box-sizing: border-box;
    }

    body {
        margin: 0;
        font-family: DejaVu Sans, Arial, sans-serif;
        color: #222222;
        font-size: 10px;
        line-height: 1.5;
    }

    .header {
        width: 100%;
        border-bottom: 3px solid #087443;
        padding-bottom: 12px;
        margin-bottom: 18px;
    }

    .header-table {
        width: 100%;
        border-collapse: collapse;
    }

    .header-table td {
        vertical-align: middle;
    }

    .header-left {
        width: 70%;
    }

    .header-title {
        margin: 0;
        color: #102f47;
        font-size: 18px;
        font-weight: bold;
    }

    .header-subtitle {
        margin: 2px 0 0;
        color: #555555;
        font-size: 10px;
    }

    .header-right {
        width: 30%;
        text-align: right;
    }

    .document-label {
        display: inline-block;
        padding: 5px 9px;
        border: 1px solid #087443;
        color: #087443;
        font-size: 9px;
        font-weight: bold;
    }

    .report-title {
        margin: 0 0 5px;
        text-align: center;
        color: #102f47;
        font-size: 16px;
        font-weight: bold;
        text-transform: uppercase;
    }

    .report-period {
        margin: 0 0 18px;
        text-align: center;
        color: #555555;
        font-size: 10px;
    }

    .information-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 18px;
    }

    .information-table td {
        padding: 6px 8px;
        border: 1px solid #dddddd;
    }

    .information-label {
        width: 18%;
        background: #f5f7f6;
        color: #555555;
        font-weight: bold;
    }

    .information-value {
        width: 32%;
    }

    .data-title {
        margin: 0 0 8px;
        color: #102f47;
        font-size: 11px;
        font-weight: bold;
    }

    .data-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 18px;
    }

    .data-table th {
        padding: 7px 6px;
        background: #087443;
        color: #ffffff;
        border: 1px solid #087443;
        font-size: 8px;
        font-weight: bold;
        text-align: center;
    }

    .data-table td {
        padding: 6px;
        border: 1px solid #d9d9d9;
        font-size: 8px;
        vertical-align: top;
    }

    .data-table tbody tr:nth-child(even) td {
        background: #f8faf9;
    }

    .text-center {
        text-align: center;
    }

    .empty-data {
        padding: 30px;
        text-align: center;
        border: 1px solid #dddddd;
        color: #777777;
    }

    .footer {
        margin-top: 25px;
        padding-top: 10px;
        border-top: 1px solid #dddddd;
    }

    .footer-table {
        width: 100%;
        border-collapse: collapse;
    }

    .footer-left {
        width: 65%;
        color: #777777;
        font-size: 8px;
    }

    .footer-right {
        width: 35%;
        text-align: right;
        color: #777777;
        font-size: 8px;
    }

    .signature {
        margin-top: 35px;
        text-align: right;
    }

    .signature-title {
        margin-bottom: 45px;
    }

    .signature-name {
        font-weight: bold;
        text-decoration: underline;
    }

    .page-break {
        page-break-after: always;
    }

</style>
```

</head>

<body>

```
{{-- HEADER --}}
<div class="header">

    <table class="header-table">

        <tr>

            <td class="header-left">

                <p class="header-title">
                    KELURAHAN BINONG
                </p>

                <p class="header-subtitle">
                    Sistem Informasi Administrasi Kelurahan
                </p>

            </td>

            <td class="header-right">

                <span class="document-label">
                    LAPORAN BULANAN
                </span>

            </td>

        </tr>

    </table>

</div>


{{-- JUDUL --}}
<h1 class="report-title">
    {{ $namaMenu }}
</h1>

<p class="report-period">
    Periode {{ $namaBulan }} {{ $tahun }}
</p>


{{-- INFORMASI LAPORAN --}}
<table class="information-table">

    <tr>

        <td class="information-label">
            Kelurahan
        </td>

        <td class="information-value">
            Kelurahan Binong
        </td>

        <td class="information-label">
            Periode
        </td>

        <td class="information-value">
            {{ $namaBulan }} {{ $tahun }}
        </td>

    </tr>

    <tr>

        <td class="information-label">
            Jenis Data
        </td>

        <td class="information-value">
            {{ $namaMenu }}
        </td>

        <td class="information-label">
            Jumlah Data
        </td>

        <td class="information-value">
            {{ $data->count() }} Data
        </td>

    </tr>

    <tr>

        <td class="information-label">
            Dicetak
        </td>

        <td colspan="3">
            {{ now()->format('d/m/Y H:i') }} WIB
        </td>

    </tr>

</table>


{{-- DATA PKL --}}
@if($menu === 'datapkl')

    <p class="data-title">
        Daftar Data PKL
    </p>

    @if($data->count())

        <table class="data-table">

            <thead>

                <tr>
                    <th width="5%">No</th>
                    <th width="20%">Nama PKL</th>
                    <th width="17%">Jenis Dagangan</th>
                    <th width="23%">Lokasi</th>
                    <th width="35%">Keterangan</th>
                </tr>

            </thead>

            <tbody>

                @foreach($data as $index => $item)

                    <tr>

                        <td class="text-center">
                            {{ $index + 1 }}
                        </td>

                        <td>
                            {{ $item->nama_pkl ?: '-' }}
                        </td>

                        <td>
                            {{ $item->jenis_dagangan ?: '-' }}
                        </td>

                        <td>
                            {{ $item->lokasi ?: '-' }}
                        </td>

                        <td>
                            {{ $item->keterangan ?: '-' }}
                        </td>

                    </tr>

                @endforeach

            </tbody>

        </table>

    @else

        <div class="empty-data">
            Belum terdapat data PKL.
        </div>

    @endif


{{-- DATA RT RW --}}
@elseif($menu === 'datartrw')

    <p class="data-title">
        Daftar Data RT & RW
    </p>

    @if($data->count())

        <table class="data-table">

            <thead>

                <tr>
                    <th width="5%">No</th>
                    <th>Nomor RT</th>
                    <th>Nama Ketua RT</th>
                    <th>Nomor RW</th>
                    <th>Nama Ketua RW</th>
                    <th>Tanggal Mulai</th>
                    <th>Tanggal Berakhir</th>
                </tr>

            </thead>

            <tbody>

                @foreach($data as $index => $item)

                    <tr>

                        <td class="text-center">
                            {{ $index + 1 }}
                        </td>

                        <td>
                            {{ $item->nomor_rt ?: '-' }}
                        </td>

                        <td>
                            {{ $item->nama_rt ?: '-' }}
                        </td>

                        <td>
                            {{ $item->nomor_rw ?: '-' }}
                        </td>

                        <td>
                            {{ $item->nama_rw ?: '-' }}
                        </td>

                        <td class="text-center">
                            {{ $item->tanggal_mulai ? $item->tanggal_mulai->format('d/m/Y') : '-' }}
                        </td>

                        <td class="text-center">
                            {{ $item->tanggal_berakhir ? $item->tanggal_berakhir->format('d/m/Y') : '-' }}
                        </td>

                    </tr>

                @endforeach

            </tbody>

        </table>

    @else

        <div class="empty-data">
            Belum terdapat data RT & RW.
        </div>

    @endif


{{-- DATA LINMAS --}}
@elseif($menu === 'datalinmas')

    <p class="data-title">
        Daftar Data Linmas & Siskamling
    </p>

    @if($data->count())

        <table class="data-table">

            <thead>

                <tr>
                    <th width="4%">No</th>
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

                        <td class="text-center">
                            {{ $index + 1 }}
                        </td>

                        <td>
                            {{ $item->rw ?: '-' }}
                        </td>

                        <td class="text-center">
                            {{ $item->jumlah_linmas ?? 0 }}
                        </td>

                        <td>
                            {{ $item->nama ?: '-' }}
                        </td>

                        <td>
                            {{ $item->nik ?: '-' }}
                        </td>

                        <td>
                            {{ $item->alamat ?: '-' }}
                        </td>

                        <td>
                            {{ $item->pekerjaan ?: '-' }}
                        </td>

                        <td class="text-center">
                            {{ $item->jumlah_poskamling ?? 0 }}
                        </td>

                        <td>
                            {{ $item->titik_poskamling ?: '-' }}
                        </td>

                    </tr>

                @endforeach

            </tbody>

        </table>

    @else

        <div class="empty-data">
            Belum terdapat data Linmas & Siskamling.
        </div>

    @endif


{{-- DATA UMKM --}}
@elseif($menu === 'dataumkm')

    <p class="data-title">
        Daftar Data UMKM
    </p>

    @if($data->count())

        <table class="data-table">

            <thead>

                <tr>
                    <th width="5%">No</th>
                    <th>Nama UMKM</th>
                    <th>Jenis Usaha</th>
                    <th>Alamat</th>
                    <th>Keterangan</th>
                </tr>

            </thead>

            <tbody>

                @foreach($data as $index => $item)

                    <tr>

                        <td class="text-center">
                            {{ $index + 1 }}
                        </td>

                        <td>
                            {{ $item->nama_umkm ?? '-' }}
                        </td>

                        <td>
                            {{ $item->jenis_usaha ?? '-' }}
                        </td>

                        <td>
                            {{ $item->alamat ?? '-' }}
                        </td>

                        <td>
                            {{ $item->keterangan ?? '-' }}
                        </td>

                    </tr>

                @endforeach

            </tbody>

        </table>

    @else

        <div class="empty-data">
            Belum terdapat data UMKM.
        </div>

    @endif


{{-- MENU LAINNYA --}}
@else

    <p class="data-title">
        Data {{ $namaMenu }}
    </p>

    @if($data->count())

        <table class="data-table">

            <thead>

                <tr>
                    <th width="5%">No</th>
                    <th>Data</th>
                </tr>

            </thead>

            <tbody>

                @foreach($data as $index => $item)

                    <tr>

                        <td class="text-center">
                            {{ $index + 1 }}
                        </td>

                        <td>
                            Data {{ $index + 1 }}
                        </td>

                    </tr>

                @endforeach

            </tbody>

        </table>

    @else

        <div class="empty-data">
            Belum terdapat data yang dapat dilaporkan.
        </div>

    @endif

@endif


{{-- FOOTER --}}
<div class="footer">

    <table class="footer-table">

        <tr>

            <td class="footer-left">
                Dokumen ini dibuat melalui Sistem Informasi Administrasi
                Kelurahan Binong.
            </td>

            <td class="footer-right">
                Dicetak {{ now()->format('d/m/Y H:i') }} WIB
            </td>

        </tr>

    </table>

</div>
```

</body>

</html>
