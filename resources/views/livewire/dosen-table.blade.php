<div>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Dosen Lokal</h1>
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
                    <div class="col-lg-2"><button type="button" class="btn btn-success btn-sm mb-3" data-toggle="modal"
                            data-target="#add" wire:click="ClearForm">
                            Tambah Dosen
                        </button></div>
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
                            <div class="table-responsive-sm">
                                <table class="table table-stripped">
                                    <thead>
                                        <tr style="vertical-align: middle">
                                            <th>No.</th>
                                            <th>NIDN/NIP</th>
                                            <th>Nama Dosen</th>
                                            <th>Telp</th>
                                            <th>Email</th>
                                            <th>Jabatan Fungsional</th>
                                            <th>Prodi</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($dosens) != null)
                                            @foreach ($dosens as $index => $dosen)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $dosen->nidn }}</td>
                                                    <td>{{ $dosen->nm_dosen }}</td>
                                                    <td>{{ $dosen->telp }}</td>
                                                    <td>{{ $dosen->email }}</td>
                                                    <td>{{ $dosen->jafung }}</td>
                                                    <td>{{ $dosen->prodi->nm_prodi }}</td>
                                                    <td>
                                                        <a href="" class="btn btn-sm btn-warning"
                                                            data-toggle="modal" data-target="#edit"
                                                            wire:click="detail({{ $dosen->id }})"><i
                                                                class="nav-icon fas fa-edit"></i>Edit</a>
                                                        <a href="" class="btn btn-sm btn-danger"
                                                            data-toggle="modal" data-target="#delete"
                                                            wire:click="confirm({{ $dosen->id }})"><i
                                                                class="nav-icon fas fa-trash"></i> Delete</a>
                                                        <a href="" class="btn btn-sm btn-primary"
                                                            data-toggle="modal" data-target="#detail"
                                                            wire:click="detail({{ $dosen->id }})"><i
                                                                class="nav-icon fas fa-eye"></i> Detail</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="9" class="text-center">
                                                    <span class="bg-danger p-2">No Data Found.</span>
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                                <div class="pagination justify-content-center">
                                    {{ $dosens->links() }}
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
    </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->


    <!-- Modal Edit Bidang -->
    <div wire:ignore.self class="modal fade" id="edit">
        <div class="modal-dialog">
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
                                <label for="nidn">NIDN/NIP</label>
                                <input type="text" class="form-control @error('nidn') is-invalid @enderror"
                                    id="nidn" name="nidn" wire:model="nidn" value="">
                                @error('nidn')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="nm_dosen">Nama Dosen</label>
                                <input type="text" class="form-control @error('nm_dosen') is-invalid @enderror"
                                    id="nm_dosen" name="nm_dosen" wire:model="nm_dosen" value="">
                                @error('nm_dosen')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="alamat_dosen">Alamat</label>
                                <input type="text" class="form-control @error('alamat_dosen') is-invalid @enderror"
                                    id="alamat_dosen" name="alamat_dosen" wire:model="alamat_dosen" value="">
                                @error('alamat_dosen')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="telp">Telp</label>
                                <input type="text" class="form-control @error('telp') is-invalid @enderror"
                                    id="telp" name="telp" wire:model="telp" value="">
                                @error('telp')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email" wire:model="email" value="">
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="jafung">Jabatan Fungsional</label>
                                <select class="form-control @error('jafung') is-invalid @enderror" wire:model="jafung"
                                    id="jafung" name="jafung">
                                    <option selected>-- Pilih Jafung --</option>
                                    <option value="Asisten Ahli">Asisten Ahli</option>
                                    <option value="Lektor">Lektor</option>
                                    <option value="Lektor Kepala">Lektor Kepala</option>
                                </select>
                                @error('jafung')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="id_prodi">Prodi</label>
                                <select class="form-control @error('id_prodi') is-invalid @enderror"
                                    wire:model="id_prodi" id="id_prodi" name="id_prodi">
                                    <option selected>-- Pilih Prodi --</option>
                                    @foreach ($prodis as $prodi)
                                        <option value="{{ $prodi->id }}">{{ $prodi->nm_prodi }}</option>
                                    @endforeach
                                </select>
                                @error('id_prodi')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <button type="button" class="btn btn-primary" wire:click="update()">Edit</button>
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

    <!-- Modal Detail Bidang -->
    <div wire:ignore.self class="modal fade" id="detail">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header text-white" style="background-color: #222E3C">
                    <h4 class="modal-title">Detail Data Dosen</h4>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close"
                        wire:click='ClearForm'>
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <form>
                            @csrf
                            <div class="form-group">
                                <label for="nidn">NIDN/NIP</label>
                                <input type="text" class="form-control" id="nidn" name="nidn"
                                    wire:model="nidn" value="" readonly>
                            </div>
                            <div class="form-group">
                                <label for="nm_dosen">Nama Dosen</label>
                                <input type="text" class="form-control" id="nm_dosen" name="nm_dosen"
                                    wire:model="nm_dosen" value="" readonly>

                            </div>
                            <div class="form-group">
                                <label for="alamat_dosen">Alamat</label>
                                <input type="text" class="form-control" id="alamat_dosen" name="alamat_dosen"
                                    wire:model="alamat_dosen" value="" readonly>
                            </div>
                            <div class="form-group">
                                <label for="telp">Telp</label>
                                <input type="text" class="form-control" id="telp" name="telp"
                                    wire:model="telp" value="" readonly>

                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control " id="email" name="email"
                                    wire:model="email" value="" readonly>

                            </div>
                            <div class="form-group">
                                <label for="jafung">Jabatan Fungsional</label>
                                <select class="form-control" wire:model="jafung" id="jafung" name="jafung"
                                    readonly>
                                    <option selected>-- Pilih Jafung --</option>
                                    <option value="Asisten Ahli">Asisten Ahli</option>
                                    <option value="Lektor">Lektor</option>
                                    <option value="Lektor Kepala">Lektor Kepala</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="id_prodi">Prodi</label>
                                <select class="form-control" wire:model="id_prodi" id="id_prodi" name="id_prodi"
                                    readonly>
                                    <option selected>-- Pilih Prodi --</option>
                                    @foreach ($prodis as $prodi)
                                        <option value="{{ $prodi->id }}">{{ $prodi->nm_prodi }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer justify-content-end">
                    <button type="button" class="btn btn-default" data-dismiss="modal"
                        wire:click='ClearForm'>Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <!-- Modal Delete USER -->
    <div wire:ignore.self class="modal fade" id="delete">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Hapus Data Dosen</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        Apakah anda yakin untuk menghapus dosen ini?
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
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header text-white" style="background-color: #222E3C">
                    <h4 class="modal-title">Tambah Data Dosen</h4>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <form>
                            @csrf
                            <div class="form-group">
                                <label for="nidn">NIDN/NIP</label>
                                <input type="text" class="form-control @error('nidn') is-invalid @enderror"
                                    id="nidn" name="nidn" wire:model="nidn" value="">
                                @error('nidn')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="nm_dosen">Nama Dosen</label>
                                <input type="text" class="form-control @error('nm_dosen') is-invalid @enderror"
                                    id="nm_dosen" name="nm_dosen" wire:model="nm_dosen" value="">
                                @error('nm_dosen')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="alamat_dosen">Alamat</label>
                                <input type="text" class="form-control @error('alamat_dosen') is-invalid @enderror"
                                    id="alamat_dosen" name="alamat_dosen" wire:model="alamat_dosen" value="">
                                @error('alamat_dosen')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="telp">Telp</label>
                                <input type="text" class="form-control @error('telp') is-invalid @enderror"
                                    id="telp" name="telp" wire:model="telp" value="">
                                @error('telp')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email" wire:model="email" value="">
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="jafung">Jabatan Fungsional</label>
                                <select class="form-control @error('jafung') is-invalid @enderror"
                                    wire:model="jafung" id="jafung" name="jafung">
                                    <option selected>-- Pilih Jafung --</option>
                                    <option value="Asisten Ahli">Asisten Ahli</option>
                                    <option value="Lektor">Lektor</option>
                                    <option value="Lektor Kepala">Lektor Kepala</option>
                                </select>
                                @error('jafung')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="id_prodi">Prodi</label>
                                <select class="form-control @error('id_prodi') is-invalid @enderror"
                                    wire:model="id_prodi" id="id_prodi" name="id_prodi">
                                    <option selected>-- Pilih Prodi --</option>
                                    @foreach ($prodis as $prodi)
                                        <option value="{{ $prodi->id }}">{{ $prodi->nm_prodi }}</option>
                                    @endforeach
                                </select>
                                @error('id_prodi')
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
            $("#reset").modal('hide');
        })
    </script>
</div>
