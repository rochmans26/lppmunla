<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\SeminarHasil;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class SeminarHasilTable extends Component
{
    public $ids, $nrev1_semhas, $nrev2_semhas, $dok_rev_semhas;

    public $search="";
    public $result=3;

    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    protected $listeners = [
        'semhasstore' => 'render',
        'delSemhas' => 'render'
    ];
    public function render()
    {
        return view('livewire.seminar-hasil-table', [
            'semhass' => DB::table('seminar_hasils')
            ->leftJoin('laporan_hasils', 'laporan_hasils.id_laphasil', 'seminar_hasils.id_laphasil')
            ->where('judul_pkm', 'like', '%'.$this->search.'%')
            ->paginate($this->result)
        ]);
    }

    public function update($id)
    {
        $temp = DB::table('seminar_hasils')->where('id_semhas', $id)->first();
        $this->ids = $temp->id_semhas;
        $this->nrev1_semhas = $temp->nrev1_semhas;
        $this->nrev2_semhas = $temp->nrev2_semhas;
        $this->dok_rev_semhas = $temp->dok_rev_semhas;
    }

    public function ClearForm()
    {
        $this->ids = Null;
        $this->nrev1_semhas = Null;
        $this->nrev2_semhas = Null;
        $this->dok_rev_semhas = Null;
    }

    public function add_notes()
    {
        $temp = DB::table('seminar_hasils')->where('id_semhas', $this->ids)->first();
        SeminarHasil::where('id_semhas', $this->ids)->update([
            'nrev1_semhas' => $this->nrev1_semhas,
            'nrev2_semhas' => $this->nrev2_semhas,
        ]);
        session()->flash('success', 'Catatan Berhasil Diubah!');
        $this->dispatchBrowserEvent('closeModal');
        $this->ClearForm();
    }

    public function dokrev()
    {
        $temp = DB::table('seminar_hasils')->where('id_semhas', $this->ids)->first();

        $this->validate([
            'dok_rev_semhas' => 'url'
        ]);
        SeminarHasil::where('id_semhas', $this->ids)->update([
            'dok_rev_semhas' => $this->dok_rev_semhas,
        ]);
        session()->flash('success', 'Dokumen Revisi Telah Ditambahkan!');
        $this->dispatchBrowserEvent('closeModal');
        $this->ClearForm();
    }
}
