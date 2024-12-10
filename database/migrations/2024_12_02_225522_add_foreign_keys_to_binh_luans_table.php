<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('binh_luans', function (Blueprint $table) {
            $table->foreign(['ma_bai_viet'])->references(['ma_bai_viet'])->on('bai_viets')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['ma_tai_khoan'])->references(['ma_tai_khoan'])->on('tai_khoans')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('binh_luans', function (Blueprint $table) {
            $table->dropForeign('binh_luans_ma_bai_viet_foreign');
            $table->dropForeign('binh_luans_ma_tai_khoan_foreign');
        });
    }
};
