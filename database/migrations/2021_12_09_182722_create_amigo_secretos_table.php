<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAmigoSecretosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('amigo_secretos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('membro_id');
            $table->foreign('membro_id')->references('id')->on('membros')->onDelete('cascade');
            $table->unsignedBigInteger('membroSorteado_id');
            $table->unsignedBigInteger('grupoSorteio_id');
            $table->foreign('grupoSorteio_id')->references('id')->on('grupo_sorteios')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('amigo_secretos');
    }
}