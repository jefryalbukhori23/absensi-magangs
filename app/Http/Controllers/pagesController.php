<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\absensi;
use App\Models\absensi_detail;
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
        date_default_timezone_set('Asia/Jakarta');
        $students = students::all();
        $schools = schools::all();
        $sett = absensi_setting::find(1);
        $now = date('H:i:s');
        $absensi = absensi::where('date',date('Y-m-d'))->first();
        if(!$absensi)
        {
            $new_absensi = new absensi();
            $new_absensi->date = date('Y-m-d');
            $new_absensi->total_students = 0;
            $new_absensi->save();
            $absensi = absensi::where('date',date('Y-m-d'))->first();
        }
        if($now < $sett->home_time){
            $data = absensi_detail::where('id_absensi',$absensi->id)->where('needs','D')->get();
            
        }else{
            $data = absensi_detail::where('id_absensi',$absensi->id)->where('needs','P')->get();
        }

        return view('admins.dashboard')->with([
            'students' => $students,
            'schools' => $schools,
            'siswa_hadir' => $data->count(),
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
