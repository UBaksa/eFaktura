<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('stavke_fakture', function (Blueprint $table) {
            $table->id();
            $table->string('naziv', 200);
            $table->decimal('kolicina', 10, 3);
            $table->string('jedinica_mere', 20);
            $table->decimal('cena_bez_pdv', 15, 2);
            $table->decimal('pdv_stopa', 5, 2)->default(0);
            $table->decimal('iznos_pdv', 15, 2)->default(0);
            $table->decimal('ukupno', 15, 2);
            $table->foreignId('faktura_id')->constrained('fakture')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stavke_fakture');
    }
};