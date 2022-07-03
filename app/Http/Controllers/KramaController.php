<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class KramaController extends Controller
{
    public function getKrama(Request $r)
    {
        $response = Http::acceptJson()->withToken($r->token)->get("https://sikramat.ngaeapp.com/api/user/cacah-krama/get-cacah-krama");
        if ($response->successful()) {
            $responseBody = json_decode($response->body());
            if ($responseBody->message == "data penduduk sukses") {
                return response()->json([
                    'statusCode' => 200,
                    'penduduk' => $responseBody->penduduk,
                    'cacahKramaMipil' => $responseBody->cacahKramaMipil,
                    'cacahKramaTamiu' => $responseBody->cacahKramaTamiu,
                    'message' => 'data penduduk sukses'
                ], 200);
            } else {
                return response()->json([
                    'statusCode' => 500,
                    'status' => true,
                    'data' => null,
                    'message' => 'data penduduk gagal'
                ], 200);
            }
        } else {
            return response()->json([
                'statusCode' => 500,
                'status' => false,
                'data' => null,
                'token' => null,
                'message' => 'data penduduk gagal'
            ], 200);
        }
    }
}
