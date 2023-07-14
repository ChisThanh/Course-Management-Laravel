<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }
    public function processLogin(Request $request)
    {

        try {
            $user = User::query()
                ->where('email', $request->get('email'))
                ->firstOrFail(); // bắn lỗi về

            if (!Hash::check($request->get('password'), $user->password)) {
                throw new Exception('error');
            }

            session()->put('id', $user->id);
            session()->put('level', $user->level);
            session()->put('avatar', $user->avatar);
            session()->put('name', $user->name);

            return redirect()->route('courses.index');
        } catch (\Throwable $th) {
            return redirect()->route('login');
        }
    }

    public function logout()
    {
        session()->flush();
        return redirect()->route('login');
    }
    public function register()
    {
        return view('auth.register');
    }

    public function ProcessRegister(Request $request)
    {
        User::query()
            ->create([
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'password' => Hash::make($request->get('password')),
                'level' => 0,
            ]);

        return redirect()->route('login');
    }
}
