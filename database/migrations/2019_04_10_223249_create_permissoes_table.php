<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Impacto\Usuarios\Permissao;

class CreatePermissoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios_perfis_permissoes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('perfil_id');
            $table->integer('acao_id');
            $table->timestamps();
        });

        $i = 1;
        while($i <= 8){

            Permissao::create([
               'perfil_id' => 1,
               'acao_id' => $i
            ]);

            $i++;
        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuarios_perfis_permissoes');
    }
}
