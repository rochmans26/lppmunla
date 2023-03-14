<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\AnggotaDosenLuar;

class ProposalAnggotadosluar extends Component
{
    public $params;
    public $id_param;
    public $ids, $nidn, $nm_dosen, $telp, $email, $fakultas, $prodi, $universitas, $peran;
    
    public function mount($params)
    {
        $this->id_param = $params;
    }

    public function render()
    {
        return view('livewire.proposal-anggotadosluar', [
            'anggota' => AnggotaDosenLuar::orderBy('id', 'desc')->where('id_proposal', $this->id_param)->get()
        ]);
    }

    public function create()
    {
        $this->validate([
            'nidn' => 'required|numeric|min:4|unique:anggota_dosen_luars',
            'nm_dosen' => 'required|string|max:255',
            'telp' => 'required',
            'email' => 'required|email|unique:anggota_dosen_luars',
            'fakultas' => 'required|string',
            'prodi' => 'required|string',
            'universitas' => 'required|string',
            'peran' => 'required|string'
        ]);

        AnggotaDosenLuar::create([
            'nidn' => $this->nidn,
            'nm_dosen' => $this->nm_dosen,
            'telp' => $this->telp,
            'email' => $this->email,
            'fakultas' => $this->fakultas,
            'prodi' => $this->prodi,
            'universitas' => $this->universitas,
            'id_proposal' => $this->id_param,
            'peran' => $this->peran
        ]);

        $this->dispatchBrowserEvent('closeModal');
        $this->ClearForm();
    }

    public function ClearForm()
    {
        $this->nidn = "";
        $this->nm_dosen = "";
        $this->telp = "";
        $this->email = "";
        $this->fakultas = "";
        $this->prodi = "";
        $this->universitas = "";
        $this->peran = "";
    }
    
    public function detail($id)
    {
        $anggota = AnggotaDosenLuar::where('id', $id)->first();
        $this->nidn = $anggota->nidn;
        $this->nm_dosen = $anggota->nm_dosen;
        $this->telp = $anggota->telp;
        $this->email = $anggota->email;
        $this->fakultas = $anggota->fakultas;
        $this->prodi = $anggota->prodi;
        $this->universitas = $anggota->universitas;
        $this->peran = $anggota->peran;
        $this->ids = $anggota->id;
    }

    public function update()
    {
        $this->validate([
            // 'nidn' => 'required|numeric|min:4|unique:anggota_dosen_luars',
            'nm_dosen' => 'required|string|max:255',
            'telp' => 'required',
            // 'email' => 'required|email|unique:anggota_dosen_luars',
            'fakultas' => 'required|string',
            'prodi' => 'required|string',
            'universitas' => 'required|string',
            'peran' => 'required|string'
        ]);

        $anggota = AnggotaDosenLuar::where('id', $this->ids)->first();
        if($this->nidn != $anggota->nidn){
            $this->validate(['nidn' => 'required|numeric|min:4|unique:anggota_dosen_luars']);
        }
        if($this->email != $anggota->email){
            $this->validate(['email' => 'required|email|unique:anggota_dosen_luars']);
        }

        $data = [
            'nidn' => $this->nidn,
            'nm_dosen' => $this->nm_dosen,
            'telp' => $this->telp,
            'email' => $this->email,
            'fakultas' => $this->fakultas,
            'prodi' => $this->prodi,
            'universitas' => $this->universitas,
            'peran' => $this->peran
        ];
        $get = AnggotaDosenLuar::where('id',$this->ids)->update($data);
        $this->dispatchBrowserEvent('closeModal');
        $this->ClearForm();
    }

    public function confirm($id)
    {
        $anggota = AnggotaDosenLuar::where('id', $id)->first();
        $this->ids = $anggota->id;
    }

    public function delete()
    {
        $del = AnggotaDosenLuar::where('id', $this->ids)->delete();
        $this->dispatchBrowserEvent('closeModal');
        $this->ClearForm();
    }
}
