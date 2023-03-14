<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Dosens;
use App\Models\Prodi;
use Illuminate\Support\Facades\DB;

class DosenTable extends Component
{
    public $ids, $id_prodi, $nm_dosen, $alamat_dosen, $jafung, $telp, $email;
    public $search ="";
    public $result =10;

    public function render()
    {
        return view('livewire.dosen-table', [
            'prodis' => Prodi::all(),
            'dosens' => Dosens::orderBy('id', 'desc')
            ->where('nm_dosen', 'like', '%'.$this->search.'%')
            ->orWhere('nidn', 'like', '%'.$this->search.'%')
            ->paginate($this->result)
        ])
        ->extends('layouts.master')
        ->section('content');
    }

    public function create()
    {
        $this->validate([
            'nidn' => 'required|numeric|min:4|unique:dosens',
            'nm_dosen' => 'required|string|max:255',
            'telp' => 'required',
            'email' => 'required|email|unique:dosens',
            'jafung' => 'required|string',
            'alamat_dosen' => 'required|string',
            'id_prodi' => 'required'
        ]);

        Dosens::create([
            'nidn' => $this->nidn,
            'nm_dosen' => $this->nm_dosen,
            'telp' => $this->telp,
            'email' => $this->email,
            'alamat_dosen' => $this->alamat_dosen,
            'jafung' => $this->jafung,
            'id_prodi' => $this->id_prodi
        ]);
        session()->flash('success', 'Berhasil Menambahkan Data Dosen!');
        $this->dispatchBrowserEvent('closeModal');
        $this->ClearForm();
    }

    // Clear Form
    public function ClearForm()
    {
        $this->nidn = "";
        $this->nm_dosen = "";
        $this->telp = "";
        $this->email = "";
        $this->alamat_dosen = "";
        $this->id_prodi = "";
        $this->jafung = "";
    }

    public function detail($id)
    {
        $dosen = Dosens::where('id', $id)->first();
        $this->nidn = $dosen->nidn;
        $this->nm_dosen = $dosen->nm_dosen;
        $this->telp = $dosen->telp;
        $this->email = $dosen->email;
        $this->alamat_dosen = $dosen->alamat_dosen;
        $this->id_prodi = $dosen->id_prodi;
        $this->jafung = $dosen->jafung;
        $this->ids = $dosen->id;
    }

    public function update()
    {
        $this->validate([
            // 'nidn' => 'required|numeric|min:4|unique:dosens',
            'nm_dosen' => 'required|string|max:255',
            'telp' => 'required',
            // 'email' => 'required|email|unique:dosens',
            'jafung' => 'required|string',
            'alamat_dosen' => 'required|string',
            'id_prodi' => 'required'
        ]);

        $anggota = Dosens::where('id', $this->ids)->first();
        if($this->nidn != $anggota->nidn){
            $this->validate(['nidn' => 'required|numeric|min:4|unique:dosens']);
        }
        if($this->email != $anggota->email){
            $this->validate(['email' => 'required|email|unique:dosens']);
        }

        $data = [
            'nidn' => $this->nidn,
            'nm_dosen' => $this->nm_dosen,
            'telp' => $this->telp,
            'email' => $this->email,
            'alamat_dosen' => $this->alamat_dosen,
            'jafung' => $this->jafung,
            'id_prodi' => $this->id_prodi
        ];
        $get = Dosens::where('id',$this->ids)->update($data);
        session()->flash('success', 'Berhasil Edit Data Dosen!');
        $this->dispatchBrowserEvent('closeModal');
        $this->ClearForm();
    }

    public function confirm($id)
    {
        $dosen = Dosens::where('id', $id)->first();
        $this->ids = $dosen->id;
    }

    public function delete()
    {
        $del = Dosens::where('id', $this->ids)->delete();

        session()->flash('success', 'Data Berhasil Dihapus');
        $this->dispatchBrowserEvent('closeModal');
        $this->ClearForm();
    }
}
