<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Proposals;
use App\Models\Prodi;
use App\Models\AnggotaMahasiswa;

class ProposalAnggotamhs extends Component
{
    public $params;
    public $id_param;
    public $ids, $nm_mahasiswa, $npm, $id_prodi, $thn_masuk, $peran;
    
    public function mount($params)
    {
        $this->id_param = $params;
    }

    public function render()
    {
        // $proposal = Proposals::where('id', $this->ids)->first();
        return view('livewire.proposal-anggotamhs', [
            'prodis' => Prodi::all(),
            'anggota' => AnggotaMahasiswa::orderBy('id', 'desc')->where('id_proposal', $this->id_param)->get()
        ]);
    }

    public function create()
    {
        $this->validate([
            'npm' => 'required|numeric|min:4|unique:anggota_mahasiswas',
            'nm_mahasiswa' => 'required|string|max:255',
            'id_prodi' => 'required',
            'thn_masuk' => 'required|numeric',
            'peran' => 'required|string'
        ]);

        AnggotaMahasiswa::create([
            'npm' => $this->npm,
            'nm_mahasiswa' => $this->nm_mahasiswa,
            'id_prodi' => $this->id_prodi,
            'thn_masuk' => $this->thn_masuk,
            'peran' => $this->peran,
            'id_proposal' => $this->id_param
        ]);

        $this->dispatchBrowserEvent('closeModal');
        $this->ClearForm();
    }

    public function ClearForm()
    {
        $this->npm = "";
        $this->nm_mahasiswa = "";
        $this->id_prodi = "";
        $this->thn_masuk = "";
        $this->peran = "";
    }
    
    public function detail($id)
    {
        $anggota = AnggotaMahasiswa::where('id', $id)->first();
        $this->npm = $anggota->npm;
        $this->nm_mahasiswa = $anggota->nm_mahasiswa;
        $this->id_prodi = $anggota->id_prodi;
        $this->thn_masuk = $anggota->thn_masuk;
        $this->peran = $anggota->peran;
        $this->ids = $anggota->id;
    }

    public function update()
    {
        $this->validate([
            // 'npm' => 'required|numeric|min:4',
            'nm_mahasiswa' => 'required|string|max:255',
            'id_prodi' => 'required',
            'thn_masuk' => 'required|numeric',
            'peran' => 'required|string'
        ]);

        $anggota = AnggotaMahasiswa::where('id', $this->ids)->first();
        if($this->npm != $anggota->npm){
            $this->validate(['npm' => 'required|numeric|min:4|unique:anggota_mahasiswas']);
        }

        $data = [
            'npm' => $this->npm,
            'nm_mahasiswa' => $this->nm_mahasiswa,
            'id_prodi' => $this->id_prodi,
            'thn_masuk' => $this->thn_masuk,
            'peran' => $this->peran
        ];
        $get = AnggotaMahasiswa::where('id',$this->ids)->update($data);
        $this->dispatchBrowserEvent('closeModal');
        $this->ClearForm();
    }

    public function confirm($id)
    {
        $anggota = AnggotaMahasiswa::where('id', $id)->first();
        $this->ids = $anggota->id;
    }

    public function delete()
    {
        $del = AnggotaMahasiswa::where('id', $this->ids)->delete();
        $this->dispatchBrowserEvent('closeModal');
        $this->ClearForm();
    }
}
