<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\qrQode;
use App\Models\scaninfo;
use App\Models\students;
use Illuminate\Http\Request;

class scanController extends Controller
{
    //

    public function scan()
    {
        return view('cameraScan.index');
    }

    public function addscan($kode)
    {
        $now_code = qrQode::find(1);
        if($now_code->qrQode == $kode)
        {
            $student = students::where('id_user',auth()->user()->id)->first();
            $scan = new scaninfo();
            $scan->id_students = $student->id;
            $scan->status = 'C';
            $scan->save();
            return response()->json([
                'msg' => 'Berhasil',
                'text' => 'Lakukan Presensi Sekarang !'
            ], 200);
        }else{
            return response()->json([
                'msg' => 'Gagal',
                'text' => 'Qr COde Salah, Coba Lagi !'
            ], 200);
        }
    }

    public function cekscan()
    {
        $cek = scaninfo::where('status','C')->latest()->first();
        $status_F = scaninfo::where('status','F')->latest()->first();
        if($status_F){
            $status_F->delete();
        }
        if($cek){
            $data = students::find($cek->id_students);
            $cek->status = 'P';
            $cek->save();
            return response()->json([
                'msg' => 'success',
                'data' => $data,
                'scan' => $cek
            ], 200);
        }else{
            return response()->json([
                'msg' => 'no'
            ], 200);
        }
    }

    public function cek_photo()
    {
        $student = students::where('id_user',auth()->user()->id)->first();
        $data = scaninfo::where('id_students',$student->id)->latest()->first();
        if($data)
        {
            if($data->status == 'S'){
                $data->delete();
                return response()->json([
                    'status'=>'S'
                ], 200);
            }else if($data->status == 'GL'){
                $data->delete();
                return response()->json([
                    'status' => 'GL'
                ], 200);
            }else if($data->status == 'GI')
            {
                $data->delete();
                return response()->json([
                    'status' => 'GI'
                ], 200);
            }
            else{
                return response()->json([
                    'status' => 'F'
                ], 200);
            }
        }else{
            return response()->json([
                'status' => 'TA'
            ], 200);
        }
    }
}
