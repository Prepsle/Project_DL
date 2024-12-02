<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoaiDiaDiem extends Model
{
    use HasFactory;

    protected $primaryKey = 'ma_loai_dia_diem';

    protected $fillable = [
        'ma_loai_dia_diem',
        'ten_loai_dia_diem',
    ];
}
