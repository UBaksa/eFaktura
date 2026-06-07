<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('fakture', function (Blueprint $table) {
            $table->text('razlog_odbijanja')->nullable()->after('napomena');
        });
    }

    public function down(): void
    {
        Schema::table('fakture', function (Blueprint $table) {
            $table->dropColumn('razlog_odbijanja');
        });
    }
};