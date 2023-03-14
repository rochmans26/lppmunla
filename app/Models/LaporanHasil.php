<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanHasil extends Model
{
    use HasFactory;
    protected $guarded = ['id_laphasil'];
}
