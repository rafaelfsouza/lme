<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LmePermissoes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $modulo = Impacto\Usuarios\Modulo::query()->create([
            'modulo' => 'LME',
            'ordem' => 27
        ]);

        Impacto\Usuarios\Acao::query()->create([
            'modulo_id' => $modulo->id,
            'permissao' => 'lme.visualizar',
            'acao' => 'Visualizar',
            'rotas' => 'admin.lme.index admin.lme.show',
            'ordem' => 1
        ]);

        Impacto\Usuarios\Acao::query()->create([
            'modulo_id' => $modulo->id,
            'permissao' => 'lme.inserir',
            'acao' => 'Inserir',
            'rotas' => 'admin.lme.create admin.lme.store',
            'ordem' => 2
        ]);

        Impacto\Usuarios\Acao::query()->create([
            'modulo_id' => $modulo->id,
            'permissao' => 'lme.editar',
            'acao' => 'Editar',
            'rotas' => 'admin.lme.edit admin.lme.update',
            'ordem' => 3
        ]);

        Impacto\Usuarios\Acao::query()->create([
            'modulo_id' => $modulo->id,
            'permissao' => 'lme.excluir',
            'acao' => 'Excluir',
            'rotas' => 'admin.lme.destroy',
            'ordem' => 4
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
