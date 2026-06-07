<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('fakture', function (Blueprint $table) {
            $table->unsignedBigInteger('povezana_faktura_id')->nullable()->after('korisnik_id');
            $table->foreign('povezana_faktura_id')->references('id')->on('fakture')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('fakture', function (Blueprint $table) {
            $table->dropForeign(['povezana_faktura_id']);
            $table->dropColumn('povezana_faktura_id');
        });
    }
};