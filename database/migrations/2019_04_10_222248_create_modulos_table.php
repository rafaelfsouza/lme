<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Impacto\Usuarios\Modulo;

class CreateModulosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios_modulos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('modulo');
            $table->integer('ordem');
            $table->softDeletes();
            $table->timestamps();
        });

        Modulo::create([
            'modulo' => 'Usuários',
            'ordem' => 1
        ]);

        Modulo::create([
            'modulo' => 'Perfis de Acesso',
            'ordem' => 2
        ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuarios_modulos');
    }
}
