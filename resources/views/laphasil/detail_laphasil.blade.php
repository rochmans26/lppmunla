@extends('layouts.master')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Detail Laporan Hasil</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><strong>{{ $data->judul_pkm }}</strong></h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">
                        <div class="row">
                            <div class="col-12 col-sm-4">
                                <div class="info-box bg-light">
                                    <div class="info-box-content">
                                        <span class="info-box-text text-center text-muted">Tahun Usulan</span>
                                        <span
                                            class="info-box-number text-center text-muted mb-0">{{ $data->thn_usulan }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-4">
                                <div class="info-box bg-light">
                                    <div class="info-box-content">
                                        <span class="info-box-text text-center text-muted">Tahun Kegiatan</span>
                                        <span
                                            class="info-box-number text-center text-muted mb-0">{{ $data->thn_kegiatan }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-4">
                                <div class="info-box bg-light">
                                    <div class="info-box-content">
                                        <span class="info-box-text text-center text-muted">Tahun Pelaksanaan</span>
                                        <span
                                            class="info-box-number text-center text-muted mb-0">{{ $data->thn_pelaksanaan }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <h4>Bidang</h4>
                                <div class="post">
                                    <p>{{ $data->nm_bidang }}</p>
                                </div>
                                <h4>Jenis Skim</h4>
                                <div class="post">
                                    <p>{{ $data->nm_skim }}</p>
                                </div>
                                <h4>Mitra PKM</h4>
                                <div class="post">
                                    <p>{{ $data->mitra_pkm }}</p>
                                </div>
                                <h4>Total Pendanaan</h4>
                                <div class="post">
                                    <p>
                                        {{ 'Rp. ' . number_format($total) . ',-' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-12 col-lg-4 order-1 order-md-2">
                        <a href="{{ $data->dok_link }}" target="_blank">
                            <h3 class="text-primary"><i class="fas fa-file"></i> Files</h3>
                        </a>
                        <br>
                        <div class="text-muted">
                            <p class="text-sm">Buka Link di
                                <b class="d-block">Google Drive</b>
                            </p>
                        </div>
                        <div class="text-muted">
                            <p class="text-sm">Lokasi Kegiatan
                                <b class="d-block">{{ $data->lok_kegiatan }}</b>
                            </p>
                            <p class="text-sm">Pendanaan
                                <b class="d-block">Dana Dikti :
                                    {{ $data->dana_dikti != null ? 'Rp. ' . number_format($data->dana_dikti) : '-' }}</b>
                                <b class="d-block">Dana Unla :
                                    {{ $data->dana_unla != null ? 'Rp.' . number_format($data->dana_unla) : '-' }}</b>
                                <b class="d-block">Dana Lainnya :
                                    {{ $data->dana_lainnya != null ? 'Rp.' . number_format($data->dana_lainnya) : '-' }}</b>
                            </p>
                            <p class="text-sm">No. SK
                                <b class="d-block">{{ $data->nosk_pkm }}</b>
                            </p>
                            <p class="text-sm">Tanggal SK
                                <b class="d-block">{{ $data->tglsk_pkm }}</b>
                            </p>
                            <p class="text-sm">Referensi Proposal
                                <b class="d-block">
                                    @if (Auth::user()->level == 'sp-admin')
                                        <a href="/sp-admin/proposals/{{ $data->id_proposal }}" class="btn-sm btn-primary"
                                            target="_blank">Click
                                            for Detail</a>
                                    @else
                                        <a href="/admin/proposals/{{ $data->id_proposal }}" class="btn-sm btn-primary"
                                            target="_blank">Click
                                            for Detail</a>
                                    @endif
                                </b>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        </div>

        {{-- Anggota Mahasiswa --}}
        @livewire('proposal-anggotadosen', ['params' => $data->id_proposal])
        @livewire('proposal-anggotamhs', ['params' => $data->id_proposal])
        @livewire('proposal-anggotadosluar', ['params' => $data->id_proposal])
    </section>
@endsection
