<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Proposals;
use Livewire\WithPagination;
use App\Models\SeminarProposals;
use Illuminate\Support\Facades\DB;

class CreateSeminarProposal extends Component
{
    use WithPagination;
    public $ids, $tgl_seminar, $jam_seminar, $sifat_seminar, $tmpt_seminar, $tautan, $reviewer1, $reviewer2, $id_proposal;
    public $search="";
    public $result=3;
    protected $paginationTheme = 'bootstrap';
    
    public function render()
    {
        return view('livewire.create-seminar-proposal', [
            'proposals' => DB::table('proposals')
            ->leftJoin('bidangs', 'bidangs.id_bidang', 'proposals.id_bidang')
            ->leftJoin('skims', 'skims.id_skim', 'proposals.id_skim')
            // ->leftJoin('seminar_proposals', 'seminar_proposals.id_sempro', 'proposals.id_sempro')
            ->orderBy('id_proposal','desc')
            ->where('judul_proposal', 'like', '%'.$this->search.'%')
            ->orWhere('thn_usulan', 'like', '%'.$this->search.'%')
            ->orWhere('thn_kegiatan', 'like', '%'.$this->search.'%')
            ->orWhere('thn_pelaksanaan', 'like', '%'.$this->search.'%')
            ->orWhere('nm_bidang', 'like', '%'.$this->search.'%')
            ->orWhere('nm_skim', 'like', '%'.$this->search.'%')
            ->orWhere('thn_pelaksanaan', 'like', '%'.$this->search.'%')
            ->paginate($this->result),
            'count' => count(Proposals::all()),
            'sempro' => SeminarProposals::all()
        ]);
    }

    public function klik($id){
        $this->id_proposal = $id;
        $sempro = SeminarProposals::where('id_proposal', $this->id_proposal)->first();
        if($sempro != Null){
            $this->ids = $sempro->id;
            $this->id_proposal = $sempro->id_proposal;
            $this->tgl_seminar = $sempro->tgl_seminar;
            $this->jam_seminar = $sempro->jam_seminar;
            $this->sifat_seminar = $sempro->sifat_seminar;
            $this->tmpt_seminar = $sempro->tmpt_seminar;
            $this->tautan = $sempro->tautan;
            $this->reviewer1 = $sempro->reviewer1;
            $this->reviewer2 = $sempro->reviewer2;
        }else{
            $this->ClearForm();
        }
    }

    public function atur(){
        $sempro = SeminarProposals::where('id_proposal', $this->id_proposal)->first();
        if($sempro == Null){
            $this->create();
        } else {
            $this->update();
        }
    }
    
    public function create()
    {
        $this->validate([
            'tgl_seminar' => 'required',
            'jam_seminar' => 'required',
            'sifat_seminar' => 'required',
            // 'tmpt_seminar' => 'required|string|min:4',
            // 'tautan' => 'required|url|',
            'reviewer1' => 'required|string',
            'reviewer2' => 'required|string'
        ]);
        
        if($this->sifat_seminar == 'Luring'){
            $this->validate(['tmpt_seminar' => 'required|string|min:4']);
        }

        if($this->sifat_seminar == 'Daring'){
            $this->validate(['tautan' => 'required|url']);
        }

        SeminarProposals::create([
            'id_proposal' => $this->id_proposal,
            'tgl_seminar' => $this->tgl_seminar,
            'jam_seminar' => $this->jam_seminar,
            'sifat_seminar' => $this->sifat_seminar,
            'tmpt_seminar' => $this->tmpt_seminar,
            'tautan' => $this->tautan,
            'reviewer1' => $this->reviewer1,
            'reviewer2' => $this->reviewer2
        ]);
        $this->dispatchBrowserEvent('closeModal');
        session()->flash('success', 'Seminar Proposal Berhasil Diatur!');
        $param = SeminarProposals::where('id_proposal', $this->id_proposal)->first();
        Proposals::where('id_proposal', $this->id_proposal)->update(['id_sempro' => $param->id_sempro]);
        $this->ClearForm();
        $this->emit('semprostore');
    }

    public function ClearForm()
    {
        $this->tgl_seminar = Null;
        $this->jam_seminar = Null;
        $this->sifat_seminar = Null;
        $this->tmpt_seminar = Null;
        $this->tautan = Null;
        $this->reviewer1 = Null;
        $this->reviewer2 = Null;
    }

    public function update()
    {
        $this->validate([
            'tgl_seminar' => 'required',
            'jam_seminar' => 'required',
            'sifat_seminar' => 'required',
            // 'tmpt_seminar' => 'required|string|min:4',
            // 'tautan' => 'required|url|',
            'reviewer1' => 'required|string',
            'reviewer2' => 'required|string'
        ]);
        
        if($this->sifat_seminar == 'Luring'){
            $this->validate(['tmpt_seminar' => 'required|string|min:4']);
        }

        if($this->sifat_seminar == 'Daring'){
            $this->validate(['tautan' => 'required|url']);
        }

        $data = [
            'tgl_seminar' => $this->tgl_seminar,
            'jam_seminar' => $this->jam_seminar,
            'sifat_seminar' => $this->sifat_seminar,
            'tmpt_seminar' => $this->tmpt_seminar,
            'tautan' => $this->tautan,
            'reviewer1' => $this->reviewer1,
            'reviewer2' => $this->reviewer2
        ];

        $get = SeminarProposals::where('id',$this->ids)->update($data);
        $this->dispatchBrowserEvent('closeModal');
        session()->flash('success', 'Pengaturan Diubah!');
    }

    public function confirm($id)
    {
        $sempro = SeminarProposals::where('id_proposal', $id)->first();
        $this->ids = $sempro->id_sempro;
        $this->id_proposal = $sempro->id_proposal;
    }

    public function delete()
    {
        $del = SeminarProposals::where('id_sempro', $this->ids)->delete();
        Proposals::where('id_proposal', $this->id_proposal)->update(['id_sempro' => Null]);
        session()->flash('success', 'Berhasil Membatalkan Seminar');
        $this->dispatchBrowserEvent('closeModal');
        $this->ClearForm();
        $this->emit('delSempro');
    }
}
