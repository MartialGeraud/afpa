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
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->string('sujet');
            $table->string('image');
            $table->text('contenu');
            $table->date('date_debut');
            $table->date('date_fin');
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedBigInteger('visibilite_id');
            $table->unsignedBigInteger('etat_id');

            $table->foreign('visibilite_id')->references('id')->on('visibilites')->onDelete('cascade');
            $table->foreign('etat_id')->references('id')->on('etats')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('news');
    }
};
