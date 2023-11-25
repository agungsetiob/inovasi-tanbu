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
        Schema::create('proposal_urusan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('proposal_id')->constrained('proposals');
            $table->foreignId('urusan_id')->constrained('urusans');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proposal_urusan');
    }
};
