<?php

namespace App\Http\Livewire;
use App\Models\Prodi;
use Livewire\Component;
use App\Models\Fakultas;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProdiTable extends Component
{
    public $id_prodi, $nm_prodi, $id_fak, $ids;
    public $eid_prodi, $enm_prodi, $eid_fak;
    public $search="";
    public $result=10;

    public function render()
    {
        return view('livewire.prodi-table', [
            'prodis' => Prodi::orderBy('id', 'desc')
            ->where('nm_prodi', 'like', '%'.$this->search.'%')
            ->orWhere('slug', 'like', '%'.$this->search.'%')
            ->paginate($this->result),
            'fakultas' => Fakultas::all()
        ])
        ->extends('layouts.master')
        ->section('content');
    }

    public function create()
    {
        $this->validate([
            'id_prodi' => 'required|unique:prodis',
            'id_fak' => 'required',
            'nm_prodi' => 'required|string|min:4|unique:prodis'
        ]);

        Prodi::create([
            'id_prodi' => $this->id_prodi,
            'id_fak' => $this->id_fak,
            'nm_prodi' => $this->nm_prodi,
            'slug' => Str::of($this->nm_prodi)->slug('-')
        ]);
        session()->flash('success', 'Berhasil Menambahkan Data Fakultas!');
        $this->dispatchBrowserEvent('closeModal');
        $this->ClearForm();
    }

    // Clear Form
    public function ClearForm()
    {
        $this->nm_prodi = Null;
        $this->id_prodi = Null;
        $this->id_fak = Null;
    }
    
    // Edit
    public function edit($id)
    {
        $fak = Fakultas::where('id', $id)->first();
        $this->enm_fak = $fak->nm_fak;
        $this->eid_fak = $fak->id_fak;
        $this->ids = $fak->id;
    }

    public function update()
    {
        $data = [
            'id_fak' => $this->eid_fak,
            'nm_fak' => $this->enm_fak,
            'slug' => Str::of($this->enm_fak)->slug('-')
        ];
        $get=Fakultas::where('id', $this->ids)->update($data);
        session()->flash('success', 'Berhasil Edit Data Skim!');
        $this->dispatchBrowserEvent('closeModal');
        $this->ClearForm();
    }

    public function confirm($id)
    {
        $fak = Fakultas::where('id', $id)->first();
        $this->ids = $fak->id;
    }

    public function delete()
    {
        $del = Fakultas::where('id', $this->ids)->delete();

        session()->flash('success', 'Data Berhasil Dihapus');
        $this->dispatchBrowserEvent('closeModal');
        $this->ClearForm();
    }
}
