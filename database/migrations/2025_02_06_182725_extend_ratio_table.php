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
            $table->integer('Improvement_Factor');
            $table->string('Object_URL');
            $table->string('Object_Number');
            $table->integer('Object_ID');
            $table->integer('Object_ImagePermissionLevel');
            $table->integer('Object_AccessLevel');
            $table->integer('Object_IsImagePrimaryDisplay');
            $table->integer('Object_ImageRank');
        });    
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ratio_comparisons', function (Blueprint $table) {
            $table->integer('Improvement_Factor');
            $table->string('Object_URL');
            $table->string('Object_Number');
            $table->integer('Object_ID');
            $table->integer('Object_ImagePermissionLevel');
            $table->integer('Object_AccessLevel');
            $table->integer('Object_IsImagePrimaryDisplay');
            $table->integer('Object_ImageRank');
        });
    }
};
