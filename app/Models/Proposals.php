<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proposals extends Model
{
    use HasFactory;
    protected $guarded = ['id_proposal'];

    public function skim()
    {
        return $this->belongsTo(Skim::class, 'id_skim');
    }

    public function bidang()
    {
        return $this->belongsTo(Bidang::class);
    }

    public function seminarproposal()
    {
        return $this->belongsTo(SeminarProposals::class, 'id_proposal');
    }
    
}
