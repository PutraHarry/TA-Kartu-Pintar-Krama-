<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PresensiDetail extends Model
{
    use SoftDeletes;
    protected $table = 'tb_detail_presensi';

    public function presensi()
    {
        return $this->belongsTo(Presensi::class, 'id', 'presensi_id')->withTrashed();
    }

    public function cacah_krama_mipil()
    {
        return $this->hasOne(CacahKramaMipil::class, 'id', 'presensi_id')->withTrashed();
    }
}
