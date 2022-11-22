<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\LoginRequest;
use App\Http\Requests\LogoutResource;
use App\Http\Resources\API\Auth\LoginResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\TokenRepository;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        try {
            if(Auth::attempt($request->all())){
                return response()->json(new LoginResource(Auth::user()));
            }
            return response()->json();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function Logout(Request $request)
    {
        try {
            // $tokenRepository = app(TokenRepository::class);
            // $tokenRepository->revokeAccessToken($tokenId);
            Auth::user()->token()->revoke();
            return response()->json(['error'=>false,
                                    'message'=>'You Logged out from system',
                                    'data'=>null]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
