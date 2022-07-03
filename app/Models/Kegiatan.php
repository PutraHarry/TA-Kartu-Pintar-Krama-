<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kegiatan extends Model
{
    use SoftDeletes;
    protected $table = 'tb_m_kegiatan';

    public function presensi()
    {
        return $this->hasMany(Presensi::class, 'id', 'kegiatan_id');
    }

}
