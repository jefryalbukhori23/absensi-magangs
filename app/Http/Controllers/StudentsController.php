<?php

namespace App\Http\Controllers;

use App\Models\students;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = students::all();
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
        // Validasi input
        $request->validate([
            'id_school' => 'required|integer',
            'fullname' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            // 'nisn' => 'string|max:255',
            // 'gender' => 'in:L,P',
            // 'place_birth' => 'string|max:255',
            // 'date_of_birth' => 'date',
            // 'telephone_number' => 'string|max:20',
        ]);

        $user = new User();
        $user->name = $request->fullname;
        $user->email = $request->email;
        $user->password = Hash::make('123456');
        $user->role = 'student';
        $user->save();

        // Menyimpan data ke dalam database
        $student = new students([
            'id_school' => $request->input('id_school'),
            'id_user' => $user->id,
            'fullname' => $request->input('fullname'),
            'nisn' => $request->input('nisn'),
            'gender' => $request->input('gender'),
            'place_birth' => $request->input('place_birth'),
            'date_of_birth' => $request->input('date_of_birth'),
            'telephone_number' => $request->input('telephone_number'),
        ]);

        $student->save();
        return response()->json([
            'data' => $student
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = students::join('users','students.id_user','users.id')
        ->select('students.*','users.email')
        ->where('students.id',$id)
        ->first();
        // dd($data);
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
            'id_school' => 'required|integer',
            // 'id_user' => 'required|integer',
            'fullname' => 'required|string|max:255',
            // 'nisn' => 'string|max:255',
            // 'gender' => 'in:L,P',
            // 'place_birth' => 'string|max:255',
            // 'date_of_birth' => 'date',
            // 'telephone_number' => 'string|max:20',
        ]);

        
        // Mengambil data siswa berdasarkan ID
        $student = students::findOrFail($id);
        
        $user = User::find($student->id_user);
        $user->name = $request->fullname;
        $user->email = $request->email;
        $user->save();

        // Memperbarui data siswa
        $student->update([
            'id_school' => $request->input('id_school'),
            'fullname' => $request->input('fullname'),
            'nisn' => $request->input('nisn'),
            'gender' => $request->input('gender'),
            'place_birth' => $request->input('place_birth'),
            'date_of_birth' => $request->input('date_of_birth'),
            'telephone_number' => $request->input('telephone_number'),
        ]);

        return response()->json([
            'data' => $student
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = students::find($id);
        $user = User::find($data->id_user);
        $user->delete();
        $data->delete();
        return response()->json([
            'message' => 'success'
        ], 200);
    }
}
