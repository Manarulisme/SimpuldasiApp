@extends('Admin.Layout.master')

@section('title', 'Dashboard - Kelurahan XXXXX')
@section('page_title', 'Beranda')
@section('page_subtitle', 'Dashboard Sistem Informasi Kelurahan')

@push('styles')
<style>
    .welcome { background: linear-gradient(110deg, #087443, #0d8650); color: white; border-radius: 12px; padding: 30px; margin-bottom: 25px; }
    .welcome small { font-size: 12px; opacity: 0.8; }
    .welcome h2 { font-family: Georgia, serif; font-size: 27px; margin: 8px 0 10px; }
    .welcome p { font-size: 13px; line-height: 1.7; opacity: 0.9; max-width: 700px; }
    .stats-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 18px; margin-bottom: 25px; }
    .stat-card, .panel { background: white; border: 1px solid var(--border); border-radius: 10px; }
    .stat-card { padding: 21px; display: flex; align-items: center; gap: 15px; }
    .stat-icon { width: 49px; height: 49px; border-radius: 9px; background: var(--primary-light); color: var(--primary); display: flex; align-items: center; justify-content: center; font-size: 21px; }
    .stat-info span, .stat-info strong { display: block; }
    .stat-info span { color: var(--muted); font-size: 11px; margin-bottom: 4px; }
    .stat-info strong { font-size: 25px; color: #18364d; }
    .dashboard-grid { display: grid; grid-template-columns: 1.45fr 1fr; gap: 20px; }
    .panel { overflow: hidden; }
    .panel-header { padding: 20px 22px; border-bottom: 1px solid var(--border); display: flex; align-items: center; justify-content: space-between; }
    .panel-header h3 { font-size: 16px; color: #18364d; }
    .panel-header a { font-size: 12px; color: var(--primary); font-weight: 600; }
    .panel-body { padding: 20px 22px; }
    .activity { display: flex; gap: 12px; padding: 13px 0; border-bottom: 1px solid var(--border); }
    .activity:last-child { border-bottom: 0; }
    .activity-icon { width: 34px; height: 34px; border-radius: 50%; background: var(--primary-light); color: var(--primary); display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
    .activity-content { flex: 1; }
    .activity-content strong, .activity-content p { display: block; }
    .activity-content strong { font-size: 12px; margin-bottom: 3px; }
    .activity-content p { color: var(--muted); font-size: 11px; }
    .quick-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 12px; }
    .quick-card { border: 1px solid var(--border); border-radius: 8px; padding: 18px 12px; text-align: center; }
    .quick-icon { width: 40px; height: 40px; border-radius: 8px; background: var(--primary-light); color: var(--primary); margin: 0 auto 10px; display: flex; align-items: center; justify-content: center; }
    .quick-card strong { display: block; font-size: 12px; line-height: 1.4; }
    @media (max-width: 1100px) { .stats-grid { grid-template-columns: repeat(2, 1fr); } .dashboard-grid { grid-template-columns: 1fr; } }
    @media (max-width: 600px) { .stats-grid { grid-template-columns: 1fr; } .quick-grid { grid-template-columns: repeat(2, 1fr); } .welcome { padding: 24px; } .welcome h2 { font-size: 23px; } }
</style>
@endpush

@section('content')
<section class="welcome">
    <small>SISTEM INFORMASI KELURAHAN</small>
    <h2>Selamat Datang, Administrator</h2>
    <p>Kelola data dan informasi Kelurahan XXXXX melalui dashboard ini. Pastikan seluruh data pelayanan dan administrasi selalu diperbarui secara berkala.</p>
</section>

<section class="stats-grid">
    <div class="stat-card"><div class="stat-icon">👥</div><div class="stat-info"><span>Total Penduduk</span><strong>0</strong></div></div>
    <div class="stat-card"><div class="stat-icon">▣</div><div class="stat-info"><span>Total KPM</span><strong>5</strong></div></div>
    <div class="stat-card"><div class="stat-icon">♡</div><div class="stat-info"><span>Posyandu</span><strong>5</strong></div></div>
    <div class="stat-card"><div class="stat-icon">▤</div><div class="stat-info"><span>Data Sekolah</span><strong>5</strong></div></div>
</section>

<div class="dashboard-grid">
    <section class="panel">
        <div class="panel-header"><h3>Akses Cepat</h3></div>
        <div class="panel-body quick-grid">
            <a href="{{ url('/dataumumpegawai') }}" class="quick-card"><div class="quick-icon">👤</div><strong>Data Kepegawaian</strong></a>
            <a href="{{ url('/databmd') }}" class="quick-card"><div class="quick-icon">▣</div><strong>Data BMD</strong></a>
            <a href="{{ url('/dataposyandu') }}" class="quick-card"><div class="quick-icon">♡</div><strong>Posyandu</strong></a>
            <a href="{{ url('/datakpm') }}" class="quick-card"><div class="quick-icon">♢</div><strong>KPM / Bantuan Sosial</strong></a>
            <a href="{{ url('/datastunting') }}" class="quick-card"><div class="quick-icon">♧</div><strong>Data Stunting</strong></a>
            <a href="{{ url('/datasekolah') }}" class="quick-card"><div class="quick-icon">▤</div><strong>Data Sekolah</strong></a>
        </div>
    </section>

    <section class="panel">
        <div class="panel-header"><h3>Aktivitas Terbaru</h3></div>
        <div class="panel-body">
            <div class="activity"><div class="activity-icon">✓</div><div class="activity-content"><strong>Dashboard aktif</strong><p>Layout master berhasil digunakan.</p></div></div>
            <div class="activity"><div class="activity-icon">+</div><div class="activity-content"><strong>Modul data tersedia</strong><p>Gunakan menu di sidebar untuk membuka data.</p></div></div>
            <div class="activity"><div class="activity-icon">i</div><div class="activity-content"><strong>Informasi sistem</strong><p>Pastikan data diperbarui secara berkala.</p></div></div>
        </div>
    </section>
</div>
@endsection
