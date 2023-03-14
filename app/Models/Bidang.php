<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bidang extends Model
{
    use HasFactory;
    protected $guarded = ['id_bidang'];

    public function proposal()
    {
        return $this->hasMany(Proposals::class, 'foreign_key', 'id_bidang');
    }
}
