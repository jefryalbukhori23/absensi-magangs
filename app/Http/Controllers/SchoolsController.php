<?php

namespace App\Http\Controllers;

use App\Models\schools;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

use function Laravel\Prompts\alert;

class SchoolsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = schools::all();
        return response()->json([
            'data' => $data
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'school_name' => 'required|string|max:255',
            'type_school' => 'required',
            // 'npsn' => 'string|max:255',
            // 'email' => 'email|max:255',
            // 'telephone_number' => 'string|max:20',
            // 'address' => 'string|max:255',
            // 'headmaster' => 'string|max:255',
            // 'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', 
        ]);

        // Menyimpan data ke dalam database
        $school = new schools([
            'school_name' => $request->input('school_name'),
            'type_school' => $request->input('type_school'),
            'npsn' => $request->input('npsn'),
            'email' => $request->input('email'),
            'telephone_number' => $request->input('telephone_number'),
            'address' => $request->input('address'),
            'headmaster' => $request->input('headmaster'),
        ]);

        // Mengelola gambar logo jika diupload
        if ($request->hasFile('logo')) {
            $request->validate([
                'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', 
            ]);
            $foto_file = $request->file('logo');
            $foto_ekstensi = $foto_file->extension();
            $foto_nama = date('ymdhis'). uniqid() . "." . $foto_ekstensi;
            $foto_file->move(public_path('logos'), $foto_nama);
            $school->logo = $foto_nama;
        }

        $school->save();

        return response()->json([
            'data' => $school
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = schools::find($id);
        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi input
        $request->validate([
            'school_name' => 'required|string|max:255',
            'type_school' => 'required',
            // 'npsn' => 'string|max:255',
            // 'email' => 'email|max:255',
            // 'telephone_number' => 'string|max:20',
            // 'address' => 'string|max:255',
            // 'headmaster' => 'string|max:255',
            // 'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', 
        ]);

        // Mengambil data sekolah berdasarkan ID
        $school = schools::findOrFail($id);

        // Memperbarui data sekolah
        $school->update([
            'school_name' => $request->input('school_name'),
            'type_school' => $request->input('type_school'),
            'npsn' => $request->input('npsn'),
            'email' => $request->input('email'),
            'telephone_number' => $request->input('telephone_number'),
            'address' => $request->input('address'),
            'headmaster' => $request->input('headmaster'),
        ]);

        // Mengelola gambar logo jika diupload
        if ($request->hasFile('logo')) {
            $foto_file = $request->file('logo');
            $foto_ekstensi = $foto_file->extension();
            $foto_nama = date('ymdhis'). uniqid() . "." . $foto_ekstensi;
            $foto_file->move(public_path('logos'), $foto_nama);
            $school->logo = $foto_nama;
            File::delete(public_path('logos') . '/' . $school->logo);
            $school->save();
        }

        return response()->json([
            'data' => $school
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = schools::find($id);
        File::delete(public_path('logos') . '/' . $data->logo);
        $data->delete();
        return response()->json([
            'msg' => 'success'
        ], 200);
    }
}
