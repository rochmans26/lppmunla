<div>
    {{-- The best athlete wants his opponent at his best. --}}
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Daftar Laporan Hasil</h1>
                    <span class="badge bg-danger">Jumlah Laporan Hasil :
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
                                            <th>Judul PKM</th>
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
                                        @if (count($laporanhasils) != null)
                                            @foreach ($laporanhasils as $index => $laphasil)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $laphasil->judul_pkm }}</td>
                                                    <td>{{ $laphasil->nm_bidang }}</td>
                                                    <td>{{ $laphasil->nm_skim }}</td>
                                                    {{-- <td>{{ $laphasil->lokasi_kegiatan }}</td> --}}
                                                    <td>{{ $laphasil->thn_usulan }}</td>
                                                    {{-- <td>{{ $proposal->thn_kegiatan }}</td>
                                                    <td>{{ $proposal->thn_pelaksanaan }}</td>
                                                    <td> <a href="{{ $proposal->dok_link }}" target="_blank">Link</a>
                                                    </td> --}}
                                                    <td>
                                                        @if ($laphasil->id_semhas == null)
                                                            <a href="" class="btn btn-sm btn-success mb-1"
                                                                data-toggle="modal" data-target="#tambah"
                                                                wire:click="klik({{ $laphasil->id_laphasil }})"><i
                                                                    class="nav-icon fas fa-edit"></i>Atur
                                                                Seminar</a>
                                                        @else
                                                            <a href="" class="btn btn-sm btn-danger mb-1"
                                                                data-toggle="modal" data-target="#confirm"
                                                                wire:click="confirm({{ $laphasil->id_laphasil }})"><i
                                                                    class="fa-regular fa-circle-xmark"></i>Batalkan
                                                                Seminar</a>
                                                        @endif
                                                        @if (Auth::user()->level == 'sp-admin')
                                                            <a href="{{ route('sp-admin.laphasil.detail', ['id' => $laphasil->id_laphasil]) }}"
                                                                class="btn btn-sm btn-primary mb-1"><i
                                                                    class="nav-icon fas fa-eye"></i>Detail</a>
                                                        @else
                                                            <a href="{{ route('admin.laphasil.detail', ['id' => $laphasil->id_laphasil]) }}"
                                                                class="btn btn-sm btn-primary mb-1" target="_blank"><i
                                                                    class="nav-icon fas fa-eye"></i>Detail</a>
                                                        @endif
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
                                    {{ $laporanhasils->links() }}
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
                                    <label for="tgl_semhas">Tanggal Seminar</label>
                                    <input type="date" class="form-control @error('tgl_semhas') is-invalid @enderror"
                                        id="tgl_semhas" placeholder="Tanggal Seminar" wire:model="tgl_semhas">
                                    @error('tgl_semhas')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="jam_semhas">Jam Seminar</label>
                                    <input type="time"
                                        class="form-control @error('jam_semhas') is-invalid @enderror" id="jam_semhas"
                                        placeholder="Tanggal Seminar" wire:model="jam_semhas">
                                    @error('jam_semhas')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="sifat_semhas">Sifat Seminar</label>
                                    <select name="sifat_semhas" id="sifat_semhas"
                                        class="form-control @error('sifat_semhas') is-invalid @enderror"
                                        wire:model="sifat_semhas" onChange="opsi(this)">
                                        <option value="" selected>-- Pilih --</option>
                                        <option value="Daring">Daring</option>
                                        <option value="Luring">Luring</option>
                                    </select>
                                    @error('sifat_semhas')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="tmpt_semhas">Tempat Seminar</label>
                                    <input type="text"
                                        class="form-control @error('tmpt_semhas') is-invalid @enderror"
                                        id="tmpt_semhas" placeholder="Tempat Seminar" wire:model="tmpt_semhas"
                                        wire:ignore.self>
                                    <small><i>*(Abaikan Jika Sifat Seminar Daring)</i></small>
                                    @error('tmpt_semhas')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="tautan_semhas">Tautan Seminar Hasil</label>
                                    <input type="text"
                                        class="form-control @error('tautan_semhas') is-invalid @enderror"
                                        id="tautan_semhas" placeholder="https://www.meet.google.co.id"
                                        wire:model="tautan_semhas" wire:ignore.self>
                                    <small><i>*(Abaikan Jika Sifat Seminar Luring)</i></small>
                                    @error('tautan_semhas')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="rev1_semhas">Reviewer 1</label>
                                    <input type="text"
                                        class="form-control @error('rev1_semhas') is-invalid @enderror"
                                        id="rev1_semhas" placeholder="Jhon Doe" wire:model="rev1_semhas">
                                    @error('rev1_semhas')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="rev2_semhas">Reviewer 2</label>
                                    <input type="text"
                                        class="form-control @error('rev2_semhas') is-invalid @enderror"
                                        id="rev2_semhas" placeholder="Anna Watson" wire:model="rev2_semhas">
                                    @error('rev2_semhas')
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
            var st = $("#sifat_semhas").val();
            if (st == "Daring") {
                document.getElementById("tmpt_semhas").disabled = true;
                document.getElementById("tautan_semhas").disabled = false;
            } else if (st == "Luring") {
                document.getElementById("tmpt_semhas").disabled = false;
                document.getElementById("tautan_semhas").disabled = true;
            } else {
                document.getElementById("tmpt_semhas").disabled = true;
                document.getElementById("tautan_semhas").disabled = true;
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
