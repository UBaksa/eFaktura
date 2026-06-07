<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('fakture', function (Blueprint $table) {
            $table->string('dokument_url')->nullable()->after('razlog_odbijanja');
            $table->string('dokument_public_id')->nullable()->after('dokument_url');
        });
    }

    public function down(): void
    {
        Schema::table('fakture', function (Blueprint $table) {
            $table->dropColumn(['dokument_url', 'dokument_public_id']);
        });
    }
};