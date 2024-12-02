<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiaDiemBaiViet extends Model
{
    use HasFactory;

    protected $fillable = [
        'ma_dia_diem',
        'ma_bai_viet',
    ];
}
