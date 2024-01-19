<?php

namespace App\Http\Controllers;

use App\Models\absensi;
use App\Models\absensi_detail;
use App\Models\absensi_setting;
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
        $absensi = absensi::where('date',date('Y-m-d'))->first();
        if(!$absensi)
        {
            $new_absensi = new absensi();
            $new_absensi->date = date('Y-m-d');
            $new_absensi->total_students = 0;
            $new_absensi->save();
            $absensi = absensi::where('date',date('Y-m-d'))->first();
        }
        $absensi = absensi_setting::find(1);
        $now = date('H:i:s');
        if($now < $absensi->home_time){
            $data = absensi_detail::join('students','absensi_details.id_student','students.id')
            ->where('absensi_details.id_absensi',$absensi->id)
            ->where('absensi_details.needs','D')
            ->select('absensi_details.*','students.fullname','students.nisn')
            ->get();
        }else{
            $data = absensi_detail::join('students','absensi_details.id_student','students.id')
            ->where('absensi_details.id_absensi',$absensi->id)->where('absensi_details.needs','P')
            ->where('absensi_details.id_absensi',$absensi->id)
            ->where('absensi_details.needs','D')
            ->select('absensi_details.*','students.fullname','students.nisn')
            ->get();;
        }

        return response()->json([
            'data' => $data
        ], 200);
    }

    public function get_data_absensi_persekolah()
    {
        date_default_timezone_set('Asia/Jakarta');
        $absensi = absensi::where('date',date('Y-m-d'))->first();
        if(!$absensi)
        {
            $new_absensi = new absensi();
            $new_absensi->date = date('Y-m-d');
            $new_absensi->total_students = 0;
            $new_absensi->save();
            $absensi = absensi::where('date',date('Y-m-d'))->first();
        }
        $absensi = absensi_setting::find(1);
        $now = date('H:i:s');
        if($now < $absensi->home_time){
            $data = absensi_detail::join('students','absensi_details.id_student','students.id')
            ->join('schools','students.id_school','schools.id')
            ->where('absensi_details.id_absensi',$absensi->id)
            ->where('absensi_details.needs','D')
            ->select('absensi_details.*','schools.school_name')
            ->get();
        }else{
            $data = absensi_detail::join('students','absensi_details.id_student','students.id')
            ->join('schools','students.id_school','schools.id')
            ->where('absensi_details.id_absensi',$absensi->id)
            ->where('absensi_details.needs','P')
            ->select('absensi_details.*','schools.school_name')
            ->get();;
        }

        return response()->json([
            'data' => $data
        ], 200);
    }
}
