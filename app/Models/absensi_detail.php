<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class absensi_detail extends Model
{
    use HasFactory;
    protected $table = 'absensi_details';
    protected $guarded = ['id'];
}
