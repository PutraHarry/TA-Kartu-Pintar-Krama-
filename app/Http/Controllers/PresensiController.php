<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Presensi;
use App\Models\PresensiDetail;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\Eloquent\Builder;

class PresensiController extends Controller
{
    public function get()
    {
        $presensi = Presensi::with('presensi_detail', 'kegiatan')->get();
        if ($presensi) {
            return response()->json([
                'statusCode' => 200,
                'status' => true,
                'data' => $presensi,
                'message' => 'data presensi sukses'
            ], 200);
        } else {
            return response()->json([
                'statusCode' => 500,
                'status' => false,
                'data' => null,
                'message' => 'data presensi gagal'
            ], 500);
        }
    }

    public function getOpen()
    {
        //tambahin id banjar nya??
        $presensi = Presensi::where('is_open', 1)->get();

        if ($presensi) {
            return response()->json([
                'statusCode' => 200,
                'status' => true,
                'data' => $presensi,
                'message' => 'data presensi sukses'
            ], 200);
        } else {
            return response()->json([
                'statusCode' => 500,
                'status' => false,
                'data' => null,
                'message' => 'data presensi tidak ada'
            ], 200);
        }
    }

    public function detail(Request $req)
    {
        $presensi = Presensi::with('presensi_detail', 'kegiatan')->where('id', $req->presensi)->first();
        if ($presensi) {
            // tambahin untuk cek detail presensinya
            $response = Http::acceptJson()->withToken($req->token)->post("https://sikramat.ngaeapp.com/api/integrasi/return-cacah-krama-mipil", [
                "data" => json_encode($presensi->presensi_detail)
            ]);
            if ($response->successful()) {
                $responseBody = json_decode($response->body());
                // $presensi->presensi_detail = $responseBody->data;
                // dd($presensi);
                if ($responseBody->message == "data cacah krama mipil sukses") {
                    return response()->json([
                        'statusCode' => 200,
                        'status' => true,
                        'presensi' => $presensi,
                        'presensi_detail' => $responseBody->data,
                        'message' => 'data presensi sukses'
                    ], 200);
                } else {
                    return response()->json([
                        'statusCode' => 200,
                        'status' => true,
                        'presensi' => $presensi,
                        'presensi_detail' => null,
                        'message' => 'gagal memuat detail presensi'
                    ], 200);
                }
            } else {
                return response()->json([
                    'statusCode' => 200,
                    'status' => true,
                    'presensi' => $presensi,
                    'presensi_detail' => null,
                    'message' => 'gagal memuat detail presensi'
                ], 200);
            }
        } else {
            return response()->json([
                'statusCode' => 500,
                'status' => false,
                'presensi' => null,
                'presensi_detail' => null,
                'message' => 'data presensi gagal'
            ], 500);
        }
    }


    public function create(Request $req)
    {
        $presensi = new Presensi();
        $presensi->nama_presensi = $req->nama_presensi;
        $presensi->kegiatan_id = $req->kegiatan;
        $presensi->keterangan = $req->keterangan;
        $presensi->tgl_open = $req->tgl_open;
        $presensi->tgl_close = $req->tgl_close;
        $presensi->kode_presensi = $req->kode_presensi;
        $presensi->save();

        if ($presensi) {
            $cacahKramaList = json_decode($req->cacah_krama_mipil_list);
            foreach($cacahKramaList as $cacahKrama) {
                $detailPresensi = new PresensiDetail();
                $detailPresensi->nomor_cacah_krama_mipil = $cacahKrama->nomor_cacah_krama_mipil;
                $detailPresensi->presensi_id = $presensi->id;
                $detailPresensi->save();
            }
            return response()->json([
                'statusCode' => 200,
                'status' => true,
                'data' => $presensi,
                'message' => 'data presensi sukses'
            ], 200);
        } else {
            return response()->json([
                'statusCode' => 500,
                'status' => false,
                'data' => null,
                'message' => 'data presensi gagal'
            ], 500);
        }
    }

