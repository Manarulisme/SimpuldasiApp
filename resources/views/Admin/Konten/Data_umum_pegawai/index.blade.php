@extends('Admin.Layout.master')

@section('title', 'Data Umum Kepegawaian - Kelurahan XXXXX')
@section('page_title', 'Data Umum Kepegawaian')
@section('page_subtitle', 'Kesekretariatan · Data Umum Kepegawaian')

@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.min.css">
<style>
    .content-header, .table-panel-header { display: flex; align-items: center; justify-content: space-between; gap: 18px; }
    .content-header { margin-bottom: 25px; }
    .content-header h2 { color: #18364d; font-family: Georgia, serif; font-size: 26px; }
    .content-header p, .table-panel-header p { color: var(--muted); font-size: 12px; margin-top: 6px; }
    .btn-add { display: inline-flex; align-items: center; gap: 8px; background: var(--primary); color: white; border: 0; border-radius: 7px; padding: 11px 16px; font-size: 12px; font-weight: bold; cursor: pointer; }
    .btn-add:hover { background: #065c35; }
    .table-panel { background: white; border: 1px solid var(--border); border-radius: 10px; overflow: hidden; }
    .table-panel-header { padding: 20px 22px; border-bottom: 1px solid var(--border); }
    .table-panel-header h3 { color: #18364d; font-size: 16px; }
    .total-data { color: var(--primary); background: var(--primary-light); border-radius: 20px; padding: 6px 10px; font-size: 11px; font-weight: 600; white-space: nowrap; }
    .table-wrapper { padding: 0 22px 20px; overflow-x: auto; }
    #pegawaiTable { width: 100% !important; border-collapse: collapse !important; margin-top: 15px !important; }
    #pegawaiTable thead th { background: #f8faf9; color: #52616b; font-size: 11px; padding: 13px 12px; white-space: nowrap; }
    #pegawaiTable tbody td { padding: 14px 12px; font-size: 12px; border-bottom: 1px solid #f0f2f3; vertical-align: middle; }
    .badge { display: inline-block; padding: 5px 9px; border-radius: 5px; font-size: 10px; font-weight: 600; }
    .badge-asn { background: var(--primary-light); color: var(--primary); }
    .badge-pppk { background: #fff7df; color: #987500; }
    .badge-gol { background: #f1f3f4; color: #58636a; }
    .employee-name { color: #18364d; font-weight: 600; }
    .employee-id { color: #8a969d; font-size: 10px; margin-top: 3px; }
    .action-buttons { display: flex; gap: 6px; }
    .action-btn { width: 31px; height: 31px; border: 1px solid var(--border); border-radius: 6px; background: white; cursor: pointer; }
    .action-edit { color: var(--primary); }
    .action-delete { color: #c0392b; }
    @media (max-width: 700px) { .content-header { align-items: flex-start; flex-direction: column; } }
</style>
@endpush

@section('content')
<div class="content-header">
    <div>
        <h2>Data Umum Kepegawaian</h2>
        <p>Kelola data pegawai dan aparatur Kelurahan XXXXX.</p>
    </div>
    <a href="{{ url('/tambah-data-umum-kepegawaian') }}" class="btn-add">+ Tambah Data</a>
</div>

<section class="table-panel">
    <div class="table-panel-header">
        <div>
            <h3>Daftar Pegawai</h3>
            <p>Data Umum Kepegawaian Kelurahan XXXXX</p>
        </div>
        <span class="total-data" id="totalData">5 Pegawai</span>
    </div>
    <div class="table-wrapper">
        <table id="pegawaiTable" class="display">
            <thead>
                <tr><th>Jenis</th><th>NIP / NRP / TT</th><th>Nama</th><th>Golongan</th><th>Pangkat</th><th>Jabatan</th><th>Aksi</th></tr>
            </thead>
            <tbody>
                <tr><td><span class="badge badge-asn">ASN</span></td><td>19780512 200501 1 001</td><td><div class="employee-name">Ahmad Hidayat</div><div class="employee-id">Pegawai 001</div></td><td><span class="badge badge-gol">III/d</span></td><td>Pembina Tk. I</td><td>Lurah</td><td><div class="action-buttons"><button class="action-btn action-edit" onclick="editData(this)" title="Ubah">✎</button><button class="action-btn action-delete" onclick="hapusData(this)" title="Hapus">×</button></div></td></tr>
                <tr><td><span class="badge badge-asn">ASN</span></td><td>19820415 200701 2 002</td><td><div class="employee-name">Siti Rahmawati</div><div class="employee-id">Pegawai 002</div></td><td><span class="badge badge-gol">III/c</span></td><td>Penata</td><td>Sekretaris Kelurahan</td><td><div class="action-buttons"><button class="action-btn action-edit" onclick="editData(this)" title="Ubah">✎</button><button class="action-btn action-delete" onclick="hapusData(this)" title="Hapus">×</button></div></td></tr>
                <tr><td><span class="badge badge-asn">ASN</span></td><td>19870622 201001 1 003</td><td><div class="employee-name">Budi Santoso</div><div class="employee-id">Pegawai 003</div></td><td><span class="badge badge-gol">III/b</span></td><td>Penata Muda Tk. I</td><td>Kasi Pemerintahan</td><td><div class="action-buttons"><button class="action-btn action-edit" onclick="editData(this)" title="Ubah">✎</button><button class="action-btn action-delete" onclick="hapusData(this)" title="Hapus">×</button></div></td></tr>
                <tr><td><span class="badge badge-asn">ASN</span></td><td>19900318 201502 2 004</td><td><div class="employee-name">Dewi Lestari</div><div class="employee-id">Pegawai 004</div></td><td><span class="badge badge-gol">III/a</span></td><td>Penata Muda</td><td>Kasi Pelayanan</td><td><div class="action-buttons"><button class="action-btn action-edit" onclick="editData(this)" title="Ubah">✎</button><button class="action-btn action-delete" onclick="hapusData(this)" title="Hapus">×</button></div></td></tr>
                <tr><td><span class="badge badge-pppk">PPPK</span></td><td>19940527 202301 1 005</td><td><div class="employee-name">Rudi Hermawan</div><div class="employee-id">Pegawai 005</div></td><td><span class="badge badge-gol">IX</span></td><td>Ahli Pertama</td><td>Staf Pelayanan</td><td><div class="action-buttons"><button class="action-btn action-edit" onclick="editData(this)" title="Ubah">✎</button><button class="action-btn action-delete" onclick="hapusData(this)" title="Hapus">×</button></div></td></tr>
            </tbody>
        </table>
    </div>
</section>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
<script>
    const pegawaiTable = new DataTable('#pegawaiTable', { pageLength: 10, columnDefs: [{ orderable: false, searchable: false, targets: 6 }] });
    pegawaiTable.on('draw', function () { document.getElementById('totalData').textContent = pegawaiTable.page.info().recordsDisplay + ' Pegawai'; });
    function editData(button) { window.location.href = '{{ url('/edit-data-umum-kepegawaian') }}'; }
    function hapusData(button) { if (confirm('Hapus data pegawai ini?')) { button.closest('tr').remove(); } }
</script>
@endpush
