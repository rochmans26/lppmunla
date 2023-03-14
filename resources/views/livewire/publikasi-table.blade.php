<div>
    <style type="text/css">
        /* .search-box .clear {
            clear: both;
            margin-top: 20px;
        } */

        .option ul {
            list-style: none;
            padding: 0px;
            width: 70%;
            position: absolute;
            margin: 0;
            background: white;
        }

        .option ul li {
            background: lavender;
            padding: 4px;
            margin-bottom: 1px;
        }

        .option ul li:nth-child(even) {
            background: cadetblue;
            color: white;
        }

        .option ul li:hover {
            cursor: pointer;
        }

        /* .option input[type=text] {
            padding: 5px;
            width: 250px;
            letter-spacing: 1px;
        } */
    </style>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Manajemen Publikasi</h1>
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
        @if (session()->has('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <section class="content">
            <div class="container-fluid mb-1">
                <div class="row">
                    <div class="col-lg-2 mb-1">
                        <a href="" class="btn btn-success" data-toggle="modal" data-target="#add"
                            wire:click="ClearForm"><i class="nav-icon fas fa-plus"></i> Publikasi</a>
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

                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="table-responsive">
                                <table class="table table-stripped">
                                    <thead>
                                        <tr style="vertical-align: middle">
                                            <th>No.</th>
                                            <th>Referensi Judul PKM</th>
                                            <th>Judul</th>
                                            <th>Nama Jurnal</th>
                                            <th>Volume</th>
                                            <th>Nomor</th>
                                            <th>Tanggal Terbit</th>
                                            <th>Jumlah Penulis</th>
                                            <th>Link</th>
                                            <th>Status Jurnal</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($publikasis) != null)
                                            @foreach ($publikasis as $index => $publikasi)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>
                                                        <a
                                                            href="{{ route('sp-admin.laphasil.detail', ['id' => $publikasi->id_laphasil]) }}">
                                                            {{ $publikasi->judul_pkm }}
                                                        </a>
                                                    </td>
                                                    <td>{{ $publikasi->judul_jurnal }}</td>
                                                    <td>{{ $publikasi->nm_jurnal }}</td>
                                                    <td>{{ $publikasi->vol_jurnal }}</td>
                                                    <td>{{ $publikasi->no_jurnal }}</td>
                                                    <td>{{ date('d M Y', strtotime($publikasi->tgl_terbit_jurnal)) }}
                                                    </td>
                                                    <td>{{ $publikasi->jumlah_penulis }}</td>
                                                    <td> <a href="{{ $publikasi->link_jurnal }}" target="_blank"
                                                            class="btn badge bg-primary">Dokumen</a>
                                                    </td>
                                                    <td>{{ $publikasi->status_jurnal }}</td>
                                                    <td>
                                                        <a href="" class="btn btn-sm btn-warning mb-1"
                                                            data-toggle="modal" data-target="#edit"
                                                            wire:click="detail({{ $publikasi->id_publikasi }})"><i
                                                                class="nav-icon fas fa-edit"></i>Edit</a>
                                                        <a href="" class="btn btn-sm btn-primary mb-1"
                                                            data-toggle="modal" data-target="#detail"
                                                            wire:click="detail({{ $publikasi->id_publikasi }})"><i
                                                                class="nav-icon fas fa-edit"></i>Detail</a>
                                                        {{-- <a href="{{ route('sp-admin.laphasil.detail', ['id' => $pkm->id_laphasil]) }}"
                                                            class="btn btn-sm btn-primary mb-1"><i
                                                                class="nav-icon fas fa-eye"></i>Detail</a> --}}
                                                        {{-- <a href="" class="btn btn-sm btn-danger mb-1"
                                                            data-toggle="modal" data-target="#delete"
                                                            wire:click="confirmdel({{ $pkm->id_laphasil }})"><i
                                                                class="nav-icon fas fa-trash"></i> Delete</a> --}}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="" style="background-color: #222E3C">
                                                    <h5 class="text-center text-white">Belum Ada Data</h5>
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                                <div class="pagination justify-content-center">
                                    {{ $publikasis->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
                                <label for="id_laphasil">Referensi Judul PKM</label>
                                <input type="text" class="form-control @error('id_laphasil') is-invalid @enderror"
                                    id="id_laphasil" name="id_laphasil" wire:model="type" wire:keyup="typeResult"
                                    placeholder="Cari Judul">
                                @if ($showresult)
                                    <div class="option">
                                        <ul>
                                            @if (!empty($records))
                                                @foreach ($records as $record)
                                                    <li wire:click="fetchLaphasilDetail({{ $record->id_laphasil }})">
                                                        {{ $record->judul_pkm }} - {{ $record->thn_usulan }}</li>
                                                @endforeach
                                            @endif
                                        </ul>
                                    </div>
                                @endif
                                @error('id_laphasil')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="judul_jurnal">Judul Jurnal</label>
                                <input type="text" class="form-control @error('judul_jurnal') is-invalid @enderror"
                                    id="judul_jurnal" placeholder="Judul jurnal" wire:model="judul_jurnal">
                                @error('judul_jurnal')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="nm_jurnal">Nama Jurnal</label>
                                    <input type="text"
                                        class="form-control @error('nm_jurnal') is-invalid @enderror" id="nm_jurnal"
                                        placeholder="Lokasi Kegiatan" wire:model="nm_jurnal">
                                    @error('nm_jurnal')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="vol_jurnal">Volume</label>
                                    <input type="text"
                                        class="form-control @error('vol_jurnal') is-invalid @enderror" id="vol_jurnal"
                                        placeholder="Lokasi Kegiatan" wire:model="vol_jurnal">
                                    @error('vol_jurnal')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="no_jurnal">Nomor Jurnal</label>
                                    <input type="text"
                                        class="form-control @error('no_jurnal') is-invalid @enderror" id="no_jurnal"
                                        placeholder="Lokasi Kegiatan" wire:model="no_jurnal">
                                    @error('no_jurnal')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="tgl_terbit_jurnal">Tanggal Terbit</label>
                                    <input type="date"
                                        class="form-control @error('tgl_terbit_jurnal') is-invalid @enderror"
                                        id="tgl_terbit_jurnal" placeholder="1998" wire:model="tgl_terbit_jurnal">
                                    @error('tgl_terbit_jurnal')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="jumlah_penulis">Jumlah Penulis</label>
                                    <input type="number"
                                        class="form-control @error('jumlah_penulis') is-invalid @enderror"
                                        id="jumlah_penulis" placeholder="Jumlah Penulis" wire:model="jumlah_penulis">
                                    @error('jumlah_penulis')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="status_jurnal">Status Jurnal</label>
                                    <select id="status_jurnal"
                                        class="form-control @error('status_jurnal') is-invalid @enderror"
                                        wire:model="status_jurnal">
                                        <option selected>-- Pilih Status Jurnal --</option>
                                        <option value="non-akreditasi">Non Akreditasi</option>
                                        <option value="akreditasi-kemenristek">Terakreditasi Kemenristek</option>
                                        <option value="non-scopus">Non Scopus</option>
                                        <option value="scopus">Scopus</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="link_jurnal">Link Jurnal</label>
                                <input type="url" class="form-control @error('link_jurnal') is-invalid @enderror"
                                    id="link_jurnal" placeholder="Link Jurnal" wire:model="link_jurnal">
                                @error('link_jurnal')
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


    <!-- Modal Detail Bidang -->
    <div wire:ignore.self class="modal fade" id="detail">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header text-white" style="background-color: #222E3C">
                    <h4 class="modal-title">Detail Data</h4>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <form>
                            @csrf
                            <div class="form-group">
                                <label for="id_laphasil">Referensi Judul PKM</label>
                                <input type="text" class="form-control @error('id_laphasil') is-invalid @enderror"
                                    id="id_laphasil" name="id_laphasil" wire:model="type" wire:keyup="typeResult"
                                    placeholder="Cari Judul" readonly>
                                @if ($showresult)
                                    <div class="option">
                                        <ul>
                                            @if (!empty($records))
                                                @foreach ($records as $record)
                                                    <li wire:click="fetchLaphasilDetail({{ $record->id_laphasil }})">
                                                        {{ $record->judul_pkm }} - {{ $record->thn_usulan }}</li>
                                                @endforeach
                                            @endif
                                        </ul>
                                    </div>
                                @endif
                                @error('id_laphasil')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="judul_jurnal">Judul Jurnal</label>
                                <input type="text"
                                    class="form-control @error('judul_jurnal') is-invalid @enderror"
                                    id="judul_jurnal" placeholder="Judul jurnal" wire:model="judul_jurnal" readonly>
                                @error('judul_jurnal')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="nm_jurnal">Nama Jurnal</label>
                                    <input type="text"
                                        class="form-control @error('nm_jurnal') is-invalid @enderror" id="nm_jurnal"
                                        placeholder="Lokasi Kegiatan" wire:model="nm_jurnal" readonly>
                                    @error('nm_jurnal')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="vol_jurnal">Volume</label>
                                    <input type="text"
                                        class="form-control @error('vol_jurnal') is-invalid @enderror"
                                        id="vol_jurnal" placeholder="Lokasi Kegiatan" wire:model="vol_jurnal"
                                        readonly>
                                    @error('vol_jurnal')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="no_jurnal">Nomor Jurnal</label>
                                    <input type="text"
                                        class="form-control @error('no_jurnal') is-invalid @enderror" id="no_jurnal"
                                        placeholder="Lokasi Kegiatan" wire:model="no_jurnal" readonly>
                                    @error('no_jurnal')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="tgl_terbit_jurnal">Tanggal Terbit</label>
                                    <input type="date"
                                        class="form-control @error('tgl_terbit_jurnal') is-invalid @enderror"
                                        id="tgl_terbit_jurnal" placeholder="1998" wire:model="tgl_terbit_jurnal"
                                        readonly>
                                    @error('tgl_terbit_jurnal')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="jumlah_penulis">Jumlah Penulis</label>
                                    <input type="number"
                                        class="form-control @error('jumlah_penulis') is-invalid @enderror"
                                        id="jumlah_penulis" placeholder="Jumlah Penulis" wire:model="jumlah_penulis"
                                        readonly>
                                    @error('jumlah_penulis')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="status_jurnal">Status Jurnal</label>
                                    <select id="status_jurnal"
                                        class="form-control @error('status_jurnal') is-invalid @enderror"
                                        wire:model="status_jurnal" disabled>
                                        <option selected>-- Pilih Status Jurnal --</option>
                                        <option value="non-akreditasi">Non Akreditasi</option>
                                        <option value="akreditasi-kemenristek">Terakreditasi Kemenristek</option>
                                        <option value="non-scopus">Non Scopus</option>
                                        <option value="scopus">Scopus</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="link_jurnal">Link Jurnal</label>
                                <input type="url" class="form-control @error('link_jurnal') is-invalid @enderror"
                                    id="link_jurnal" placeholder="Link Jurnal" wire:model="link_jurnal" readonly>
                                @error('link_jurnal')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
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

    <!-- Modal ADD Bidang -->
    <div wire:ignore.self class="modal fade" id="add">
        <div class="modal-dialog modal-dialog-scrollable modal-xl">
            <div class="modal-content">
                <div class="modal-header text-white" style="background-color: #222E3C">
                    <h4 class="modal-title">Publikasi</h4>
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
                                <label for="id_laphasil">Referensi Judul PKM</label>
                                <input type="text" class="form-control @error('id_laphasil') is-invalid @enderror"
                                    id="id_laphasil" name="id_laphasil" wire:model="type" wire:keyup="typeResult"
                                    placeholder="Cari Judul">
                                @if ($showresult)
                                    <div class="option">
                                        <ul>
                                            @if (!empty($records))
                                                @foreach ($records as $record)
                                                    <li wire:click="fetchLaphasilDetail({{ $record->id_laphasil }})">
                                                        {{ $record->judul_pkm }} - {{ $record->thn_usulan }}</li>
                                                @endforeach
                                            @endif
                                        </ul>
                                    </div>
                                @endif
                                @error('id_laphasil')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="judul_jurnal">Judul Jurnal</label>
                                <input type="text"
                                    class="form-control @error('judul_jurnal') is-invalid @enderror"
                                    id="judul_jurnal" placeholder="Judul Jurnal" wire:model="judul_jurnal">
                                @error('judul_jurnal')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="nm_jurnal">Nama Jurnal</label>
                                    <input type="text"
                                        class="form-control @error('nm_jurnal') is-invalid @enderror" id="nm_jurnal"
                                        placeholder="Nama Jurnal" wire:model="nm_jurnal">
                                    @error('nm_jurnal')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="vol_jurnal">Volume</label>
                                    <input type="number"
                                        class="form-control @error('vol_jurnal') is-invalid @enderror"
                                        id="vol_jurnal" placeholder="Vol. Jurnal" wire:model="vol_jurnal">
                                    @error('vol_jurnal')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="no_jurnal">Nomor Jurnal</label>
                                    <input type="number"
                                        class="form-control @error('no_jurnal') is-invalid @enderror" id="no_jurnal"
                                        placeholder="Nomor Jurnal" wire:model="no_jurnal">
                                    @error('no_jurnal')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="tgl_terbit_jurnal">Tanggal Terbit</label>
                                    <input type="date"
                                        class="form-control @error('tgl_terbit_jurnal') is-invalid @enderror"
                                        id="tgl_terbit_jurnal" placeholder="dd/mm/yyyy"
                                        wire:model="tgl_terbit_jurnal">
                                    @error('tgl_terbit_jurnal')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="jumlah_penulis">Jumlah Penulis</label>
                                    <input type="number"
                                        class="form-control @error('jumlah_penulis') is-invalid @enderror"
                                        id="jumlah_penulis" placeholder="Jumlah Penulis" wire:model="jumlah_penulis">
                                    @error('jumlah_penulis')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="status_jurnal">Status Jurnal</label>
                                    <select id="status_jurnal"
                                        class="form-control @error('status_jurnal') is-invalid @enderror"
                                        wire:model="status_jurnal">
                                        <option selected>-- Pilih Status Jurnal --</option>
                                        <option value="non-akreditasi">Non Akreditasi</option>
                                        <option value="akreditasi-kemenristek">Terakreditasi Kemenristek</option>
                                        <option value="non-scopus">Non Scopus</option>
                                        <option value="scopus">Scopus</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="link_jurnal">Link Jurnal</label>
                                <input type="url" class="form-control @error('link_jurnal') is-invalid @enderror"
                                    id="link_jurnal" placeholder="Link Jurnal" wire:model="link_jurnal">
                                @error('link_jurnal')
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
