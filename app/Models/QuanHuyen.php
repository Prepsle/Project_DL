<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuanHuyen extends Model
{
    use HasFactory;

    protected $primaryKey = 'ma_quan_huyen';

    protected $fillable = [
        'ma_quan_huyen',
        'ten_quan_huyen',
    ];
}
