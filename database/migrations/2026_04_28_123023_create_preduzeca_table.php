<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('preduzeca', function (Blueprint $table) {
            $table->id();
            $table->string('naziv', 200);
            $table->string('pib', 9)->unique();
            $table->string('maticni_broj', 8)->unique();
            $table->string('adresa', 200);
            $table->string('email', 100);
            $table->string('telefon', 20);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('preduzeca');
    }
};