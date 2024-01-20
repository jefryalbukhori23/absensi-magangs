<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\absensi;
use App\Models\absensi_detail;
use App\Models\absensi_setting;
use App\Models\scaninfo;
use App\Models\students;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FaceRecognitionController extends Controller
{
    //

    public function index($id,$kode)
    {
        $students = students::find($id);
        $data = scaninfo::where('id_students',$id)->latest()->first();
        if($data->status == 'P' || $data->status == 'F'){
            $data->status = 'F';
            $data->save();
            return view ('admins.FaceScan.index')->with([
                'student' => $students,
                'kode' => $kode
            ]);
        }else{
            return redirect('/logout');
        }
    }

    public function saveImage(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        $request->validate([
            'image' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ],[
            'image.required' => 'Foto Tidak Valid',
            'latitude.required' => 'Aktifkan Lokasi Anda',
            'longitude.required' => 'Aktifkan Lokasi Anda',
        ]);
        $info = scaninfo::where('id_students',$request->id_student)->latest()->first();
        if($info->status == 'F'){
            $imageData = $request->input('image');

            // Decode data URL to get raw image data
            $imageData = str_replace('data:image/png;base64,', '', $imageData);
            $imageData = str_replace(' ', '+', $imageData);
            $imageData = base64_decode($imageData);
    
            $absensi = absensi::where('date',date('Y-m-d'))->first();
            if(!$absensi)
            {
                $new_absensi = new absensi();
                $new_absensi->date = date('Y-m-d');
                $new_absensi->total_students = 0;
                $new_absensi->save();
                $absensi = absensi::where('date',date('Y-m-d'))->first();
            }
            $sett = absensi_setting::find(1);

            // Koordinat kantor
            $latitude_kantor = $sett->office_latitude;
            $longitude_kantor = $sett->office_longitude;
            
            // Koordinat saat ini
            $latitude_now = $request->latitude;
            $longitude_now = $request->longitude;
            
            // Hitung jarak antara kedua titik
            $jarak = $this->haversine($latitude_kantor, $longitude_kantor, $latitude_now, $longitude_now);
            // Pengecekan apakah jarak lebih dari 10 meter
            $tolerance = 0.05; // Ubah nilai ini sesuai dengan kebutuhan Anda
            if ($jarak > $tolerance) {
                $info->status = 'GL';
                $info->save();
                return response()->json([
                    'msg' => 'Gagal',
                    'text' => 'Lokasi saat ini lebih dari 10 meter dari lokasi kantor.'
                ], 200);
            }

            $now = date('H:i:s');
            if($now >= $sett->home_time){
                $keperluan = 'P';
                $status = 'Tepat';
            }else{
                $keperluan = 'D';
                if($now > $sett->entry_time){
                    $status = 'Terlambat';
                }else{
                    $status = 'Tepat';
                }
            }
            // Generate unique filename
            $filename = 'image_' . time() . '.png';
    
            // Save image to the public directory
            file_put_contents(public_path('assets/image/' . $filename), $imageData);
    
            // Implement your additional business logic here
            $st = students::find($request->id_student);
            $cek_absensi = absensi_detail::where('id_absensi',$absensi->id)->where('id_student',$request->id_student)->where('needs',$keperluan)->first();
            if($cek_absensi){
                $info->delete();
                if($cek_absensi->needs == 'D'){
                    return response()->json([
                        'msg' => 'Berhasil',
                        'text' => $st->fullname.' Sudah Presensi Datang'
                    ], 200);
                }else{
                    return response()->json([
                        'msg' => 'Berhasil',
                        'text' => $st->fullname.' Sudah Presensi Pulang'
                    ], 200);

                }
            }
            $data = new absensi_detail();
            $data->id_absensi = $absensi->id;
            $data->id_student = $request->id_student;
            $data->needs = $keperluan;
            $data->status = $status;
            $data->time = $now;
            $data->latitude = $request->latitude;
            $data->longitude = $request->longitude;
            $data->photo = $filename;
            $data->save();    
    
            $info->status = 'S';
            $info->save();
            // Return the path for further use (you can customize the response)
            return response()->json([
                'msg' => 'Berhasil',
                'text' => $st->fullname .' Berhasil Presensi'
            ]);
        }else{
            $info->status = 'GI';
            $info->save();
            return response()->json([
                'msg' => 'Gagal',
                'text' => 'Kamu Masuk Dengan Ilegal'
            ], 200);
        }
    }

    private function haversine($lat1, $lon1, $lat2, $lon2) {
        // Convert latitude and longitude from degrees to radians
        $lat1 = deg2rad($lat1);
        $lon1 = deg2rad($lon1);
        $lat2 = deg2rad($lat2);
        $lon2 = deg2rad($lon2);
    
        // Haversine formula
        $dlat = $lat2 - $lat1;
        $dlon = $lon2 - $lon1;
        $a = sin($dlat / 2) ** 2 + cos($lat1) * cos($lat2) * sin($dlon / 2) ** 2;
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
    
        // Earth radius in meters (use 6371000 for meters)
        $r = 6371;
    
        // Calculate the distance
        $distance = $r * $c;
    
        return $distance;
    }
}
