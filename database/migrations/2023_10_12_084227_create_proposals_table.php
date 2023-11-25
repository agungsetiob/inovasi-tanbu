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
        Schema::create('proposals', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->unique();
            $table->text('rancang_bangun');
            $table->text('tujuan');
            $table->text('manfaat');
            $table->text('hasil');
            $table->date('ujicoba');
            $table->date('implementasi');
            $table->string('profil')->nullable();
            $table->string('anggaran')->nullable();
            $table->string('status')->default('draft');//add this on 11 october 2023
            $table->unsignedBigInteger('bentuk_id');
            $table->foreign('bentuk_id')->references('id')->on('bentuks');
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->unsignedBigInteger('skpd_id');
            $table->foreign('skpd_id')->references('id')->on('skpds');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreignId('tematik_id')->constrained('tematiks');
            $table->foreignId('tahapan_id')->constrained('tahapans');
            $table->foreignId('inisiator_id')->constrained('inisiators');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proposals');
    }
};
