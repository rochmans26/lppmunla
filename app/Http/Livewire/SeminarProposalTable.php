<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\SeminarProposals;
use Illuminate\Support\Facades\DB;

class SeminarProposalTable extends Component
{
    public $ids, $note_rev1, $note_rev2, $dok_rev;

    public $search="";
    public $result=3;

    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    protected $listeners = [
        'semprostore' => 'render',
        'delSempro' => 'render'
    ];

    public function render()
    {
        return view('livewire.seminar-proposal-table',[
            'sempros' => DB::table('seminar_proposals')
            ->leftJoin('proposals', 'proposals.id_proposal', 'seminar_proposals.id_proposal')
            ->where('judul_proposal', 'like', '%'.$this->search.'%')
            ->paginate($this->result)
        ]);
    }

    public function update($id)
    {
        $temp = DB::table('seminar_proposals')->where('id_sempro', $id)->first();
        $this->ids = $temp->id_sempro;
        $this->note_rev1 = $temp->note_rev1;
        $this->note_rev2 = $temp->note_rev2;
        $this->dok_rev = $temp->dok_rev;
    }

    public function ClearForm()
    {
        $this->ids = Null;
        $this->note_rev1 = Null;
        $this->note_rev2 = Null;
        $this->dok_rev = Null;
    }

    public function add_notes()
    {
        $temp = DB::table('seminar_proposals')->where('id_sempro', $this->ids)->first();
        SeminarProposals::where('id_sempro', $this->ids)->update([
            'note_rev1' => $this->note_rev1,
            'note_rev2' => $this->note_rev2,
        ]);
        session()->flash('success', 'Catatan Berhasil Diubah!');
        $this->dispatchBrowserEvent('closeModal');
        $this->ClearForm();
    }

    public function dokrev()
    {
        $temp = DB::table('seminar_proposals')->where('id_sempro', $this->ids)->first();

        $this->validate([
            'dok_rev' => 'url'
        ]);
        SeminarProposals::where('id_sempro', $this->ids)->update([
            'dok_rev' => $this->dok_rev,
        ]);
        session()->flash('success', 'Dokumen Revisi Telah Ditambahkan!');
        $this->dispatchBrowserEvent('closeModal');
        $this->ClearForm();
    }
}