    public function fillPresensi(Request $req)
    {
        $presensis = Presensi::with('presensi_detail')->where('is_open', 1)->get();

        $fillPresensi = false;

        if ($presensis->isNotEmpty()) {
            foreach ($presensis as $presensi ) {
                foreach($presensi->presensi_detail as $presensiDetail) {
                    if ($presensiDetail->nomor_cacah_krama_mipil == $req->nomor_cacah_krama_mipil) {

                        $detailPresensi = PresensiDetail::where('presensi_id', $presensi->id)
                                                    ->where('nomor_cacah_krama_mipil', $req->nomor_cacah_krama_mipil)
                                                    ->first();
                        error_log($detailPresensi);
                        if ($detailPresensi) {
                            if ($detailPresensi->is_hadir == 1) {
                                return response()->json([
                                    'statusCode' => 200,
                                    'status' => true,
                                    'data' => null,
                                    'message' => 'presensi telah diisi'
                                ], 200);
                            }
                           
                            $detailPresensi->is_hadir = 1;
                            $detailPresensi->uid_kartu = "test12345";
                            $detailPresensi->update();
                            $fillPresensi = true;
                            error_log($detailPresensi);
                            return response()->json([
                                'statusCode' => 200,
                                'status' => true,
                                'data' => $detailPresensi,
                                'message' => 'data presensi sukses'
                            ], 200);
                        }
                    } else {
                        $fillPresensi = false;
                    }
                }
            }
            
            if ($fillPresensi == false) {
                return response()->json([
                    'statusCode' => 500,
                    'status' => false,
                    'data' => null,
                    'message' => 'tidak terdaftar'
                ], 500);
            }

        } else {
            return response()->json([
                'statusCode' => 500,
                'status' => false,
                'data' => null,
                'message' => 'no presensi open'
            ], 500);
        }
    }

    public function openClosePresensi(Request $req)
    {
        $presensi = Presensi::where('id', $req->query('presensi'))->first();
        if ($presensi->is_open == 0) {
            $presensi->is_open = 1;
        } else {
            $presensi->is_open = 0;
        }
        $presensi->save();

        if ($presensi) {
            return response()->json([
                'statusCode' => 200,
                'status' => true,
                'data' => $presensi,
                'message' => 'data presensi sukses'
            ], 200);
        } else {
            return response()->json([
                'statusCode' => 500,
                'status' => false,
                'data' => null,
                'message' => 'data presensi gagal'
            ], 500);
        }
    }

    public function getOpenKrama(Request $req)
    {
        $presensi = Presensi::with('kegiatan')
                                ->with(['presensi_krama_detail' =>function($q) use ($req){
                                    $q->where('nomor_cacah_krama_mipil', $req->query('nic'));
                                }])
                                ->whereHas('presensi_krama_detail', function($q) use($req) {
                                    $q->where('nomor_cacah_krama_mipil', $req->query('nic'));
                                })->where('is_open',1)->get();

        if ($presensi) {
            return response()->json([
                'statusCode' => 200,
                'status' => true,
                'data' => $presensi,
                'message' => 'data presensi sukses'
            ], 200);
        } else {
            return response()->json([
                'statusCode' => 500,
                'status' => false,
                'data' => null,
                'message' => 'data presensi tidak ada'
            ], 200);
        }
    }

    public function getFilledPresensi(Request $req)
    {
        $presensi = Presensi::with('kegiatan')
                                ->with(['presensi_krama_detail' =>function($q) use ($req){
                                    $q->where('nomor_cacah_krama_mipil', $req->query('nic'));
                                }])
                                ->whereHas('presensi_krama_detail', function($q) use($req) {
                                    $q->where('nomor_cacah_krama_mipil', $req->query('nic'));
                                })->get();

        if ($presensi) {
            return response()->json([
                'statusCode' => 200,
                'status' => true,
                'data' => $presensi,
                'message' => 'data presensi sukses'
            ], 200);
        } else {
            return response()->json([
                'statusCode' => 500,
                'status' => false,
                'data' => null,
                'message' => 'data presensi gagal'
            ], 500);
        }
    }

}
