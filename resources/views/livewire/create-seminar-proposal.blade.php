<div>
    {{-- The best athlete wants his opponent at his best. --}}
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Daftar Proposal</h1>
                    <span class="badge bg-danger">Jumlah Proposal :
                        {{ $count }}</span>
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
                    <div class="col-lg-1 mb-1">
                        <select wire:model='result' class="form-control">
                            <option value="3">3</option>
                            {{-- <option value="20">20</option>
                            <option value="50">50</option>
                            <option value="100">100</option> --}}
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
                                            <th>Judul Proposal</th>
                                            <th>Bidang</th>
                                            <th>Jenis Skim</th>
                                            {{-- <th>Lokasi Kegiatan</th> --}}
                                            <th>Tahun Usulan</th>
                                            {{-- <th>Tahun Kegiatan</th>
                                            <th>Tahun Pelaksanaan</th>
                                            <th>Link Dokumen</th> --}}
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
                                                    {{-- <td>{{ $proposal->lokasi_kegiatan }}</td> --}}
                                                    <td>{{ $proposal->thn_usulan }}</td>
                                                    {{-- <td>{{ $proposal->thn_kegiatan }}</td>
                                                    <td>{{ $proposal->thn_pelaksanaan }}</td>
                                                    <td> <a href="{{ $proposal->dok_link }}" target="_blank">Link</a>
                                                    </td> --}}
                                                    <td>
                                                        @if ($proposal->id_sempro == null)
                                                            <a href="" class="btn btn-sm btn-success mb-1"
                                                                data-toggle="modal" data-target="#tambah"
                                                                wire:click="klik({{ $proposal->id_proposal }})"><i
                                                                    class="nav-icon fas fa-edit"></i>Atur
                                                                Seminar</a>
                                                        @else
                                                            <a href="" class="btn btn-sm btn-danger mb-1"
                                                                data-toggle="modal" data-target="#confirm"
                                                                wire:click="confirm({{ $proposal->id_proposal }})"><i
                                                                    class="fa-regular fa-circle-xmark"></i>Batalkan
                                                                Seminar</a>
                                                        @endif
                                                        <a href="{{ route('proposal.detail', ['id' => $proposal->id_proposal]) }}"
                                                            class="btn btn-sm btn-primary mb-1"><i
                                                                class="nav-icon fas fa-eye"></i>Detail</a>
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
        </section>
    </div><!-- /.container-fluid -->


    <!-- Modal Delete USER -->
    <div wire:ignore.self class="modal fade" id="confirm">
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
                        Apakah anda yakin untuk membatalkan <strong>Seminar</strong> ?
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
    <div wire:ignore.self class="modal fade" id="tambah">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header text-white" style="background-color: #222E3C">
                    <h4 class="modal-title">Atur Seminar</h4>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close"
                        wire:click="ClearForm">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <form>
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="tgl_seminar">Tanggal Seminar</label>
                                    <input type="date"
                                        class="form-control @error('tgl_seminar') is-invalid @enderror" id="tgl_seminar"
                                        placeholder="Tanggal Seminar" wire:model="tgl_seminar">
                                    @error('tgl_seminar')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="jam_seminar">Jam Seminar</label>
                                    <input type="time"
                                        class="form-control @error('jam_seminar') is-invalid @enderror"
                                        id="jam_seminar" placeholder="Tanggal Seminar" wire:model="jam_seminar">
                                    @error('jam_seminar')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="sifat_seminar">Sifat Seminar</label>
                                    <select name="sifat_seminar" id="sifat_seminar"
                                        class="form-control @error('sifat_seminar') is-invalid @enderror"
                                        wire:model="sifat_seminar" onChange="opsi(this)">
                                        <option value="" selected>-- Pilih --</option>
                                        <option value="Daring">Daring</option>
                                        <option value="Luring">Luring</option>
                                    </select>
                                    @error('sifat_seminar')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="tmpt_seminar">Tempat Seminar</label>
                                    <input type="text"
                                        class="form-control @error('tmpt_seminar') is-invalid @enderror"
                                        id="tmpt_seminar" placeholder="Tempat Seminar" wire:model="tmpt_seminar"
                                        wire:ignore.self>
                                    <small><i>*(Abaikan Jika Sifat Seminar Daring)</i></small>
                                    @error('tmpt_seminar')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="tautan">Tautan</label>
                                    <input type="text" class="form-control @error('tautan') is-invalid @enderror"
                                        id="tautan" placeholder="https://www.meet.google.co.id"
                                        wire:model="tautan" wire:ignore.self>
                                    <small><i>*(Abaikan Jika Sifat Seminar Luring)</i></small>
                                    @error('tautan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="reviewer1">Reviewer 1</label>
                                    <input type="text"
                                        class="form-control @error('reviewer1') is-invalid @enderror" id="reviewer1"
                                        placeholder="Jhon Doe" wire:model="reviewer1">
                                    @error('reviewer1')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="reviewer2">Reviewer 2</label>
                                    <input type="text"
                                        class="form-control @error('reviewer2') is-invalid @enderror" id="reviewer2"
                                        placeholder="Anna Watson" wire:model="reviewer2">
                                    @error('reviewer2')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <button type="button" class="btn btn-primary" wire:click="atur()">Submit</button>
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
        function opsi(value) {
            var st = $("#sifat_seminar").val();
            if (st == "Daring") {
                document.getElementById("tmpt_seminar").disabled = true;
                document.getElementById("tautan").disabled = false;
            } else if (st == "Luring") {
                document.getElementById("tmpt_seminar").disabled = false;
                document.getElementById("tautan").disabled = true;
            } else {
                document.getElementById("tmpt_seminar").disabled = true;
                document.getElementById("tautan").disabled = true;
            }
        }
    </script>
    <script>
        window.addEventListener('closeModal', event => {
            $("#tambah").modal('hide');
        })
        window.addEventListener('closeModal', event => {
            $("#confirm").modal('hide');
        })
    </script>
</div>
