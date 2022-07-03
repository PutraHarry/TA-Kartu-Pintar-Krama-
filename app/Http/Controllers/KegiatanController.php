<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kegiatan;

class KegiatanController extends Controller
{
    public function get()
    {
        $kegiatan = Kegiatan::get();

        if ($kegiatan) {
            return response()->json([
                'statusCode' => 200,
                'status' => true,
                'data' => $kegiatan,
                'message' => 'data kegiatan sukses'
            ], 200);
        } else {
            return response()->json([
                'statusCode' => 500,
                'status' => false,
                'data' => null,
                'message' => 'data kegiatan gagal'
            ], 500);
        }
    }

    public function detail(Request $req)
    {
        $kegiatan = Kegiatan::where('id', $req->query('kegiatan'))->first();

        if ($kegiatan) {
            return response()->json([
                'statusCode' => 200,
                'status' => true,
                'data' => $kegiatan,
                'message' => 'data kegiatan sukses'
            ], 200);
        } else {
            return response()->json([
                'statusCode' => 500,
                'status' => false,
                'data' => null,
                'message' => 'data kegiatan gagal'
            ], 500);
        }
    }

    public function create(Request $req)
    {
        $kegiatan = new Kegiatan();
        $kegiatan->nama_kegiatan = $req->nama_kegiatan;
        $kegiatan->keterangan = $req->keterangan;
        $kegiatan->save();

        if ($kegiatan) {
            return response()->json([
                'statusCode' => 200,
                'status' => true,
                'data' => $kegiatan,
                'message' => 'data kegiatan sukses'
            ], 200);
        } else {
            return response()->json([
                'statusCode' => 500,
                'status' => false,
                'data' => null,
                'message' => 'data kegiatan gagal'
            ], 500);
        }
    }

    public function edit(Request $req)
    {
        $kegiatan = Kegiatan::where('id', $req->id_kegiatan)->first();
        error_log($kegiatan);
        $kegiatan->nama_kegiatan = $req->nama_kegiatan;
        $kegiatan->keterangan = $req->keterangan;
        $kegiatan->save();

        if ($kegiatan) {
            return response()->json([
                'statusCode' => 200,
                'status' => true,
                'data' => $kegiatan,
                'message' => 'data kegiatan sukses'
            ], 200);
        } else {
            return response()->json([
                'statusCode' => 500,
                'status' => false,
                'data' => null,
                'message' => 'data kegiatan gagal'
            ], 500);
        }
    }
}
