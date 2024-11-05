<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DanhMucDuLich extends Model
{
    use HasFactory;

    protected $primaryKey = 'ma_danh_muc';

    protected $fillable = [
        'ma_danh_muc',
        'ten_danh_muc',
    ];
}
