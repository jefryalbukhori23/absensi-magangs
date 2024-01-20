<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function index(Request $request)
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'login' => 'required',
            'password' => 'required',
        ]);

        // $data = [
        //     'email' => $request->email,
        //     'password' => $request->password,
        // ];

        // if(Auth::attempt($data)){
        //     return redirect('/dashboard_admin');
        // }else{
        //     return back();  
        // }

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        $loginType = filter_var($request->input('login'), FILTER_VALIDATE_EMAIL)
        ? 'email'
        : 'username';
        
        $credentials = [
            $loginType => $request->input('login'),
            'password' => $request->input('password'),
        ];

        // dd($request->all());

        // $credentials = $request->only('email', 'password');

        try {
            if (Auth::attempt($credentials)) {
                return response()->json(['success' => true, 'user' => Auth::user()]);
            } else {
                throw ValidationException::withMessages([
                    'email' => __('auth.failed'),
                ]);
            }
        } catch (ValidationException $e) {
            return response()->json(['success' => false, 'errors' => $e->errors()], 422);
        }

    }

    public function logout()
    {
        Auth::logout();

        // $request->session()->invalidate();

        // $request->session()->regenerateToken();

        return redirect('/'); // Ganti dengan halaman yang ingin Anda tampilkan setelah logout
    }
}
