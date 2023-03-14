<div>
    {{-- The best athlete wants his opponent at his best. --}}
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
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Anggota Dosen</h3>&nbsp;
            <span>
                <a href="" class="btn-sm btn-success mb-3" data-target="#add_doslokal" data-toggle="modal"><i
                        class="nav-icon fas fa-plus" wire:click='ClearForm'></i> Tambah
                    Anggota
                    Dosen</a>
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
                            <th>Nama Dosen Lokal</th>
                            <th>Peran</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($anggota) != null)
                            @foreach ($anggota as $index => $doslok)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $doslok->dosen->nidn }}</td>
                                    <td>{{ $doslok->dosen->nm_dosen }}</td>
                                    <td>{{ $doslok->peran }}</td>
                                    <td>
                                        <a href="" class="btn-sm btn-warning" data-toggle="modal"
                                            data-target="#edit_doslokal" wire:click="detail({{ $doslok->id }})"><i
                                                class="nav-icon fas fa-edit"></i>
                                            Edit</a>
                                        <a href="" class="btn-sm btn-danger" data-toggle="modal"
                                            data-target="#con_del_dosenlokal"
                                            wire:click="confirm({{ $doslok->id }})"><i
                                                class="nav-icon fas fa-trash"></i> Delete</a>
                                        {{-- <a href="" class="btn-sm btn-primary" data-toggle="modal"
                                            data-target="#detail_dosenlokal" wire:click="detail({{ $doslok->id }})"><i
                                                class="nav-icon fas fa-eye"></i>
                                            Detail</a> --}}
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


    <!-- Modal Edit -->
    <div wire:ignore.self class="modal fade" id="edit_doslokal">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header text-white" style="background-color: #222E3C">
                    <h4 class="modal-title">Edit Data Anggota Dosen Lokal</h4>
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

                                <label for="id_dosen">Nama Dosen</label>
                                <input type="text" class="form-control @error('id_dosen') is-invalid @enderror"
                                    id="id_dosen" name="id_dosen" wire:model="search" wire:keyup="searchResult"
                                    placeholder="Cari NIDN/NIP/Nama Dosen">
                                @if ($showresult)
                                    <div class="option">
                                        <ul>
                                            @if (!empty($records))
                                                @foreach ($records as $record)
                                                    <li wire:click="fetchDosenDetail({{ $record->id }})">
                                                        {{ $record->nidn }} - {{ $record->nm_dosen }}</li>
                                                @endforeach
                                            @endif
                                        </ul>
                                    </div>
                                @endif
                                @error('id_dosen')
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
                        wire:click="ClearForm">Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <!-- Modal Delete USER -->
    <div wire:ignore.self class="modal fade" id="con_del_dosenlokal">
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
    <div wire:ignore.self class="modal fade" id="add_doslokal">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header text-white" style="background-color: #222E3C">
                    <h4 class="modal-title">Tambah Data Anggota Dosen Lokal</h4>
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

                                <label for="id_dosen">Nama Dosen</label>
                                <input type="text" class="form-control @error('id_dosen') is-invalid @enderror"
                                    id="id_dosen" name="id_dosen" wire:model="search" wire:keyup="searchResult"
                                    placeholder="Cari NIDN/NIP/Nama Dosen">
                                @if ($showresult)
                                    <div class="option">
                                        <ul>
                                            @if (!empty($records))
                                                @foreach ($records as $record)
                                                    <li wire:click="fetchDosenDetail({{ $record->id }})">
                                                        {{ $record->nidn }} - {{ $record->nm_dosen }}</li>
                                                @endforeach
                                            @endif
                                        </ul>
                                    </div>
                                @endif
                                @error('id_dosen')
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
            $("#add_doslokal").modal('hide');
        })
        window.addEventListener('closeModal', event => {
            $("#edit_doslokal").modal('hide');
        })
        window.addEventListener('closeModal', event => {
            $("#con_del_dosenlokal").modal('hide');
        })
        window.addEventListener('closeModal', event => {
            $("#detail_dosenlokal").modal('hide');
        })
    </script>
</div>
