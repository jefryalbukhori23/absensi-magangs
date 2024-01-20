<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfilController extends Controller
{
    public function index()
    {
        return view('admins.profil.index');
    }
    public function pengguna()
    {
        return view('admins.Users.index');
    }
    public function cek_users($id)
    {
        if(auth()->user()->id == $id)
        {
            return response()->json('error');
        }else{
            return response()->json('success');
        }
    }
}
