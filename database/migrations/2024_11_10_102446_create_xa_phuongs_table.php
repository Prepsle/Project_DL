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
        Schema::create('xa_phuongs', function (Blueprint $table) {
            $table->bigIncrements('ma_xa_phuong');
            $table->string('ten_xa_phuong');
            $table->unsignedBigInteger('ma_quan_huyen')->index('xa_phuongs_ma_quan_huyen_foreign');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('xa_phuongs');
    }
};
