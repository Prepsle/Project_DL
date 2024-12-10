<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class gio_hangs extends Model
{
    use HasFactory;


    protected $fillable = [
        'ma_tai_khoan',
        'ma_bai_viet',
        'quantity',
        'price',
    ];

    // Nếu có mối quan hệ với bảng người dùng và sản phẩm
    public function user()
    {
        return $this->belongsTo(TaiKhoan::class);
    }

    public function product()
    {
        return $this->belongsTo(BaiViet::class);
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
