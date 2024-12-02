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
        Schema::table('bai_viets', function (Blueprint $table) {
            $table->foreign(['nguoi_dang_bai_viet'])->references(['ma_tai_khoan'])->on('tai_khoans')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bai_viets', function (Blueprint $table) {
            $table->dropForeign('bai_viets_nguoi_dang_bai_viet_foreign');
        });
    }
};
