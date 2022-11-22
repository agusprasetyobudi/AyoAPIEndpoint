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
        Schema::create('team_people', function (Blueprint $table) {
            $table->id();
            $table->foreignId('team_id');
            $table->string('person_name');
            $table->integer('tinggi');
            $table->integer('berat');
            $table->enum('posisi',['penyerang','gelandang','bertahan','penjaga_gawang']);
            $table->integer('nomor_punggung');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('team_id')->references('id')->on('teams');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('team_people');
    }
};
