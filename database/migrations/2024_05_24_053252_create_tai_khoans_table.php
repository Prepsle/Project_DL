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
            $table->id('ma_tai_khoan');
            $table->string('ten_tai_khoan');
            $table->string('sdt');
            $table->string('email');
            $table->string('mat_khau');
            $table->boolean('da_thanh_toan')->default(true);
            $table->string('facebook_id')->nullable();
            $table->unsignedBigInteger('ma_loai_tai_khoan');
            $table->foreign('ma_loai_tai_khoan')->references('ma_loai_tai_khoan')->on('loai_tai_khoans')->onUpdate('cascade')->onDelete('cascade');
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
