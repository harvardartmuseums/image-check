<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('ratio_comparisons', function (Blueprint $table) {
            $table->integer('mediastatusid');
        });    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ratio_comparisons', function (Blueprint $table) {
            $table->dropColumn('mediastatusid');
        });
    }
};
