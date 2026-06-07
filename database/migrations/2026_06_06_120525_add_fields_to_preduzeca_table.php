<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('preduzeca', function (Blueprint $table) {
            $table->year('godina_osnivanja')->nullable()->after('telefon');
            $table->string('ime_vlasnika', 100)->nullable()->after('godina_osnivanja');
            $table->string('mesto', 100)->nullable()->after('ime_vlasnika');
            $table->enum('vrsta_preduzeca', ['mikro', 'malo', 'srednje', 'veliko'])->nullable()->after('mesto');
            $table->string('vrsta_delatnosti', 100)->nullable()->after('vrsta_preduzeca');
        });
    }

    public function down(): void
    {
        Schema::table('preduzeca', function (Blueprint $table) {
            $table->dropColumn([
                'godina_osnivanja', 'ime_vlasnika', 'mesto',
                'vrsta_preduzeca', 'vrsta_delatnosti'
            ]);
        });
    }
};