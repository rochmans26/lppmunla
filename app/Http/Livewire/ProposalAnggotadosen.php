<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\AnggotaDosenLokal;
use App\Models\Dosens;

class ProposalAnggotadosen extends Component
{
    public $params;
    public $id_param;
    public $ids, $id_dosen, $peran;

    public $showresult = false;
    public $search = "";
    public $records;
    // public $empDetails;

    // Fetch records
    public function searchResult()
    {
        if(!empty($this->search)){
            $this->records = Dosens::orderby('id','asc')
                      ->select('*')
                      ->where('nm_dosen','like','%'.$this->search.'%')
                      ->orWhere('nidn','like','%'.$this->search.'%')
                      ->limit(5)
                      ->get();
            $this->showresult = true;
        }else{
            $this->showresult = false;
        }
    }

    // Fetch record by ID
    public function fetchDosenDetail($id){

        $record = Dosens::select('*')
                    ->where('id',$id)
                    ->first();

        $this->search = $record->nm_dosen;
        // $this->empDetails = $record;
        $this->id_dosen = $record->id;
        $this->showresult = false;
    }

    public function mount($params)
    {
        $this->id_param = $params;
    }

    public function render()
    {
        return view('livewire.proposal-anggotadosen',[
            'anggota' => AnggotaDosenLokal::orderBy('id', 'desc')->where('id_proposal', $this->id_param)->get()
        ]);
    }

    public function create()
    {
        $this->validate([
            'id_dosen' => 'required|unique:anggota_dosen_lokals',
            'peran' => 'required|string'
        ]);

        AnggotaDosenLokal::create([
            'id_dosen' => $this->id_dosen,
            'id_proposal' => $this->id_param,
            'peran' => $this->peran
        ]);

        $this->dispatchBrowserEvent('closeModal');
        $this->ClearForm();
    }

    public function ClearForm()
    {
        $this->search = "";
        $this->showresult = false;
        $this->records = Null;
        $this->peran = "";
    }

    public function detail($id)
    {
        $anggota = AnggotaDosenLokal::where('id', $id)->first();
        $dosen = Dosens::where('id', $anggota->id_dosen)->first();
        $this->search = $dosen->nm_dosen;
        $this->id_dosen = $anggota->dosen;
        $this->ids = $anggota->id;
        $this->peran = $anggota->peran;
    }

    public function update()
    {
        $this->validate([
            'peran' => 'required|string'
        ]);

        $anggota = AnggotaDosenLokal::where('id', $this->ids)->first();
        $dosen = Dosens::where('id', $anggota->id_dosen)->first();
        if($this->id_dosen != $anggota->id_dosen || $this->search != $dosen->nm_dosen){
            $this->validate(['id_dosen' => 'required|unique:anggota_dosen_lokals']);
        }

        $data = [
            'id_dosen' => $this->id_dosen,
            'peran' => $this->peran
        ];
        $get = AnggotaDosenLokal::where('id',$this->ids)->update($data);
        $this->dispatchBrowserEvent('closeModal');
        $this->ClearForm();
    }

    public function confirm($id)
    {
        $anggota = AnggotaDosenLokal::where('id', $id)->first();
        $this->ids = $anggota->id;
    }

    public function delete()
    {
        $del = AnggotaDosenLokal::where('id', $this->ids)->delete();
        $this->dispatchBrowserEvent('closeModal');
        $this->ClearForm();
    }
}
