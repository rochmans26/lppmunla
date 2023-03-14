<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeminarProposals extends Model
{
    use HasFactory;
    protected $guarded = ['id_sempro'];

    public function proposal()
    {
        return $this->hasOne(Proposals::class, 'id_proposal');
    }
}
