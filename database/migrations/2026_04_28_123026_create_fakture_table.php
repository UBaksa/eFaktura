<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fakture', function (Blueprint $table) {
            $table->id();
            $table->string('broj_fakture', 50);
            $table->date('datum_izdavanja');
            $table->date('datum_valute');
            $table->enum('tip', ['izlazna', 'ulazna']);
            $table->enum('status', ['poslata', 'primljena', 'placena', 'odbijena']);
            $table->string('valuta', 3)->default('RSD');
            $table->text('napomena')->nullable();
            $table->foreignId('preduzece_id')->constrained('preduzeca')->onDelete('cascade');
            $table->foreignId('komitent_id')->constrained('komitenti')->onDelete('cascade');
            $table->foreignId('korisnik_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fakture');
    }
};