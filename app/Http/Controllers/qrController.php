<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\absensi_setting;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class qrController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $nomer = 'testing';
        // $targetUrl = 'https://www.youtube.com/watch?v=Ik4PwlKMJsQ';
        // return QrCode::generate(
        //     $targetUrl, public_path('qrcodes/qrcode.png')
        // );

        return view('qrCode.index', compact('nomer'));
    }

    public function absen()
    {
        return view('qrCode.absen');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
