<!DOCTYPE html>

<html lang="id">

<head>


<meta charset="UTF-8">

<title>
    {{ $namaMenu }} - {{ $namaBulan }} {{ $tahun }}
</title>

<style>

    @page {
        margin: 25px 30px;
    }

    body {
        font-family: DejaVu Sans, sans-serif;
        font-size: 9px;
        color: #333333;
        margin: 0;
    }

    .header {
        width: 100%;
        border-bottom: 2px solid #087443;
        padding-bottom: 12px;
        margin-bottom: 18px;
    }

    .header-table {
        width: 100%;
        border-collapse: collapse;
    }

    .header-title {
        width: 70%;
    }

    .header-title h1 {
        margin: 0;
        font-size: 18px;
        color: #102f47;
    }

    .header-title h2 {
        margin: 4px 0 0;
        font-size: 11px;
        color: #087443;
        font-weight: normal;
    }

    .header-right {
        width: 30%;
        text-align: right;
        vertical-align: top;
        font-size: 9px;
        color: #666666;
    }

    .header-right strong {
        color: #102f47;
        font-size: 10px;
    }

    .report-info {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 18px;
    }

    .report-info td {
        border: 1px solid #dddddd;
        padding: 7px 9px;
    }

    .report-info .label {
        width: 18%;
        background: #f5f7f6;
        color: #555555;
        font-weight: bold;
    }

    .section-title {
        font-size: 12px;
        color: #102f47;
        font-weight: bold;
        margin: 0 0 9px;
    }

    .data-table {
        width: 100%;
        border-collapse: collapse;
        table-layout: auto;
    }

    .data-table th {
        background: #087443;
        color: #ffffff;
        border: 1px solid #066437;
        padding: 6px 5px;
        text-align: left;
        font-size: 8px;
        font-weight: bold;
    }

    .data-table td {
        border: 1px solid #dcdcdc;
        padding: 5px;
        vertical-align: top;
        font-size: 8px;
    }

    .data-table tr:nth-child(even) td {
        background: #f8faf9;
    }

    .number {
        width: 30px;
        text-align: center !important;
    }

    .text-wrap {
        word-wrap: break-word;
        overflow-wrap: break-word;
    }

    .empty {
        text-align: center;
        padding: 35px;
        color: #777777;
        border: 1px solid #dddddd;
    }

    .footer {
        position: fixed;
        bottom: -5px;
        left: 0;
        right: 0;
        text-align: center;
        font-size: 7px;
        color: #888888;
    }

    .page-number:after {
        content: counter(page);
    }

</style>


</head>

<body>

<div class="header">


<table class="header-table">

    <tr>

        <td class="header-title">

            <h1>
                SIMPULDASI
            </h1>

            <h2>
                Sistem Pengumpulan Data Terintegrasi
            </h2>

        </td>

        <td class="header-right">

            <strong>
                LAPORAN BULANAN
            </strong>

            <br>

            {{ $namaBulan }} {{ $tahun }}

        </td>

    </tr>

</table>


</div>

<table class="report-info">


<tr>

    <td class="label">
        Kelurahan
    </td>

    <td>
        Kelurahan Binong
    </td>

    <td class="label">
        Periode
    </td>

    <td>
        {{ $namaBulan }} {{ $tahun }}
    </td>

</tr>

<tr>

    <td class="label">
        Jenis Data
    </td>

    <td colspan="3">
        {{ $namaMenu }}
    </td>

</tr>

<tr>

    <td class="label">
        Jumlah Data
    </td>

    <td colspan="3">
        {{ $data->count() }} Data
    </td>

</tr>


</table>

<div class="section-title">


Data {{ $namaMenu }}


</div>

@if($data->count())


