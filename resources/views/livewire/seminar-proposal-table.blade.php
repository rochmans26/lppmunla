<div class="container-fluid">
    {{-- Success is as dangerous as failure. --}}
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">

                    <h1 class="m-0">Seminar Proposal</h1>

                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <div class="container-fluid mb-3">
        <div class="row justify-content-center">
            <div class="col-lg-3 mb-1">
                <input type="text" wire:model='search' class="form-control" placeholder="Cari  Berdasarkan Judul ...">
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row justify-content-center">
            @if (count($sempros) != null)
                @foreach ($sempros as $index => $sempro)
                    <div class="col-md-4 col-sm-6 col-12">
                        <div class="info-box bg-white">
                            <span class="info-box-icon"><i class="far fa-calendar-alt"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">
                                    <h5><strong>{{ $sempro->judul_proposal }}</strong></h5>
                                </span>
                                <strong>Jadwal Seminar</strong>
                                <span class="info-box-text">{{ date('d M Y', strtotime($sempro->tgl_seminar)) }} | Pukul
                                    <strong>{{ $sempro->jam_seminar }}</strong></span>
                                <span class="info-box-text">Sifat : {{ $sempro->sifat_seminar }}</span>

                                <div class="row">
                                    <div class="col">
                                        <strong>Reviewer 1</strong>
                                        <span class="info-box-text">{{ $sempro->reviewer1 }}</span>
                                    </div>
                                    <div class="col">
                                        <strong>Reviewer 2</strong>
                                        <span class="info-box-text">{{ $sempro->reviewer2 }}</span>
                                    </div>
                                </div>
                                <span>
                                    <a href="" data-toggle="modal" data-target="#add_notes"
                                        class="btn-sm btn-success"
                                        wire:click="update({{ $sempro->id_sempro }})">Tambahkan Catatan</a>
                                    <a href="" data-toggle="modal" data-target="#view_notes"
                                        class="btn-sm btn-primary" wire:click="update({{ $sempro->id_sempro }})">Lihat
                                        Catatan</a>
                                </span>
                                <span class="mt-2">
                                    <strong>Dokumen Revisi</strong>
                                </span>
                                @if ($sempro->dok_rev != null)
                                    <a href="{{ $sempro->dok_rev }}" class="btn badge bg-warning" target="_blank">
                                        <span>Lihat Dokumen Revisi</span>
                                    </a>
                                @else
                                    <span class="mt-1">
                                        <a href="" data-toggle="modal" data-target="#add_dokrev"
                                            class="btn-sm btn-danger"
                                            wire:click="update({{ $sempro->id_sempro }})">Upload
                                            Dokumen Revisi</a>
                                    </span>
                                @endif


                                <span class="progress-description">

                                </span>

                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                @endforeach
            @else
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card" style="background-color: #222E3C">
                                <div class="card-body text-center">
                                    <div class="row">
                                        <div class="col-12 col-md-4">
                                            <span style='font-size:80px;'>&#128532;</span>
                                        </div>
                                        <div class="col-12 col-md-4">
                                            <h1 class="fw-bold text-white">Mohon Maaf !<br>Belum Ada Pengajuan
                                                Proposal
                                            </h1>
                                        </div>
                                        <div class="col-12 col-md-4">
                                            <span style='font-size:80px;'>&#128532;</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            @endif
        </div>
    </div>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-1 mb-1">
                {{ $sempros->links() }}
            </div>
        </div>
    </div>

    <!-- Modal Lihat Catatan -->
    <div wire:ignore.self class="modal fade" id="view_notes">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header text-white" style="background-color: #222E3C">
                    <h4 class="modal-title">Catatan</h4>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close"
                        wire:click="ClearForm">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <h5><strong>Catatan Reviewer 1</strong></h5>
                        <textarea class="form-control border-0" id="note_rev1" rows="3" wire:model="note_rev1" readonly></textarea>
                    </div>
                    <div class="container">
                        <h5><strong>Catatan Reviewer 2</strong></h5>
                        <textarea class="form-control border-0" id="note_rev1" rows="3" wire:model="note_rev1" readonly></textarea>
                    </div>
                </div>
                <div class="modal-footer justify-content-end">
                    <button type="button" class="btn btn-default" data-dismiss="modal"
                        wire:click="ClearForm">Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>


    <!-- Modal Tambah Link -->
    <div wire:ignore.self class="modal fade" id="add_dokrev">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header text-white" style="background-color: #222E3C">
                    <h4 class="modal-title">Dokumen Revisi</h4>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close"
                        wire:click="ClearForm">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <form>
                            @csrf
                            <div class="form-group">
                                <label for="dok_rev">Link Revisi</label>
                                <input type="url" class="form-control @error('dok_rev') is-invalid @enderror"
                                    wire:model="dok_rev">
                                @error('dok_rev')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <button type="button" class="btn btn-primary" wire:click="dokrev()">Submit</button>
                        </form>
                    </div>
                </div>
                <div class="modal-footer justify-content-end">
                    <button type="button" class="btn btn-default" data-dismiss="modal"
                        wire:click="ClearForm">Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <!-- Modal ADD Bidang -->
    <div wire:ignore.self class="modal fade" id="add_notes">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header text-white" style="background-color: #222E3C">
                    <h4 class="modal-title">Catatan</h4>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <form>
                            @csrf
                            <div class="form-group">
                                <label for="note_rev1">Catatan Reviewer 1</label>
                                <textarea class="form-control @error('note_rev1') is-invalid @enderror" id="note_rev1" rows="3"
                                    wire:model="note_rev1"></textarea>
                                @error('note_rev1')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="note_rev2">Catatan Reviewer 2</label>
                                <textarea class="form-control @error('note_rev2') is-invalid @enderror" id="note_rev2" rows="3"
                                    wire:model="note_rev2"></textarea>
                                @error('note_rev2')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <button type="button" class="btn btn-primary" wire:click="add_notes()">Submit</button>
                        </form>
                    </div>
                </div>
                <div class="modal-footer justify-content-end">
                    <button type="button" class="btn btn-default" data-dismiss="modal"
                        wire:click="ClearForm">Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <script>
        window.addEventListener('closeModal', event => {
            $("#add_dokrev").modal('hide');
        })
        window.addEventListener('closeModal', event => {
            $("#add_notes").modal('hide');
        })
        window.addEventListener('closeModal', event => {
            $("#view_notes").modal('hide');
        })
    </script>
</div>
