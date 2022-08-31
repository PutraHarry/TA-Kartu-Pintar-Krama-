<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Presensi extends Model
{
    use SoftDeletes;
    protected $table = 'tb_presensi';


    public function presensi_detail()
    {
        return $this->hasMany(PresensiDetail::class, 'presensi_id', 'id');
    }

    public function presensi_krama_detail()
    {
        return $this->hasOne(PresensiDetail::class, 'presensi_id', 'id');
    }

    public function kegiatan()
    {
        return $this->hasOne(Kegiatan::class, 'id', 'kegiatan_id');
    }
}
