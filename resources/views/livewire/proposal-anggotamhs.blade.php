<div>
    {{-- The best athlete wants his opponent at his best. --}}
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Anggota Mahasiswa</h3>&nbsp;
            <span>
                <a href="" class="btn-sm btn-success mb-3" data-target="#add" data-toggle="modal"><i
                        class="nav-icon fas fa-plus" wire:click='ClearForm'></i> Tambah
                    Anggota
                    Mahasiswa</a>
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
                            <th>NPM</th>
                            <th>Nama Mahasiswa</th>
                            <th>Peran</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($anggota) != null)
                            @foreach ($anggota as $index => $mhs)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $mhs->npm }}</td>
                                    <td>{{ $mhs->nm_mahasiswa }}</td>
                                    <td>{{ $mhs->peran }}</td>
                                    <td>
                                        <a href="" class="btn-sm btn-warning" data-toggle="modal"
                                            data-target="#edit" wire:click="detail({{ $mhs->id }})"><i
                                                class="nav-icon fas fa-edit"></i>
                                            Edit</a>
                                        <a href="" class="btn-sm btn-danger" data-toggle="modal"
                                            data-target="#con_del" wire:click="confirm({{ $mhs->id }})"><i
                                                class="nav-icon fas fa-trash"></i> Delete</a>
                                        <a href="" class="btn-sm btn-primary" data-toggle="modal"
                                            data-target="#detail" wire:click="detail({{ $mhs->id }})"><i
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
    <div wire:ignore.self class="modal fade" id="edit">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header text-white" style="background-color: #222E3C">
                    <h4 class="modal-title">Edit Data Anggota Mahasiswa</h4>
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
                                <label for="npm">NPM</label>
                                <input type="text" class="form-control @error('npm') is-invalid @enderror"
                                    id="npm" name="npm" wire:model="npm">
                                @error('npm')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="nm_mahasiswa">Nama Mahasiswa</label>
                                <input type="text" class="form-control @error('nm_mahasiswa') is-invalid @enderror"
                                    id="nm_mahasiswa" name="nm_mahasiswa" wire:model="nm_mahasiswa">
                                @error('nm_mahasiswa')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="id_prodi">Program Studi</label>
                                <select id="id_prodi" class="form-control @error('id_prodi') is-invalid @enderror"
                                    wire:model="id_prodi">
                                    <option selected>-- Pilih Jenis Prodi --</option>
                                    @foreach ($prodis as $prodi)
                                        <option value="{{ $prodi->id }}">{{ $prodi->nm_prodi }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="thn_masuk">Tahun Masuk</label>
                                <input type="number" class="form-control @error('thn_masuk') is-invalid @enderror"
                                    id="thn_masuk" name="thn_masuk" wire:model="thn_masuk">
                                @error('thn_masuk')
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
    <div wire:ignore.self class="modal fade" id="detail">
        <div class="modal-dialog">
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
                                <label for="npm">NPM</label>
                                <input type="text" class="form-control" id="npm" name="npm"
                                    wire:model="npm" readonly>
                            </div>
                            <div class="form-group">
                                <label for="nm_mahasiswa">Nama Mahasiswa</label>
                                <input type="text" class="form-control" id="nm_mahasiswa" name="nm_mahasiswa"
                                    wire:model="nm_mahasiswa" readonly>

                            </div>
                            <div class="form-group">
                                <label for="id_prodi">Program Studi</label>
                                <select id="id_prodi" class="form-control" wire:model="id_prodi" readonly>
                                    <option selected>-- Pilih Jenis Prodi --</option>
                                    @foreach ($prodis as $prodi)
                                        <option value="{{ $prodi->id }}">{{ $prodi->nm_prodi }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="thn_masuk">Tahun Masuk</label>
                                <input type="number" class="form-control" id="thn_masuk" name="thn_masuk"
                                    wire:model="thn_masuk" readonly>
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
    <div wire:ignore.self class="modal fade" id="con_del">
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
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header text-white" style="background-color: #222E3C">
                    <h4 class="modal-title">Tambah Data Anggota Mahasiswa</h4>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <form>
                            @csrf
                            <div class="form-group">
                                <label for="npm">NPM</label>
                                <input type="text" class="form-control @error('npm') is-invalid @enderror"
                                    id="npm" name="npm" wire:model="npm">
                                @error('npm')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="nm_mahasiswa">Nama Mahasiswa</label>
                                <input type="text" class="form-control @error('nm_mahasiswa') is-invalid @enderror"
                                    id="nm_mahasiswa" name="nm_mahasiswa" wire:model="nm_mahasiswa">
                                @error('nm_mahasiswa')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="id_prodi">Program Studi</label>
                                <select id="id_prodi" class="form-control @error('id_prodi') is-invalid @enderror"
                                    wire:model="id_prodi">
                                    <option selected>-- Pilih Jenis Prodi --</option>
                                    @foreach ($prodis as $prodi)
                                        <option value="{{ $prodi->id }}">{{ $prodi->nm_prodi }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="thn_masuk">Tahun Masuk</label>
                                <input type="number" class="form-control @error('thn_masuk') is-invalid @enderror"
                                    id="thn_masuk" name="thn_masuk" wire:model="thn_masuk">
                                @error('thn_masuk')
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
            $("#add").modal('hide');
        })
        window.addEventListener('closeModal', event => {
            $("#edit").modal('hide');
        })
        window.addEventListener('closeModal', event => {
            $("#con_del").modal('hide');
        })
        window.addEventListener('closeModal', event => {
            $("#detail").modal('hide');
        })
    </script>
</div>
