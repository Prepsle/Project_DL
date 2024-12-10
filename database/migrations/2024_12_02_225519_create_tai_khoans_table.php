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
        Schema::create('tai_khoans', function (Blueprint $table) {
            $table->bigIncrements('ma_tai_khoan');
            $table->string('ten_tai_khoan');
            $table->string('sdt');
            $table->string('email');
            $table->string('mat_khau');
            $table->boolean('da_thanh_toan')->default(true);
            $table->string('facebook_id')->nullable();
            $table->boolean('da_duyet')->nullable()->default(true);
            $table->string('hinh_dai_dien')->nullable();
            $table->string('giay_phep_kd')->nullable();
            $table->unsignedBigInteger('ma_loai_tai_khoan')->index('tai_khoans_ma_loai_tai_khoan_foreign');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tai_khoans');
    }
};
