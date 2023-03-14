<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\Bidang;

class BidangTable extends Component
{
    public $ids, $slug, $nm_bidang;
    public $enm_bidang, $eslug;
    public $search ="";
    public $result =10;

    public function render()
    {
        
        return view('livewire.bidang-table', [
            'bidangs' => Bidang::orderBy('id_bidang', 'desc')
            ->where('nm_bidang', 'like', '%'.$this->search.'%')
            ->orWhere('slug', 'like', '%'.$this->search.'%')
            ->paginate($this->result)
        ])
        ->extends('layouts.master')
        ->section('content');
    }

    public function create()
    {
        $this->validate([
            'nm_bidang' => 'required|string|min:4'
        ]);
        Bidang::create([
            'nm_bidang' => $this->nm_bidang,
            'slug' => Str::of($this->nm_bidang)->slug('-')
        ]);
        session()->flash('success', 'Berhasil Menambahkan Data Bidang!');
        $this->dispatchBrowserEvent('closeModal');
        $this->ClearForm();
    }

    // Clear Form
    public function ClearForm()
    {
        $this->nm_bidang = Null;
    }
    
    // Edit
    public function edit($id)
    {
        $bidang = DB::table('bidangs')->where('id_bidang', $id)->first();
        $this->enm_bidang = $bidang->nm_bidang;
        $this->ids = $bidang->id_bidang;
    }

    public function update()
    {
        $data = [
            'nm_bidang' => $this->enm_bidang,
            'slug' => Str::of($this->enm_bidang)->slug('-')
        ];
        $get=Bidang::where('id_bidang', $this->ids)->update($data);
        session()->flash('success', 'Berhasil Edit Data Bidang!');
        $this->dispatchBrowserEvent('closeModal');
        $this->ClearForm();
    }

    public function confirm($id)
    {
        $bidang = Bidang::where('id_bidang', $id)->first();
        $this->ids = $bidang->id_bidang;
    }

    public function delete()
    {
        $del = Bidang::where('id_bidang', $this->ids)->delete();

        session()->flash('success', 'Data Berhasil Dihapus');
        $this->dispatchBrowserEvent('closeModal');
        $this->ClearForm();
    }
}
