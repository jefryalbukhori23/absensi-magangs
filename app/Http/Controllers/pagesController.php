<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\absensi_setting;
use App\Models\qrQode;
use App\Models\schools;
use App\Models\students;
use Illuminate\Http\Request;

class pagesController extends Controller
{
    //
    public function dashboard()
    {
        $students = students::all();
        $schools = schools::all();
        return view('admins.dashboard')->with([
            'students' => $students,
            'schools' => $schools
        ]);
    }
    
    public function siswa()
    {
        $data = schools::all();
        return view('admins.students.siswa')->with([
            'schools' => $data
        ]);
    }
    
    public function sekolah()
    {
        $data = schools::all();
        return view('admins.school.sekolah')->with([
            'schools' => $data
        ]);
    }
    public function perSiswa()
    {
        return view('admins.report.perSiswa');
    }
    
    public function perSekolah()
    {
        return view('admins.report.perSekolah');
    }
    
    public function settingJam()
    {
        return view('admins.setting_absensi.settingJam');
    }
    
    public function qrCode()
    {
        $qr = qrQode::find(1);
        $qr->qrQode = uniqid();
        $qr->save();
        $siswa = students::all();
        $sett = absensi_setting::find(1);
        return view('admins.qrQode.qrCode')->with([
            'qr' => $qr,
            'siswa' => $siswa,
            'sett' => $sett
        ]);
    }
}
