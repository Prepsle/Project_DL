<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class XaPhuong extends Model
{
    use HasFactory;

    protected $primaryKey = 'ma_xa_phuong';

    protected $fillable = [
        'ma_xa_phuong',
        'ten_xa_phuong',
        'ma_quan_huyen',
    ];

    public function quanHuyen()
    {
        return $this->hasOne('App\Models\QuanHuyen', 'ma_quan_huyen', 'ma_quan_huyen');
    }

    public function diaDiemList()
    {
        return $this->hasMany('App\Models\DiaDiem', 'ma_xa_phuong', 'ma_xa_phuong');
    }
}
