<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\LaporanHasil;
use App\Models\SeminarHasil;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class CreateSeminarHasil extends Component
{
    use WithPagination;
    public $ids, $tgl_semhas, $jam_semhas, $sifat_semhas, $tmpt_semhas, $tautan_semhas, $rev1_semhas, $rev2_semhas, $id_laphasil;
    public $search="";
    public $result=3;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        return view('livewire.create-seminar-hasil', [
            'laporanhasils' => DB::table('laporan_hasils')
            ->leftJoin('bidangs', 'bidangs.id_bidang', 'laporan_hasils.id_bidang')
            ->leftJoin('skims', 'skims.id_skim', 'laporan_hasils.id_skim')
            // ->leftJoin('seminar_proposals', 'seminar_proposals.id_sempro', 'proposals.id_sempro')
            ->orderBy('id_laphasil','desc')
            ->where('judul_pkm', 'like', '%'.$this->search.'%')
            ->orWhere('thn_usulan', 'like', '%'.$this->search.'%')
            ->orWhere('thn_kegiatan', 'like', '%'.$this->search.'%')
            ->orWhere('thn_pelaksanaan', 'like', '%'.$this->search.'%')
            ->orWhere('nm_bidang', 'like', '%'.$this->search.'%')
            ->orWhere('nm_skim', 'like', '%'.$this->search.'%')
            ->paginate($this->result),
            'count' => count(LaporanHasil::all()),
        ]);
    }
    
    public function klik($id){
        $this->id_laphasil = $id;
        $semhas = SeminarHasil::where('id_laphasil', $this->id_laphasil)->first();
        if($semhas != Null){
            $this->ids = $semhas->id_semhas;
            $this->id_laphasil = $semhas->id_laphasil;
            $this->tgl_semhas = $semhas->tgl_semhas;
            $this->jam_semhas = $semhas->jam_semhas;
            $this->sifat_semhas = $semhas->sifat_semhas;
            $this->tmpt_semhas = $semhas->tmpt_semhas;
            $this->tautan_semhas = $semhas->tautan_semhas;
            $this->rev1_semhas = $semhas->rev1_semhas;
            $this->rev2_semhas = $semhas->rev2_semhas;
        }else{
            $this->ClearForm();
        }
    }

    public function atur(){
        $semhas = SeminarHasil::where('id_laphasil', $this->id_laphasil)->first();
        if($semhas == Null){
            $this->create();
        } else {
            $this->update();
        }
    }
    
    public function create()
    {
        $this->validate([
            'tgl_semhas' => 'required',
            'jam_semhas' => 'required',
            'sifat_semhas' => 'required',
            // 'tmpt_seminar' => 'required|string|min:4',
            // 'tautan' => 'required|url|',
            'rev1_semhas' => 'required|string',
            'rev2_semhas' => 'required|string'
        ]);
        
        if($this->sifat_semhas == 'Luring'){
            $this->validate(['tmpt_semhas' => 'required|string|min:4']);
        }

        if($this->sifat_semhas == 'Daring'){
            $this->validate(['tautan_semhas' => 'required|url']);
        }

        SeminarHasil::create([
            'id_laphasil' => $this->id_laphasil,
            'tgl_semhas' => $this->tgl_semhas,
            'jam_semhas' => $this->jam_semhas,
            'sifat_semhas' => $this->sifat_semhas,
            'tmpt_semhas' => $this->tmpt_semhas,
            'tautan_semhas' => $this->tautan_semhas,
            'rev1_semhas' => $this->rev1_semhas,
            'rev2_semhas' => $this->rev2_semhas
        ]);
        $this->dispatchBrowserEvent('closeModal');
        session()->flash('success', 'Seminar Proposal Berhasil Diatur!');
        $param = SeminarHasil::where('id_laphasil', $this->id_laphasil)->first();
        LaporanHasil::where('id_laphasil', $this->id_laphasil)->update(['id_semhas' => $param->id_semhas]);
        $this->ClearForm();
        $this->emit('semhasstore');
    }

    public function ClearForm()
    {
        $this->tgl_semhas = Null;
        $this->jam_semhas = Null;
        $this->sifat_semhas = Null;
        $this->tmpt_semhas = Null;
        $this->tautan_semhas = Null;
        $this->rev1_semhas = Null;
        $this->rev2_semhas = Null;
    }

    public function update()
    {
        $this->validate([
            'tgl_semhas' => 'required',
            'jam_semhas' => 'required',
            'sifat_semhas' => 'required',
            // 'tmpt_seminar' => 'required|string|min:4',
            // 'tautan' => 'required|url|',
            'rev1_semhas' => 'required|string',
            'rev2_semhas' => 'required|string'
        ]);
        
        if($this->sifat_semhas == 'Luring'){
            $this->validate(['tmpt_semhas' => 'required|string|min:4']);
        }

        if($this->sifat_semhas == 'Daring'){
            $this->validate(['tautan_semhas' => 'required|url']);
        }

        $data = [
            'tgl_semhas' => $this->tgl_semhas,
            'jam_semhas' => $this->jam_semhas,
            'sifat_semhas' => $this->sifat_semhas,
            'tmpt_semhas' => $this->tmpt_semhas,
            'tautan_semhas' => $this->tautan_semhas,
            'rev1_semhas' => $this->rev1_semhas,
            'rev2_semhas' => $this->rev2_semhas
        ];

        $get = SeminarHasil::where('id',$this->ids)->update($data);
        $this->dispatchBrowserEvent('closeModal');
        session()->flash('success', 'Pengaturan Diubah!');
    }

    public function confirm($id)
    {
        $semhas = SeminarHasil::where('id_laphasil', $id)->first();
        $this->ids = $semhas->id_semhas;
        $this->id_laphasil = $semhas->id_laphasil;
    }

    public function delete()
    {
        $del = SeminarHasil::where('id_semhas', $this->ids)->delete();
        LaporanHasil::where('id_laphasil', $this->id_laphasil)->update(['id_semhas' => Null]);
        session()->flash('success', 'Berhasil Membatalkan Seminar');
        $this->dispatchBrowserEvent('closeModal');
        $this->ClearForm();
        $this->emit('delSemhas');
    }
}
