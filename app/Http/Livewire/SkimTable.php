<?php

namespace App\Http\Livewire;

use App\Models\Skim;
use Livewire\Component;
use Illuminate\Support\Str;

class SkimTable extends Component
{
    public $ids, $slug, $nm_skim;
    public $enm_skim, $eslug;
    public $search="";
    public $result=10;

    public function render()
    {
        return view('livewire.skim-table', [
            'skims' => Skim::orderBy('id_skim','desc')
            ->where('nm_skim', 'like', '%'.$this->search.'%')
            ->orWhere('slug', 'like', '%'.$this->search.'%')
            ->paginate($this->result)
        ])
        ->extends('layouts.master')
        ->section('content');
    }

    public function create()
    {
        $this->validate([
            'nm_skim' => 'required|string|min:4'
        ]);
        Skim::create([
            'nm_skim' => $this->nm_skim,
            'slug' => Str::of($this->nm_skim)->slug('-')
        ]);
        session()->flash('success', 'Berhasil Menambahkan Data Bidang!');
        $this->dispatchBrowserEvent('closeModal');
        $this->ClearForm();
    }

    // Clear Form
    public function ClearForm()
    {
        $this->nm_skim = Null;
    }
    
    // Edit
    public function edit($id)
    {
        $skim = Skim::where('id_skim', $id)->first();
        $this->enm_skim = $skim->nm_skim;
        $this->ids = $skim->id_skim;
    }

    public function update()
    {
        $data = [
            'nm_skim' => $this->enm_skim,
            'slug' => Str::of($this->enm_skim)->slug('-')
        ];
        $get=Skim::where('id_skim', $this->ids)->update($data);
        session()->flash('success', 'Berhasil Edit Data Skim!');
        $this->dispatchBrowserEvent('closeModal');
        $this->ClearForm();
    }

    public function confirm($id)
    {
        $skim = Skim::where('id_skim', $id)->first();
        $this->ids = $skim->id_skim;
    }

    public function delete()
    {
        $del = Skim::where('id_skim', $this->ids)->delete();

        session()->flash('success', 'Data Berhasil Dihapus');
        $this->dispatchBrowserEvent('closeModal');
        $this->ClearForm();
    }
}
