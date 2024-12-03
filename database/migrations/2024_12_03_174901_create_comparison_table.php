<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('comparisons', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('MediaMasterID');
            $table->dateTime('EnteredDate');
            $table->string('RenditionNumber');
            $table->string('FileID');
            $table->string('Path');
            $table->string('FileName');
            $table->string('CachePath');
            $table->string('CachePath1');
            $table->string('CachePath2');
            $table->string('BaseImageURL');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('comparisons');
    }
};
