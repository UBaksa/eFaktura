<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('komitenti', function (Blueprint $table) {
            $table->id();
            $table->string('naziv', 200);
            $table->string('pib', 9);
            $table->string('adresa', 200);
            $table->string('email', 100)->nullable();
            $table->string('telefon', 20)->nullable();
            $table->enum('tip', ['klijent', 'dobavljac', 'oba']);
            $table->foreignId('preduzece_id')->constrained('preduzeca')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('komitenti');
    }
};