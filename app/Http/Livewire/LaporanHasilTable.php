<?php

namespace App\Http\Livewire;

use App\Models\Skim;
use App\Models\Bidang;
use Livewire\Component;
use App\Models\Proposals;
use App\Models\LaporanHasil;
use Illuminate\Support\Facades\DB;

class LaporanHasilTable extends Component
{
    public $id_proposal, $ids, $id_laphasil, $judul_pkm, $id_bidang, $id_skim, $lok_kegiatan, $thn_usulan, $thn_kegiatan, $thn_pelaksanaan, $pendanaan, $nosk_pkm, $tglsk_pkm, $mitra_pkm, $dok_link, $dana_dikti, $dana_unla, $dana_lainnya;

    public $search="";
    public $result=10;

    public $showresult = false;
    public $type = "";
    public $records;

    public function typeResult()
    {
        if(!empty($this->type)){
            $this->records = DB::table('proposals')
            ->where('judul_proposal','like','%'.$this->type.'%')
            ->limit(5)
            ->get();
            $this->showresult = true;
        }else{
            $this->showresult = false;
        }
    }

    // Fetch record by ID
    public function fetchProposalDetail($id){
        // dd($id);
        

        $record = DB::table('proposals')->where('id_proposal', $id)->first();

        $this->type = $record->judul_proposal;
        // $this->empDetails = $record;
        $this->id_proposal = $record->id_proposal;
        $this->showresult = false;
    }

    public function render()
    {
        return view('livewire.laporan-hasil-table',[
            'laporanhasil' => DB::table('laporan_hasils')
            ->leftJoin('bidangs', 'bidangs.id_bidang', 'laporan_hasils.id_bidang')
            ->leftJoin('skims', 'skims.id_skim', 'laporan_hasils.id_skim')
            ->leftJoin('proposals', 'proposals.id_proposal', 'laporan_hasils.id_proposal')
            ->orderBy('id_laphasil','desc')
            ->where('judul_pkm', 'like', '%'.$this->search.'%')
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
            'id_proposal' => 'required|numeric',
            'judul_pkm' => 'required|string|min:5|unique:laporan_hasils',
            'id_bidang' => 'required',
            'id_skim' => 'required',
            'lok_kegiatan' => 'required|string|min:4',
            'thn_usulan' => 'required|numeric',
            'thn_kegiatan' => 'required|numeric',
            'thn_pelaksanaan' => 'required|numeric',
            'dana_dikti' => 'required|numeric',
            'dana_unla' => 'required|numeric',
            'dana_lainnya' => 'required|numeric',
            'nosk_pkm' => 'required',
            'tglsk_pkm' => 'required|date',
            'mitra_pkm' => 'required',
            'dok_link' => 'required',
        ]);

        LaporanHasil::create([
            'judul_pkm' => $this->judul_pkm,
            'id_proposal' => $this->id_proposal,
            'id_bidang' => $this->id_bidang,
            'id_skim' => $this->id_skim,
            'lok_kegiatan' => $this->lok_kegiatan,
            'thn_usulan' => $this->thn_usulan,
            'thn_kegiatan' => $this->thn_kegiatan,
            'thn_pelaksanaan' => $this->thn_pelaksanaan,
            'dana_dikti' => $this->dana_dikti,
            'dana_unla' => $this->dana_unla,
            'dana_lainnya' => $this->dana_lainnya,
            'nosk_pkm' => $this->nosk_pkm,
            'tglsk_pkm' => $this->tglsk_pkm,
            'mitra_pkm' => $this->mitra_pkm,
            'dok_link' => $this->dok_link
        ]);
        $this->dispatchBrowserEvent('closeModal');
        session()->flash('success', 'Berhasil Menambahkan Data Laporan!');
        $this->ClearForm();
    }

    public function ClearForm()
    {
        $this->judul_pkm = Null;
        $this->id_proposal = Null;
        $this->id_bidang = Null;
        $this->id_skim = Null;
        $this->lok_kegiatan = Null;
        $this->thn_usulan = Null;
        $this->thn_kegiatan = Null;
        $this->thn_pelaksanaan = Null;
        $this->dana_unla = Null;
        $this->dana_dikti = Null;
        $this->dana_lainnya = Null;
        $this->nosk_pkm = Null;
        $this->tglsk_pkm = Null;
        $this->mitra_pkm = Null;
        $this->dok_link = Null;
        $this->type = Null;
    }

    public function edit($id)
    {
        $lap = LaporanHasil::where('id_laphasil', $id)->first();
        $proposal = Proposals::where('id_proposal', $lap->id_proposal)->first();
        $this->ids = $lap->id_laphasil;
        $this->type = $proposal->judul_proposal;
        $this->judul_pkm = $lap->judul_pkm;
        $this->id_bidang = $lap->id_bidang;
        $this->id_skim = $lap->id_skim;
        $this->lok_kegiatan = $lap->lok_kegiatan;
        $this->thn_usulan = $lap->thn_usulan;
        $this->thn_kegiatan = $lap->thn_kegiatan;
        $this->thn_pelaksanaan = $lap->thn_pelaksanaan;
        $this->dana_dikti = $lap->dana_dikti;
        $this->dana_unla = $lap->dana_unla;
        $this->dana_lainnya = $lap->dana_lainnya;
        $this->nosk_pkm = $lap->nosk_pkm;
        $this->tglsk_pkm = $lap->tglsk_pkm;
        $this->mitra_pkm = $lap->mitra_pkm;
        $this->dok_link = $lap->dok_link;
    }

    public function update()
    {
        
        $this->validate([
            // 'judul_proposal' => 'required|string|min:10|unique:proposals',
            'id_bidang' => 'required',
            'id_skim' => 'required',
            'lok_kegiatan' => 'required|string|min:4',
            'thn_usulan' => 'required|numeric',
            'thn_kegiatan' => 'required|numeric',
            'thn_pelaksanaan' => 'required|numeric',
            'nosk_pkm' => 'required',
            'tglsk_pkm' => 'required|date',
            'mitra_pkm' => 'required',
            'dok_link' => 'required',
        ]);

        $laporanhasil = LaporanHasil::where('id_laphasil', $this->ids)->first();
        if($this->judul_pkm != $laporanhasil->judul_pkm){
            $this->validate(['judul_pkm' => 'required|string|min:10|unique:laporan_hasils']);
        }

        $data = [
            'judul_pkm' => $this->judul_pkm,
            'id_bidang' => $this->id_bidang,
            'id_skim' => $this->id_skim,
            'lok_kegiatan' => $this->lok_kegiatan,
            'thn_usulan' => $this->thn_usulan,
            'thn_kegiatan' => $this->thn_kegiatan,
            'thn_pelaksanaan' => $this->thn_pelaksanaan,
            'dana_dikti' => $this->dana_dikti,
            'dana_unla' => $this->dana_unla,
            'dana_lainnya' => $this->dana_lainnya,
            'nosk_pkm' => $this->nosk_pkm,
            'tglsk_pkm' => $this->tglsk_pkm,
            'mitra_pkm' => $this->mitra_pkm,
            'dok_link' => $this->dok_link
        ];
        $get = LaporanHasil::where('id_laphasil',$this->ids)->update($data);
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
