<?php

namespace App\Http\Controllers;

use App\Models\absensi_setting;
use Illuminate\Http\Request;

class absensiSettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = absensi_setting::all();
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = absensi_setting::find($id);
        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi input
        $request->validate([
            'entry_time' => 'required',
            'home_time' => 'required',
            'office_latitude' => 'required|string',
            'office_longitude' => 'required|string',
        ]);

        // Mengambil data pengaturan absensi berdasarkan ID
        $absensiSetting = absensi_setting::findOrFail($id);

        // Memperbarui data pengaturan absensi
        $absensiSetting->update([
            'entry_time' => $request->input('entry_time'),
            'home_time' => $request->input('home_time'),
            'office_latitude' => $request->input('office_latitude'),
            'office_longitude' => $request->input('office_longitude'),
        ]);

        return response()->json([
            'data' => $absensiSetting
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
