<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class testController extends Controller
{
    //

    public function profilUser()
    {
        return view('profil.profilUser');
    }
    
    public function profilAdmin()
    {
        return view('profil.profilAdmin');
    }
}
