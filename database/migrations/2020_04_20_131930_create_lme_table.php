<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLmeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lme', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('data')->nullable();
            $table->integer('semana')->nullable();
            $table->string('valor_aluminium')->nullable();
            $table->string('valor_copper')->nullable();
            $table->string('valor_zinc')->nullable();
            $table->string('valor_nickel')->nullable();
            $table->string('valor_lead')->nullable();
            $table->string('valor_tin')->nullable();
            $table->string('valor_aluminium_alloy')->nullable();
            $table->string('valor_nasaac')->nullable();
            $table->string('valor_cobalt')->nullable();
            $table->string('valor_gold')->nullable();
            $table->string('valor_silver')->nullable();
            $table->string('valor_steel_scrap')->nullable();
            $table->string('valor_steel_rebar')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lme');
    }
}
