<?php

namespace App\Http\Livewire;

use App\Models\Skim;
use App\Models\Bidang;
use Livewire\Component;
use App\Models\Proposals;
use App\Models\AnggotaDosenLokal;
use App\Models\AnggotaDosenLuar;
use App\Models\AnggotaMahasiswa;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ListProposal extends Component
{
    public $ids, $judul_proposal, $id_bidang, $id_skim, $lokasi_kegiatan, $thn_usulan, $thn_kegiatan, $thn_pelaksanaan, $dok_link;
    public $ejudul_proposal, $eid_bidang, $eid_skim, $elokasi_kegiatan, $ethn_usulan, $ethn_kegiatan, $ethn_pelaksanaan, $edok_link;
    public $search="";
    public $result=10;

    public function render()
    {
        return view('livewire.list-proposal', [
            'proposals' => DB::table('proposals')
            ->leftJoin('bidangs', 'bidangs.id_bidang', 'proposals.id_bidang')
            ->leftJoin('skims', 'skims.id_skim', 'proposals.id_skim')
            ->orderBy('id_proposal','desc')
            ->where('judul_proposal', 'like', '%'.$this->search.'%')
            ->orWhere('thn_usulan', 'like', '%'.$this->search.'%')
            ->orWhere('thn_kegiatan', 'like', '%'.$this->search.'%')
            ->orWhere('thn_pelaksanaan', 'like', '%'.$this->search.'%')
            ->orWhere('nm_bidang', 'like', '%'.$this->search.'%')
            ->orWhere('nm_skim', 'like', '%'.$this->search.'%')
            ->orWhere('thn_pelaksanaan', 'like', '%'.$this->search.'%')
            ->paginate($this->result),
            'bidangs' => Bidang::all(),
            'skims' => Skim::all()
        ])
        ->extends('layouts.master')
        ->section('content');
    }

    public function create()
    {
        $this->validate([
            'judul_proposal' => 'required|string|min:10|unique:proposals',
            'id_bidang' => 'required',
            'id_skim' => 'required',
            'lokasi_kegiatan' => 'required|string|min:4',
            'thn_usulan' => 'required|numeric',
            'thn_kegiatan' => 'required|numeric',
            'thn_pelaksanaan' => 'required|numeric',
            'dok_link' => 'required',
        ]);

        Proposals::create([
            'judul_proposal' => $this->judul_proposal,
            'slug' => Str::of($this->judul_proposal)->slug('-'),
            'id_bidang' => $this->id_bidang,
            'id_skim' => $this->id_skim,
            'lokasi_kegiatan' => $this->lokasi_kegiatan,
            'thn_usulan' => $this->thn_usulan,
            'thn_kegiatan' => $this->thn_kegiatan,
            'thn_pelaksanaan' => $this->thn_pelaksanaan,
            'dok_link' => $this->dok_link
        ]);
        $this->dispatchBrowserEvent('closeModal');
        session()->flash('success', 'Berhasil Menambahkan Data Proposal!');
        $this->ClearForm();
    }

    public function ClearForm()
    {
        $this->judul_proposal = Null;
        $this->id_bidang = Null;
        $this->id_skim = Null;
        $this->lokasi_kegiatan = Null;
        $this->thn_usulan = Null;
        $this->thn_kegiatan = Null;
        $this->thn_pelaksanaan = Null;
        $this->dok_link = Null;
    }

    public function edit($id)
    {
        $proposal = Proposals::where('id_proposal', $id)->first();
        $this->ids = $proposal->id_proposal;
        $this->judul_proposal = $proposal->judul_proposal;
        $this->id_bidang = $proposal->id_bidang;
        $this->id_skim = $proposal->id_skim;
        $this->lokasi_kegiatan = $proposal->lokasi_kegiatan;
        $this->thn_usulan = $proposal->thn_usulan;
        $this->thn_kegiatan = $proposal->thn_kegiatan;
        $this->thn_pelaksanaan = $proposal->thn_pelaksanaan;
        $this->dok_link = $proposal->dok_link;
    }

    public function update()
    {
        
        $this->validate([
            // 'judul_proposal' => 'required|string|min:10|unique:proposals',
            'id_bidang' => 'required',
            'id_skim' => 'required',
            'lokasi_kegiatan' => 'required|string|min:4',
            'thn_usulan' => 'required|numeric',
            'thn_kegiatan' => 'required|numeric',
            'thn_pelaksanaan' => 'required|numeric',
            'dok_link' => 'required'
        ]);

        $proposal = Proposals::where('id_proposal', $this->ids)->first();
        if($this->judul_proposal != $proposal->judul_proposal){
            $this->validate(['judul_proposal' => 'required|string|min:10|unique:proposals']);
        }

        $data = [
            'judul_proposal' => $this->judul_proposal,
            'id_bidang' => $this->id_bidang,
            'id_skim' => $this->id_skim,
            'lokasi_kegiatan' => $this->lokasi_kegiatan,
            'thn_usulan' => $this->thn_usulan,
            'thn_kegiatan' => $this->thn_kegiatan,
            'thn_pelaksanaan' => $this->thn_pelaksanaan,
            'dok_link' => $this->dok_link
        ];
        $get = Proposals::where('id_proposal',$this->ids)->update($data);
        $this->dispatchBrowserEvent('closeModal');
        session()->flash('success', 'Data Berhasil Diedit');
        $this->ClearForm();
    
    }

    public function details($id)
    {
        $proposal = Proposals::where('id_proposal', $id)->first();
        $this->ids = $proposal->id_proposal;
        $this->judul_proposal = $proposal->judul_proposal;
        $this->id_bidang = $proposal->id_bidang;
        $this->id_skim = $proposal->id_skim;
        $this->lokasi_kegiatan = $proposal->lokasi_kegiatan;
        $this->thn_usulan = $proposal->thn_usulan;
        $this->thn_kegiatan = $proposal->thn_kegiatan;
        $this->thn_pelaksanaan = $proposal->thn_pelaksanaan;
        $this->dok_link = $proposal->dok_link;
    }

    public function confirmdel($id){
        $prop = Proposals::where('id_proposal', $id)->first();
        $this->ids = $prop->id_proposal;
    }

    public function delete()
    {
        
        $del = Proposals::where('id_proposal', $this->ids)->delete();
        AnggotaDosenLokal::where('id_proposal', $this->ids)->delete();
        AnggotaDosenLuar::where('id_proposal', $this->ids)->delete();
        AnggotaMahasiswa::where('id_proposal', $this->ids)->delete();
        session()->flash('success', 'Data Berhasil Dihapus');
        $this->dispatchBrowserEvent('closeModal');
        $this->ClearForm();
    }

    public function deleteall()
    {
        DB::table('proposals')->truncate();
        DB::table('anggota_dosen_lokals')->truncate();
        DB::table('anggota_dosen_luars')->truncate();
        DB::table('anggota_mahasiswas')->truncate();
    }
}
