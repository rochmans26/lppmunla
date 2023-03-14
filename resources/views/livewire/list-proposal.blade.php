<div>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Pengajuan Proposal</h1>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="container-fluid">
        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <section class="content">
            <div class="container-fluid mb-1">
                <div class="row">
                    <div class="col-lg-2">
                        <a href="" class="btn btn-success" data-toggle="modal" data-target="#add"
                            wire:click="ClearForm"><i class="nav-icon fas fa-plus"></i> Buat
                            Pengajuan</a>
                    </div>
                    <div class="col-lg-1 mb-1">
                        <select wire:model='result' class="form-control">
                            <option value="10">10</option>
                            <option value="20">20</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                    </div>
                    <div class="col-lg-3 mb-1">
                        <input type="text" wire:model='search' class="form-control" placeholder="Cari ...">
                    </div>
                    <div class="col-lg-2 mb-1">
                        <button class="btn btn-danger form-control" wire:click="deleteall()">Delete All</button>
                    </div>

                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="table-responsive-sm">
                                <table class="table table-stripped">
                                    <thead>
                                        <tr style="vertical-align: middle">
                                            <th>No.</th>
                                            <th>Judul Proposal</th>
                                            <th>Bidang</th>
                                            <th>Jenis Skim</th>
                                            <th>Lokasi Kegiatan</th>
                                            <th>Tahun Usulan</th>
                                            <th>Tahun Kegiatan</th>
                                            <th>Tahun Pelaksanaan</th>
                                            <th>Link Dokumen</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($proposals) != null)
                                            @foreach ($proposals as $index => $proposal)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $proposal->judul_proposal }}</td>
                                                    <td>{{ $proposal->nm_bidang }}</td>
                                                    <td>{{ $proposal->nm_skim }}</td>
                                                    <td>{{ $proposal->lokasi_kegiatan }}</td>
                                                    <td>{{ $proposal->thn_usulan }}</td>
                                                    <td>{{ $proposal->thn_kegiatan }}</td>
                                                    <td>{{ $proposal->thn_pelaksanaan }}</td>
                                                    <td> <a href="{{ $proposal->dok_link }}" target="_blank">Link</a>
                                                    </td>
                                                    <td>
                                                        <a href="" class="btn btn-sm btn-warning mb-1"
                                                            data-toggle="modal" data-target="#edit"
                                                            wire:click="edit({{ $proposal->id_proposal }})"><i
                                                                class="nav-icon fas fa-edit"></i>Edit</a>
                                                        @if (Auth::user()->level == 'sp-admin')
                                                            <a href="{{ route('sp-admin.proposal.detail', ['id' => $proposal->id_proposal]) }}"
                                                                class="btn btn-sm btn-primary mb-1"><i
                                                                    class="nav-icon fas fa-eye"></i>Detail</a>
                                                        @else
                                                            <a href="{{ route('proposal.detail', ['id' => $proposal->id_proposal]) }}"
                                                                class="btn btn-sm btn-primary mb-1"><i
                                                                    class="nav-icon fas fa-eye"></i>Detail</a>
                                                        @endif
                                                        <a href="" class="btn btn-sm btn-danger mb-1"
                                                            data-toggle="modal" data-target="#delete"
                                                            wire:click="confirmdel({{ $proposal->id_proposal }})"><i
                                                                class="nav-icon fas fa-trash"></i> Delete</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="10" style="background-color: #222E3C">
                                                    <h5 class="text-center text-white">Belum Ada Data</h5>
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                                <div class="pagination justify-content-center">
                                    {{ $proposals->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Small boxes (Stat box) -->

            <!-- /.row -->
            <!-- Main row -->
            {{-- <div class="row"> --}}
            <!-- Left col -->

            <!-- /.Left col -->
            <!-- right col (We are only adding the ID to make the widgets sortable)-->

            <!-- right col -->
            {{-- </div> --}}
            <!-- /.row (main row) -->
        </section>
    </div><!-- /.container-fluid -->

    <!-- Modal Edit Bidang -->
    <div wire:ignore.self class="modal fade" id="edit">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header text-white" style="background-color: #222E3C">
                    <h4 class="modal-title">Edit Data</h4>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <form>
                            @csrf
                            <div class="form-group">
                                <label for="judul_proposal">Judul Proposal</label>
                                <input type="text" class="form-control @error('judul_proposal') is-invalid @enderror"
                                    id="judul_proposal" placeholder="Judul Proposal" wire:model="judul_proposal">
                                @error('judul_proposal')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="id_bidang">Bidang</label>
                                    <select id="id_bidang" class="form-control @error('id_bidang') is-invalid @enderror"
                                        wire:model="id_bidang">
                                        <option selected>-- Pilih Bidang --</option>
                                        @foreach ($bidangs as $bidang)
                                            <option value="{{ $bidang->id_bidang }}">{{ $bidang->nm_bidang }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="id_skim">Skim</label>
                                    <select id="id_skim" class="form-control @error('id_skim') is-invalid @enderror"
                                        wire:model="id_skim">
                                        <option selected>-- Pilih Jenis Skim --</option>
                                        @foreach ($skims as $skim)
                                            <option value="{{ $skim->id_skim }}">{{ $skim->nm_skim }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="lokasi_kegiatan">Lokasi Kegiatan</label>
                                <input type="text"
                                    class="form-control @error('lokasi_kegiatan') is-invalid @enderror"
                                    id="lokasi_kegiatan" placeholder="Lokasi Kegiatan" wire:model="lokasi_kegiatan">
                                @error('lokasi_kegiatan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="thn_usulan">Tahun Usulan</label>
                                    <input type="text"
                                        class="form-control @error('thn_usulan') is-invalid @enderror" id="thn_usulan"
                                        placeholder="1998" wire:model="thn_usulan">
                                    @error('thn_usulan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="thn_kegiatan">Tahun Kegiatan</label>
                                    <input type="text"
                                        class="form-control @error('thn_kegiatan') is-invalid @enderror"
                                        id="thn_kegiatan" placeholder="1998" wire:model="thn_kegiatan">
                                    @error('thn_kegiatan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="thn_pelaksanaan">Tahun Pelaksanaan</label>
                                    <input type="text"
                                        class="form-control @error('thn_pelaksanaan') is-invalid @enderror"
                                        id="thn_pelaksanaan" placeholder="1998" wire:model="thn_pelaksanaan">
                                    @error('thn_pelaksanaan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="dok_link">Link Dokumen</label>
                                <input type="text" class="form-control @error('dok_link') is-invalid @enderror"
                                    id="dok_link" placeholder="https://www.google.co.id/" wire:model="dok_link">
                                @error('dok_link')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <button type="button" class="btn btn-primary" wire:click="update()">Submit</button>
                        </form>
                    </div>
                </div>
                <div class="modal-footer justify-content-end">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
    </div>

    <!-- Modal Delete USER -->
    <div wire:ignore.self class="modal fade" id="delete">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Hapus Data</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        Apakah anda yakin untuk menghapus data ini?
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <div class="form-group">
                        <button class="btn btn-danger btn-sm" wire:click="delete()">Hapus</button>
                    </div>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <!-- Modal ADD Bidang -->
    <div wire:ignore.self class="modal fade" id="add">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header text-white" style="background-color: #222E3C">
                    <h4 class="modal-title">Tambah Data</h4>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <form>
                            @csrf
                            <div class="form-group">
                                <label for="judul_proposal">Judul Proposal</label>
                                <input type="text"
                                    class="form-control @error('judul_proposal') is-invalid @enderror"
                                    id="judul_proposal" placeholder="Judul Proposal" wire:model="judul_proposal">
                                @error('judul_proposal')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="id_bidang">Bidang</label>
                                    <select id="id_bidang"
                                        class="form-control @error('id_bidang') is-invalid @enderror"
                                        wire:model="id_bidang">
                                        <option selected>-- Pilih Bidang --</option>
                                        @foreach ($bidangs as $bidang)
                                            <option value="{{ $bidang->id_bidang }}">{{ $bidang->nm_bidang }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="id_skim">Skim</label>
                                    <select id="id_skim"
                                        class="form-control @error('id_skim') is-invalid @enderror"
                                        wire:model="id_skim">
                                        <option selected>-- Pilih Jenis Skim --</option>
                                        @foreach ($skims as $skim)
                                            <option value="{{ $skim->id_skim }}">{{ $skim->nm_skim }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="lokasi_kegiatan">Lokasi Kegiatan</label>
                                <input type="text"
                                    class="form-control @error('lokasi_kegiatan') is-invalid @enderror"
                                    id="lokasi_kegiatan" placeholder="Lokasi Kegiatan" wire:model="lokasi_kegiatan">
                                @error('lokasi_kegiatan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="thn_usulan">Tahun Usulan</label>
                                    <input type="text"
                                        class="form-control @error('thn_usulan') is-invalid @enderror"
                                        id="thn_usulan" placeholder="1998" wire:model="thn_usulan">
                                    @error('thn_usulan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="thn_kegiatan">Tahun Kegiatan</label>
                                    <input type="text"
                                        class="form-control @error('thn_kegiatan') is-invalid @enderror"
                                        id="thn_kegiatan" placeholder="1998" wire:model="thn_kegiatan">
                                    @error('thn_kegiatan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="thn_pelaksanaan">Tahun Pelaksanaan</label>
                                    <input type="text"
                                        class="form-control @error('thn_pelaksanaan') is-invalid @enderror"
                                        id="thn_pelaksanaan" placeholder="1998" wire:model="thn_pelaksanaan">
                                    @error('thn_pelaksanaan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="dok_link">Link Dokumen</label>
                                <input type="text" class="form-control @error('dok_link') is-invalid @enderror"
                                    id="dok_link" placeholder="https://www.google.co.id/" wire:model="dok_link">
                                @error('dok_link')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <button type="button" class="btn btn-primary" wire:click="create()">Submit</button>
                        </form>
                    </div>
                </div>
                <div class="modal-footer justify-content-end">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <script>
        window.addEventListener('closeModal', event => {
            $("#add").modal('hide');
        })
        window.addEventListener('closeModal', event => {
            $("#edit").modal('hide');
        })
        window.addEventListener('closeModal', event => {
            $("#delete").modal('hide');
        })
        window.addEventListener('closeModal', event => {
            $("#detail").modal('hide');
        })
    </script>
</div>
