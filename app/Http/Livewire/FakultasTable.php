<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Fakultas;
use Illuminate\Support\Str;

class FakultasTable extends Component
{
    public $ids, $slug, $nm_fak, $id_fak;
    public $enm_fak, $eid_fak;
    public $search="";
    public $result=10;

    public function render()
    {
        return view('livewire.fakultas-table', [
            'fakultas' => Fakultas::orderBy('id', 'desc')
            ->where('nm_fak', 'like', '%'.$this->search.'%')
            ->orWhere('slug', 'like', '%'.$this->search.'%')
            ->paginate($this->result)
        ])
        ->extends('layouts.master')
        ->section('content');
    }

    public function create()
    {
        $this->validate([
            'id_fak' => 'required|numeric',
            'nm_fak' => 'required|string|min:4|unique:fakultas',
        ]);

        Fakultas::create([
            'id_fak' => $this->id_fak,
            'nm_fak' => $this->nm_fak,
            'slug' => Str::of($this->nm_fak)->slug('-')
        ]);
        session()->flash('success', 'Berhasil Menambahkan Data Fakultas!');
        $this->dispatchBrowserEvent('closeModal');
        $this->ClearForm();
    }

    // Clear Form
    public function ClearForm()
    {
        $this->nm_fak = Null;
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
