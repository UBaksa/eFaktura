<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ziro_racuni', function (Blueprint $table) {
            $table->id();
            $table->foreignId('preduzece_id')->constrained('preduzeca')->onDelete('cascade');
            $table->string('broj_racuna', 20);
            $table->integer('redosled');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ziro_racuni');
    }
};