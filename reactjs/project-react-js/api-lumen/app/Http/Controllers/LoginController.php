<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6'
        ]);

        $data = [
            'email'    => $request->input('email'),
            'password' => $request->input('password'),
            'level'    => 'pelanggan',
            'api_token'=> Str::random(40),
            'status'   => '1',
            'relasi'   => $request->input('email'),
        ];

        $user = User::create($data);

        return response()->json($user);
    }

    public function login(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        $user = User::where('email', $email)->first();

        if ($user && ($password === $password)) {
            $token = Str::random(40);
            $user->update(['api_token' => $token]);

            return response()->json([
                'pesan' => 'Login sukses',
                'token' => $token,
                'data'  => $user,
            ]);
        } else {
            return response()->json([
                'pesan' => 'Login gagal',
                'data'  => null,
            ], 401);
        }
    }
}
