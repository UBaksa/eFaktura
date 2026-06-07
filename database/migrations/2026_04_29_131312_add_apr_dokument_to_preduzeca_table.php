<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('preduzeca', function (Blueprint $table) {
            $table->string('apr_dokument_url')->nullable()->after('telefon');
            $table->string('apr_dokument_public_id')->nullable()->after('apr_dokument_url');
        });
    }

    public function down(): void
    {
        Schema::table('preduzeca', function (Blueprint $table) {
            $table->dropColumn(['apr_dokument_url', 'apr_dokument_public_id']);
        });
    }
};