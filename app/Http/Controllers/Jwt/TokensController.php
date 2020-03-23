<?php

namespace App\Http\Controllers\Jwt;

use App\Http\Controllers\Controller;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenBlacklistedException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Facades\JWTAuth;

class TokensController extends Controller
{
    //

    public function login(Request $request)
    {
        try {
            $credentials = $request->only(['email', 'password']);
            $validator = Validator::make($credentials, ['email' => 'required|email','password' => 'required']);
            if ($validator->fails()) {return ($this->errorResponse('Las credenciales no estan en un formato correcto', 422));}
            $token = JWTAuth::attempt($credentials);
            if ($token) {
                return ($this->successResponse(['success' => true, 'token' => $token, 'user' => User::with('profile', 'people')->where('email', $credentials['email'])->first()]));
            } else {
                return ($this->errorResponse('El usuario y contraseña no son correctos', 422));
            }
        } catch (Exception $e) {
            return ($this->errorResponse('Se presento un error en la ejecución de la validación', 422));
        }
    }


    public function refreshToken()
    {
        $token = JWTAuth::getToken();

        try {
            $RefreshToken = JWTAuth::refresh($token);
            return response()->json([
                'success' => true,
                'token' => $RefreshToken
            ], 200);
        } catch (TokenExpiredException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Token Expirado: TokenExpiredException',
            ], 422);
        } catch (TokenBlacklistedException $e) {
            return response()->json([
                'success' => false,
                'message' => 'No se pudo refrescar el token: TokenBlacklistedException',
            ], 422);
        }
    }



    public function logout()
    {

        $token = JWTAuth::getToken();
        try {
            JWTAuth::invalidate($token);

            return response()->json([
                'success' => true,
                'message' => 'Token Expirado Correctamente'
            ], 200);
        } catch (JWTException $ex) {
            return response()->json([
                'success' => false,
                'message' => 'Fallo la  desactivación del token'
            ], 422);
        }
    }

    public function lucho()
    {
        return response()->json([
            'message' => 'Bien'
        ]);
    }
}
