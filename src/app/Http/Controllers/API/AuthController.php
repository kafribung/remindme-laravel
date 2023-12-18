<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\API\AuthResource;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Validation and login
        if (! auth()->attempt($data)) {
            return response([
                'ok' => false,
                'err' => 'ERR_INVALID_CREDS',
                'msg' => 'incorrect username or password',
            ], 401);
        }

        // Remove all token
        auth()->user()->tokens()->delete();

        // Make token
        $access_token = auth()->user()->createToken('access_token')->plainTextToken;
        $refresh_token = auth()->user()->createToken('refresh_token')->plainTextToken;

        // Get data
        $data = auth()->user();
        $data->access_token = $access_token;
        $data->refresh_token = $refresh_token;

        return new AuthResource($data);
    }

    public function logout()
    {
        // Remove token
        auth()->user()->tokens()->delete();

        return response([
            'ok' => true,
            'message' => 'The user success logout',
        ]);
    }
}
