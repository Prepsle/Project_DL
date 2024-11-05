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
            $table->id('ma_xa_phuong');
            $table->string('ten_xa_phuong');
            $table->unsignedBigInteger('ma_quan_huyen');
            $table->foreign('ma_quan_huyen')->references('ma_quan_huyen')->on('quan_huyens')->onUpdate('cascade')->onDelete('cascade');
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
