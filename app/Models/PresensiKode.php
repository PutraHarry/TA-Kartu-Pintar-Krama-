<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PresensiKode extends Model
{
    use SoftDeletes;
    protected $table = 'tb_m_presensi_kode';
}
