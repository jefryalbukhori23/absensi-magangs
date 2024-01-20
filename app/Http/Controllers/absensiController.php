<?php

namespace App\Http\Controllers;

use App\Models\absensi;
use App\Models\absensi_detail;
use App\Models\absensi_setting;
use App\Models\schools;
use App\Models\students;
use Illuminate\Http\Request;

class absensiController extends Controller
{
    public function absen(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        $request->validate([
            'img' => 'required|image|mimes:jpg,png,jpeg|max:2048',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        $absensi = absensi::where('date',date('Y-m-d'))->first();
        if(!$absensi)
        {
            $new_absensi = new absensi();
            $new_absensi->date = date('Y-m-d');
            $new_absensi->total_students = 0;
            $new_absensi->save();
            $absensi = absensi::where('date',date('Y-m-d'))->first();
        }
        $data = new absensi_detail();
        $data->id_absensi = $absensi->id;
        $data->needs = $request->needs;
        $data->status = $request->status;
        $data->time = $request->time;
        $data->latitude = $request->latitude;
        $data->longitude = $request->longitude;
        $logoPath = $request->file('img')->store('absen_image', 'public');
        $data->photo = $logoPath;
        $data->save();

        return response()->json([
            'msg' => 'success'
        ], 200);
    }

    public function get_jml_siswa()
    {
        date_default_timezone_set('Asia/Jakarta');
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

        return response()->json($data->count());
    }

    public function get_data_absensi()
    {
        date_default_timezone_set('Asia/Jakarta');
        $tgl_now = date('Y-m-d');
        $absensi = absensi::latest()->get();

        $data = array();
        $index = 0;
        foreach($absensi as $absen){
            $datas = absensi_detail::join('absensis','absensi_details.id_absensi','absensis.id')->join('students','absensi_details.id_student','students.id')
            ->where('absensi_details.id_absensi',$absen->id)
            ->select('absensi_details.*','students.fullname','students.nisn','absensis.date')
            ->get();
            foreach($datas as $item)
            {
                $data[$index]['id'] = $item->id;
                $data[$index]['fullname'] = $item->fullname;
                $data[$index]['nisn'] = $item->nisn;
                $data[$index]['date'] = $item->date;
                $data[$index]['time'] = $item->time;
                $data[$index]['status'] = $item->status;
                $data[$index]['photo'] = $item->photo;
                $data[$index]['latitude'] = $item->latitude;
                $data[$index]['longitude'] = $item->longitude;
                $data[$index]['need'] = $item->needs;
                $index++;
            }
        }
        
        // if(!$absensi)
        // {
        //     $new_absensi = new absensi();
        //     $new_absensi->date = date('Y-m-d');
        //     $new_absensi->total_students = 0;
        //     $new_absensi->save();
        //     $absensi = absensi::where('date',$tgl_now)->first();
        // }
        
        // $absensi_setting = absensi_setting::find(1);
        // $now = date('H:i:s');
        // if($now < $absensi_setting->home_time){
        //     $data = absensi_detail::join('absensis','absensi_details.id_absensi','absensis.id')->join('students','absensi_details.id_student','students.id')
        //     ->where('absensi_details.id_absensi',$absensi->id)
        //     ->where('absensi_details.needs','D')
        //     ->select('absensi_details.*','students.fullname','students.nisn','absensis.date')
        //     ->get();
        // }else{
        //     $data = absensi_detail::join('absensis','absensi_details.id_absensi','absensis.id')->join('students','absensi_details.id_student','students.id')
        //     ->where('absensi_details.id_absensi',$absensi->id)
        //     ->where('absensi_details.needs','P')
        //     ->select('absensi_details.*','students.fullname','students.nisn','absensis.date')
        //     ->get();
        // }

        return response()->json([
            'data' => $data
        ], 200);
    }

    public function get_data_absensi_persekolah()
    {
        date_default_timezone_set('Asia/Jakarta');
        $absensi = absensi::latest()->get();

        $datas = array();
        $index = 0;
        $school = schools::all();
        foreach($absensi as $absen){
            foreach($school as $item)
            {
                $siswa_magang = students::where('id_school',$item->id)->count();
                $siswa_hadir = absensi_detail::join('students','absensi_details.id_student','students.id')
                ->join('schools','students.id_school','schools.id')
                ->where('absensi_details.id_absensi',$absen->id)
                ->where('absensi_details.needs','D')
                ->where('schools.id',$item->id)
                ->count();
                $sakit = absensi_detail::join('students','absensi_details.id_student','students.id')
                ->join('schools','students.id_school','schools.id')
                ->where('absensi_details.id_absensi',$absen->id)
                ->where('absensi_details.needs','S')
                ->where('schools.id',$item->id)
                ->count();
                $izin = absensi_detail::join('students','absensi_details.id_student','students.id')
                ->join('schools','students.id_school','schools.id')
                ->where('absensi_details.id_absensi',$absen->id)
                ->where('absensi_details.needs','I')
                ->where('schools.id',$item->id)
                ->count();
                $alpha = absensi_detail::join('students','absensi_details.id_student','students.id')
                ->join('schools','students.id_school','schools.id')
                ->where('absensi_details.id_absensi',$absen->id)
                ->where('absensi_details.needs','A')
                ->where('schools.id',$item->id)
                ->count();
    
                $datas[$index]['school_name'] = $item->school_name;
                $datas[$index]['date'] = $absen->date;
                $datas[$index]['siswa_magang'] = $siswa_magang;
                $datas[$index]['siswa_hadir'] = $siswa_hadir;
                $datas[$index]['sakit'] = $sakit;
                $datas[$index]['izin'] = $izin;
                $datas[$index]['alpha'] = $alpha;
                $index++;
            }
        }

        return response()->json([
            'data' => $datas
        ], 200);
    }
}
