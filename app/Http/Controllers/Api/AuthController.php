<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
            'role' => $request->role,
        ];
        if (! Auth::attempt($credentials)){
            return response()->json(['message' => 'Unauthorized'], 401);
}
        $user = Auth::user();
        return $user->createToken($user->email)->accessToken;
    }
}
