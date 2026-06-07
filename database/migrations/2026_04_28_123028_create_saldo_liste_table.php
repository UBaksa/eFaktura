<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('saldo_liste', function (Blueprint $table) {
            $table->id();
            $table->foreignId('preduzece_id')->constrained('preduzeca')->onDelete('cascade');
            $table->foreignId('komitent_id')->constrained('komitenti')->onDelete('cascade');
            $table->decimal('iznos_dugovanja', 15, 2);
            $table->string('valuta', 3)->default('RSD');
            $table->boolean('u_valuti')->default(true);
            $table->timestamp('datum_generisanja');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('saldo_liste');
    }
};