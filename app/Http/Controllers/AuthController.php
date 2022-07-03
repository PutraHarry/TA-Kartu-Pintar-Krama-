<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    public function login(Request $r)
    {
        $response = Http::post('https://sikramat.ngaeapp.com/api/login', [
            'email' => $r->email,
            'password' => $r->password,
        ]);

        if ($response->successful()) {
            $responseBody = json_decode($response->body());

            if ($responseBody->message == "email not verified") {
                return response()->json([
                    'statusCode' => 403,
                    'status' => false,
                    'data' => null,
                    'token' => null,
                    'message' => 'email not verified'
                ], 200);
            } else if ($responseBody->message == "Login gagal") {
                return response()->json([
                    'statusCode' => 403,
                    'status' => false,
                    'data' => null,
                    'token' => null,
                    'message' => 'Login gagal'
                ], 200);
            } else {
                return response()->json([
                    'statusCode' => 200,
                    'status' => true,
                    'data' => $responseBody->data,
                    'token' => $responseBody->token,
                    'message' => 'Login berhasil'
                ], 200);
            }

        } else {
            return response()->json([
                'statusCode' => 403,
                'status' => false,
                'data' => null,
                'token' => null,
                'message' => 'Login gagal'
            ], 200);
        }
    }
}
