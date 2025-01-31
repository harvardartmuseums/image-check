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
        Schema::create('ratio_comparisons', function (Blueprint $table) {
            $table->id();

            // Base image details
            $table->string('BaseImageURL');
            $table->string('CachePath');
            $table->dateTime('DYNMC_DRS_FileDate');
            $table->bigInteger('DYNMC_DRS_FileID');
            $table->integer('DYNMC_PixelH');
            $table->integer('DYNMC_PixelW');
            $table->float('DYNMC_Ratio')->nullable();
            $table->dateTime('EnteredDate');
            $table->bigInteger('FileID');
            $table->string('FileName');
            $table->bigInteger('MediaMasterID');

            // Production work image details
            $table->string('PRDWORK_BaseImageURL');
            $table->dateTime('PRDWORK_DRS_FileDate');
            $table->bigInteger('PRDWORK_DRS_File_ID');
            $table->bigInteger('PRDWORK_FileID');
            $table->string('PRDWORK_FileName');
            $table->bigInteger('PRDWORK_MediaMasterID');
            $table->integer('PRDWORK_PixelH');
            $table->integer('PRDWORK_PixelW');
            $table->float('PRDWORK_Ratio')->nullable();
            $table->string('PRDWORK_RenditionNumber');

            // Path details
            $table->string('Path');
            $table->string('RenditionNumber');
            $table->float('RatioDifference')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ratio_comparisons');
    }
};
