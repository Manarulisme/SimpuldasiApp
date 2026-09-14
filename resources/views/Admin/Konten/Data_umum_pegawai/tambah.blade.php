@php
    $isEdit = $isEdit ?? false;
    $pegawaiValue = fn (string $key, mixed $default = '') => old($key, data_get($pegawai ?? null, $key, $default));
@endphp
@extends('Admin.Layout.master')

@section('title', ($isEdit ? 'Edit' : 'Tambah') . ' Data Kepegawaian - Kelurahan XXXXX')
@section('page_title', ($isEdit ? 'Edit' : 'Tambah') . ' Data Kepegawaian')
@section('page_subtitle', 'Kesekretariatan · Data Umum Kepegawaian · ' . ($isEdit ? 'Edit Data' : 'Tambah Data'))

@push('styles')
<style>
    .breadcrumb { display: flex; gap: 8px; color: var(--muted); font-size: 12px; margin-bottom: 18px; }
    .breadcrumb a { color: var(--primary); }
    .page-title-block { margin-bottom: 25px; }
    .page-title-block h2 { color: #18364d; font-family: Georgia, serif; font-size: 27px; margin-bottom: 7px; }
    .page-title-block p { color: var(--muted); font-size: 13px; }
    .form-card { background: white; border: 1px solid var(--border); border-radius: 10px; overflow: hidden; }
    .form-header, .form-footer { background: #fbfcfc; padding: 22px 25px; border-bottom: 1px solid var(--border); }
    .form-header h3 { color: #18364d; font-size: 17px; margin-bottom: 5px; }
    .form-header p, .form-help, .required-note { color: var(--muted); font-size: 12px; }
    .form-body { padding: 28px 25px; }
    .form-section { margin-bottom: 30px; }
    .section-title { display: flex; align-items: center; gap: 10px; color: #18364d; font-size: 14px; font-weight: bold; padding-bottom: 12px; margin-bottom: 20px; border-bottom: 1px solid var(--border); }
    .section-number { width: 25px; height: 25px; border-radius: 50%; background: var(--primary-light); color: var(--primary); display: flex; align-items: center; justify-content: center; }
    .form-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px 25px; }
    .form-group { display: flex; flex-direction: column; }
    .form-group.full { grid-column: 1 / -1; }
    .form-group label { color: var(--text); font-size: 12px; font-weight: bold; margin-bottom: 8px; }
    .required { color: #c0392b; }
    .form-control { width: 100%; height: 43px; border: 1px solid #dce2e5; border-radius: 7px; padding: 0 13px; font: 13px Arial, sans-serif; color: var(--text); background: white; }
    textarea.form-control { height: 100px; padding: 12px 13px; resize: vertical; }
    .form-control:focus { border-color: var(--primary); outline: none; box-shadow: 0 0 0 3px rgba(8,116,67,0.08); }
    .form-help { margin-top: 6px; font-size: 11px; }
    .info-box { display: flex; gap: 12px; align-items: flex-start; padding: 14px 16px; background: var(--primary-light); border: 1px solid #d7ecdf; border-radius: 8px; }
    .info-icon { width: 24px; height: 24px; flex-shrink: 0; border-radius: 50%; background: var(--primary); color: white; display: flex; align-items: center; justify-content: center; }
    .info-box p { color: #416052; font-size: 12px; line-height: 1.6; }
    .form-footer { display: flex; justify-content: space-between; align-items: center; border-top: 1px solid var(--border); border-bottom: 0; }
    .form-actions { display: flex; gap: 10px; }
    .btn { height: 42px; padding: 0 20px; border: 0; border-radius: 7px; display: inline-flex; align-items: center; justify-content: center; font-size: 12px; font-weight: bold; cursor: pointer; }
    .btn-secondary { background: white; color: var(--text); border: 1px solid #dce2e5; }
    .btn-primary { background: var(--primary); color: white; }
    @media (max-width: 700px) { .form-grid { grid-template-columns: 1fr; } .form-group.full { grid-column: auto; } .form-footer { align-items: stretch; flex-direction: column; gap: 15px; } .form-actions .btn { flex: 1; } }
</style>
@endpush

@section('content')
<div class="breadcrumb"><a href="{{ url('/dashboard') }}">Beranda</a><span>›</span><a href="{{ url('/dataumumpegawai') }}">Data Kepegawaian</a><span>›</span><span>{{ $isEdit ? 'Edit Data' : 'Tambah Data' }}</span></div>
<div class="page-title-block">
    <h2>{{ $isEdit ? 'Edit Data Umum Kepegawaian' : 'Tambah Data Umum Kepegawaian' }}</h2>
    <p>{{ $isEdit ? 'Perbarui informasi pegawai pada Data Umum Kepegawaian Kelurahan XXXXX.' : 'Tambahkan data pegawai baru ke dalam Data Umum Kepegawaian Kelurahan XXXXX.' }}</p>
</div>

<div class="form-card">
    <div class="form-header">
        <h3>{{ $isEdit ? 'Edit Data Pegawai' : 'Form Data Pegawai' }}</h3>
        <p>{{ $isEdit ? 'Perbarui informasi pegawai pada kolom yang tersedia.' : 'Silakan lengkapi informasi pegawai pada kolom yang tersedia.' }}</p>
    </div>
    <form id="pegawaiForm" method="POST" action="{{ url()->current() }}">
        @csrf
        @if ($isEdit) @method('PUT') @endif
        <div class="form-body">
            <div class="form-section">
                <div class="section-title"><span class="section-number">1</span>Data Identitas Pegawai</div>
                <div class="form-grid">
                    <div class="form-group"><label for="jenis">Jenis Pegawai <span class="required">*</span></label><select id="jenis" name="jenis" class="form-control" required><option value="">Pilih Jenis Pegawai</option><option value="ASN" @selected($pegawaiValue('jenis') === 'ASN')>ASN</option><option value="PPPK" @selected($pegawaiValue('jenis') === 'PPPK')>PPPK</option><option value="Non-ASN" @selected($pegawaiValue('jenis') === 'Non-ASN')>Non-ASN</option></select></div>
                    <div class="form-group"><label for="nomor">NIP / NRP / TT <span class="required">*</span></label><input type="text" id="nomor" name="nomor" class="form-control" placeholder="Masukkan NIP / NRP / TT" value="{{ $pegawaiValue('nomor') }}" required><span class="form-help">Sesuaikan dengan jenis dan status kepegawaian.</span></div>
                    <div class="form-group full"><label for="nama">Nama Lengkap <span class="required">*</span></label><input type="text" id="nama" name="nama" class="form-control" placeholder="Masukkan nama lengkap pegawai" value="{{ $pegawaiValue('nama') }}" required></div>
                </div>
            </div>
            <div class="form-section">
                <div class="section-title"><span class="section-number">2</span>Data Kepegawaian</div>
                <div class="form-grid">
                    <div class="form-group"><label for="golongan">Golongan <span class="required">*</span></label><select id="golongan" name="golongan" class="form-control" required><option value="">Pilih Golongan</option>@foreach (['I/a','I/b','I/c','I/d','II/a','II/b','II/c','II/d','III/a','III/b','III/c','III/d','IV/a','IV/b','IV/c','IV/d','IV/e','IX'] as $golongan)<option value="{{ $golongan }}" @selected($pegawaiValue('golongan') === $golongan)>{{ $golongan }}</option>@endforeach</select></div>
                    <div class="form-group"><label for="pangkat">Pangkat <span class="required">*</span></label><input type="text" id="pangkat" name="pangkat" class="form-control" placeholder="Contoh: Penata" value="{{ $pegawaiValue('pangkat') }}" required></div>
                    <div class="form-group full"><label for="jabatan">Jabatan <span class="required">*</span></label><input type="text" id="jabatan" name="jabatan" class="form-control" placeholder="Contoh: Kasi Pemerintahan" value="{{ $pegawaiValue('jabatan') }}" required></div>
                </div>
            </div>
            <div class="form-section">
                <div class="section-title"><span class="section-number">3</span>Keterangan</div>
                <div class="form-grid"><div class="form-group full"><label for="keterangan">Keterangan Tambahan</label><textarea id="keterangan" name="keterangan" class="form-control" placeholder="Masukkan keterangan tambahan jika diperlukan...">{{ $pegawaiValue('keterangan') }}</textarea></div></div>
            </div>
            <div class="info-box"><div class="info-icon">i</div><p>{{ $isEdit ? 'Periksa kembali perubahan data pegawai sebelum menyimpan.' : 'Pastikan data pegawai yang dimasukkan sudah benar sebelum menyimpan.' }}</p></div>
        </div>
        <div class="form-footer"><div class="required-note"><span class="required">*</span> Wajib diisi</div><div class="form-actions"><a href="{{ url('/dataumumpegawai') }}" class="btn btn-secondary">Batal</a><button type="submit" class="btn btn-primary">{{ $isEdit ? 'Perbarui Data' : 'Simpan Data' }}</button></div></div>
    </form>
</div>
@endsection

@push('scripts')
@if (!$isEdit)
<script>
    document.getElementById('pegawaiForm')?.addEventListener('submit', function (event) {
        event.preventDefault();
        alert('Data pegawai berhasil disimpan!\n\nNama: ' + document.getElementById('nama').value);
        window.location.href = '{{ url('/dataumumpegawai') }}';
    });
</script>
@endif
@endpush
