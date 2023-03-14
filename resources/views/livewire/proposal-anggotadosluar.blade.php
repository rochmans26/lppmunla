<div>
    {{-- The best athlete wants his opponent at his best. --}}
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Anggota Dosen Luar</h3>&nbsp;
            <span>
                <a href="" class="btn-sm btn-success mb-3" data-target="#add_dosluar" data-toggle="modal"><i
                        class="nav-icon fas fa-plus" wire:click='ClearForm'></i> Tambah
                    Anggota
                    Dosen Luar</a>
            </span>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive-sm">
                <table class="table table-stripped">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>NIDN</th>
                            <th>Nama Dosen Luar</th>
                            <th>Peran</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($anggota) != null)
                            @foreach ($anggota as $index => $dosluar)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $dosluar->nidn }}</td>
                                    <td>{{ $dosluar->nm_dosen }}</td>
                                    <td>{{ $dosluar->peran }}</td>
                                    <td>
                                        <a href="" class="btn-sm btn-warning" data-toggle="modal"
                                            data-target="#edit_dosluar" wire:click="detail({{ $dosluar->id }})"><i
                                                class="nav-icon fas fa-edit"></i>
                                            Edit</a>
                                        <a href="" class="btn-sm btn-danger" data-toggle="modal"
                                            data-target="#con_del_dosenluar"
                                            wire:click="confirm({{ $dosluar->id }})"><i
                                                class="nav-icon fas fa-trash"></i> Delete</a>
                                        <a href="" class="btn-sm btn-primary" data-toggle="modal"
                                            data-target="#detail_dosenluar" wire:click="detail({{ $dosluar->id }})"><i
                                                class="nav-icon fas fa-eye"></i>
                                            Detail</a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5" class="text-center"><span class="bg bg-danger p-2">No Data
                                        Found.</span>
                                </td>
                            </tr>
                        @endif

                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.card-body -->
    </div>

    <!-- Modal Edit Bidang -->
    <div wire:ignore.self class="modal fade" id="edit_dosluar">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header text-white" style="background-color: #222E3C">
                    <h4 class="modal-title">Edit Data Anggota Dosen Luar</h4>
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
                                <label for="nidn">NIDN</label>
                                <input type="text" class="form-control @error('nidn') is-invalid @enderror"
                                    id="nidn" name="nidn" wire:model="nidn">
                                @error('nidn')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="nm_dosen">Nama Dosen</label>
                                <input type="text" class="form-control @error('nm_dosen') is-invalid @enderror"
                                    id="nm_dosen" name="nm_dosen" wire:model="nm_dosen">
                                @error('nm_dosen')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="telp">Telp.</label>
                                <input type="text" class="form-control @error('telp') is-invalid @enderror"
                                    id="telp" name="telp" wire:model="telp">
                                @error('telp')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email" wire:model="email">
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="fakultas">Fakultas</label>
                                <input type="text" class="form-control @error('fakultas') is-invalid @enderror"
                                    id="fakultas" name="fakultas" wire:model="fakultas">
                                @error('fakultas')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="prodi">Program Studi</label>
                                <input type="text" class="form-control @error('prodi') is-invalid @enderror"
                                    id="prodi" name="prodi" wire:model="prodi">
                                @error('prodi')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="universitas">Universitas</label>
                                <input type="text" class="form-control @error('universitas') is-invalid @enderror"
                                    id="universitas" name="universitas" wire:model="universitas">
                                @error('universitas')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="peran">Peran</label>
                                <input type="text" class="form-control @error('peran') is-invalid @enderror"
                                    id="peran" name="peran" wire:model="peran">
                                @error('peran')
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
                    <button type="button" class="btn btn-default" data-dismiss="modal"
                        wire:click='ClearForm'>Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <!-- Modal Detail Bidang -->
    <div wire:ignore.self class="modal fade" id="detail_dosenluar">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header text-white" style="background-color: #222E3C">
                    <h4 class="modal-title">Detail Data Anggota Mahasiswa</h4>
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
                                <label for="nidn">NIDN</label>
                                <input type="text" class="form-control" id="nidn" name="nidn"
                                    wire:model="nidn" readonly>
                            </div>
                            <div class="form-group">
                                <label for="nm_dosen">Nama Dosen</label>
                                <input type="text" class="form-control" id="nm_dosen" name="nm_dosen"
                                    wire:model="nm_dosen" readonly>
                            </div>
                            <div class="form-group">
                                <label for="telp">Telp.</label>
                                <input type="number" class="form-control" id="telp" name="telp"
                                    wire:model="telp" readonly>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" id="email" name="email"
                                    wire:model="email" readonly>
                            </div>
                            <div class="form-group">
                                <label for="fakultas">Fakultas</label>
                                <input type="text" class="form-control" id="fakultas" name="fakultas"
                                    wire:model="fakultas" readonly>
                            </div>
                            <div class="form-group">
                                <label for="prodi">Program Studi</label>
                                <input type="text" class="form-control" id="prodi" name="prodi"
                                    wire:model="prodi" readonly>
                                @error('prodi')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="universitas">Universitas</label>
                                <input type="text" class="form-control" id="universitas" name="universitas"
                                    wire:model="universitas" readonly>
                            </div>
                            <div class="form-group">
                                <label for="peran">Peran</label>
                                <input type="text" class="form-control" id="peran" name="peran"
                                    wire:model="peran" readonly>
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
    <div wire:ignore.self class="modal fade" id="con_del_dosenluar">
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
    <div wire:ignore.self class="modal fade" id="add_dosluar">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header text-white" style="background-color: #222E3C">
                    <h4 class="modal-title">Tambah Data Anggota Dosen Luar</h4>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <form>
                            @csrf
                            <div class="form-group">
                                <label for="nidn">NIDN</label>
                                <input type="text" class="form-control @error('nidn') is-invalid @enderror"
                                    id="nidn" name="nidn" wire:model="nidn">
                                @error('nidn')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="nm_dosen">Nama Dosen</label>
                                <input type="text" class="form-control @error('nm_dosen') is-invalid @enderror"
                                    id="nm_dosen" name="nm_dosen" wire:model="nm_dosen">
                                @error('nm_dosen')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="telp">Telp.</label>
                                <input type="text" class="form-control @error('telp') is-invalid @enderror"
                                    id="telp" name="telp" wire:model="telp">
                                @error('telp')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email" wire:model="email">
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="fakultas">Fakultas</label>
                                <input type="text" class="form-control @error('fakultas') is-invalid @enderror"
                                    id="fakultas" name="fakultas" wire:model="fakultas">
                                @error('fakultas')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="prodi">Program Studi</label>
                                <input type="text" class="form-control @error('prodi') is-invalid @enderror"
                                    id="prodi" name="prodi" wire:model="prodi">
                                @error('prodi')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="universitas">Universitas</label>
                                <input type="text" class="form-control @error('universitas') is-invalid @enderror"
                                    id="universitas" name="universitas" wire:model="universitas">
                                @error('universitas')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="peran">Peran</label>
                                <input type="text" class="form-control @error('peran') is-invalid @enderror"
                                    id="peran" name="peran" wire:model="peran">
                                @error('peran')
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
            $("#add_dosluar").modal('hide');
        })
        window.addEventListener('closeModal', event => {
            $("#edit_dosluar").modal('hide');
        })
        window.addEventListener('closeModal', event => {
            $("#con_del_dosenluar").modal('hide');
        })
        window.addEventListener('closeModal', event => {
            $("#detail_dosenluar").modal('hide');
        })
    </script>
</div>
