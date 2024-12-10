<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'ma_bai_viet',
        'quantity',
        'unit_price',
        'total_price',
    ];

    // Quan hệ với bảng orders
    public function gio_hangs()
    {
        return $this->belongsTo(gio_hangs::class);
    }

    // Quan hệ với bảng products
    public function bai_viet()
    {
        return $this->belongsTo(BaiViet::class);
    }
}