@if($menu === 'datapkl')

    <table class="data-table">

        <thead>

            <tr>
                <th class="number">No</th>
                <th>Nama PKL</th>
                <th>Jenis Dagangan</th>
                <th>Lokasi</th>
                <th>Keterangan</th>
            </tr>

        </thead>

        <tbody>

            @foreach($data as $index => $item)

                <tr>

                    <td class="number">
                        {{ $index + 1 }}
                    </td>

                    <td>
                        {{ $item->nama_pkl ?: '-' }}
                    </td>

                    <td>
                        {{ $item->jenis_dagangan ?: '-' }}
                    </td>

                    <td class="text-wrap">
                        {{ $item->lokasi ?: '-' }}
                    </td>

                    <td class="text-wrap">
                        {{ $item->keterangan ?: '-' }}
                    </td>

                </tr>

            @endforeach

        </tbody>

    </table>

@elseif($menu === 'datartrw')

    <table class="data-table">

        <thead>

            <tr>
                <th class="number">No</th>
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

                    <td class="number">
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

    <table class="data-table">

        <thead>

            <tr>
                <th class="number">No</th>
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

                    <td class="number">
                        {{ $index + 1 }}
                    </td>

                    <td>
                        {{ $item->rw ?: '-' }}
                    </td>

                    <td>
                        {{ $item->jumlah_linmas ?? 0 }}
                    </td>

                    <td>
                        {{ $item->nama ?: '-' }}
                    </td>

                    <td>
                        {{ $item->nik ?: '-' }}
                    </td>

                    <td class="text-wrap">
                        {{ $item->alamat ?: '-' }}
                    </td>

                    <td>
                        {{ $item->pekerjaan ?: '-' }}
                    </td>

                    <td>
                        {{ $item->jumlah_poskamling ?? 0 }}
                    </td>

                    <td class="text-wrap">
                        {{ $item->titik_poskamling ?: '-' }}
                    </td>

                </tr>

            @endforeach

        </tbody>

    </table>

@elseif($menu === 'dataumkm')

    <table class="data-table">

        <thead>

            <tr>
                <th class="number">No</th>
                <th>Nama Pelaku</th>
                <th>Jenis Usaha</th>
                <th>Alamat</th>
                <th>Keterangan</th>
            </tr>

        </thead>

        <tbody>

            @foreach($data as $index => $item)

                <tr>

                    <td class="number">
                        {{ $index + 1 }}
                    </td>

                    <td>
                        {{ $item->nama_pelaku_usaha ?? '-' }}
                    </td>

                    <td>
                        {{ $item->jenis_usaha ?? '-' }}
                    </td>

                    <td class="text-wrap">
                        {{ $item->alamat_usaha ?? '-' }}
                    </td>

                    <td class="text-wrap">
                        {{ $item->keterangan ?? '-' }}
                    </td>

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

            $columns = array_keys(
                $firstItem->getAttributes()
            );

            $columns = array_values(
                array_filter(
                    $columns,
                    function ($column) use ($excludeColumns) {

                        return !in_array(
                            $column,
                            $excludeColumns
                        );

                    }
                )
            );

        }

    @endphp

    @if(count($columns))

        <table class="data-table">

            <thead>

                <tr>

                    <th class="number">
                        No
                    </th>

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

                        <td class="number">
                            {{ $index + 1 }}
                        </td>

                        @foreach($columns as $column)

                            @php
                                $value = $item->{$column};
                            @endphp

                            <td class="text-wrap">

                                @if(
                                    is_null($value) ||
                                    $value === ''
                                )

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

        <div class="empty">

            Data tersedia tetapi tidak terdapat
            kolom yang dapat ditampilkan.

        </div>

    @endif

@endif


@else


<div class="empty">

    Belum terdapat data untuk
    {{ $namaMenu }}
    pada laporan ini.

</div>


@endif

<div class="footer">


SIMPULDASI · Kelurahan Binong
&nbsp; | &nbsp;
Laporan {{ $namaMenu }}
&nbsp; | &nbsp;
Halaman <span class="page-number"></span>


</div>

</body>

</html>
