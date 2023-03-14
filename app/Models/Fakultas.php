<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fakultas extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function prodis()
    {
        return $this->hasMany(Prodi::class);
    }
}
