@extends('layouts.master')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Detail Proposal</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ $data->judul_proposal }}</h3>

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
