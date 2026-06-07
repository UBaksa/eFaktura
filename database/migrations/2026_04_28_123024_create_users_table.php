<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('ime', 50);
            $table->string('prezime', 50);
            $table->string('email', 100)->unique();
            $table->string('lozinka', 255);
            $table->enum('uloga', ['administrator', 'racunovodja', 'direktor']);
            $table->foreignId('preduzece_id')->nullable()->constrained('preduzeca')->onDelete('cascade');
            $table->boolean('aktivan')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};