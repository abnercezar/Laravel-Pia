<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comum_irma', function (Blueprint $table) {
            $table->foreignId('comum_id');
            $table->foreignId('irma_id');

            $table->foreign('comum_id')->references('id')->on('comuns');
            $table->foreign('irma_id')->references('id')->on('irmas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comum_irma');
    }
};
