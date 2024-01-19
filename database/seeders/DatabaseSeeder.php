<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\absensi_setting;
use App\Models\schools;
use App\Models\students;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $users = [
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('123456'),
                'role' => 'admin'
            ],
            [
                'name' => 'Jefry Putra Al Bukhori',
                'email' => 'jefryalbukhori23@gmail.com',
                'password' => Hash::make('123456'),
                'role' => 'student'
            ],
        ];

        $students = [
            [
                'id_school' => 1,
                'id_user' => 2,
                'fullname' => 'Jefry Putra Al Bukhori',
                'nisn' => '0053459280',
                'gender' => 'L',
                'place_birth' => 'Malang',
                'date_of_birth' => '2005-08-10',
                'telephone_number' => '085755763941',
            ],
        ];

        $schools = [
            [
                'school_name' => 'SMKN 1 KEPANJEN',
                'type_school' => 'Negeri',
                'npsn' => '20564067',
                'email' => 'smkn1kepanjen@ymail.com',
                'address' => 'JL. RAYA KEDUNGPEDARINGAN DESA KEDUNGPEDARINGAN KEC. KEPANJEN KAB. MALANG PROV. JAWA TIMUR',
                'headmaster' => 'Lasmono S.Pd MM',
            ]
        ];

        $absensi_settings = [
            [
                'entry_time' => '08:00:00',
                'home_time' => '16:00:00',
                'office_latitude' => '-8.1330733',
                'office_longitude' => '112.5640142',
            ]
        ];

        foreach($users as $user)
        {
            User::create($user);
        }
        foreach($students as $student)
        {
            students::create($student);
        }
        foreach($schools as $school)
        {
            schools::create($school);
        }
        foreach($absensi_settings as $item)
        {
            absensi_setting::create($item);
        }
    }
}
