<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Impacto\Usuarios\Acao;

class CreateAcoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios_modulos_acoes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('modulo_id');
            $table->string('permissao');
            $table->string('acao');
            $table->string('rotas');
            $table->integer('ordem');
            $table->timestamps();
            $table->softDeletes();
        });

        Acao::create([
            'modulo_id' => 1,
            'permissao' => 'usuarios.visualizar',
            'acao' => 'Visualizar',
            'rotas' => 'admin.usuarios.index admin.usuarios.show',
            'ordem' => 1
        ]);

        Acao::create([
            'modulo_id' => 1,
            'permissao' => 'usuarios.inserir',
            'acao' => 'Inserir',
            'rotas' => 'admin.usuarios.create admin.usuarios.store',
            'ordem' => 2
        ]);

        Acao::create([
            'modulo_id' => 1,
            'permissao' => 'usuarios.editar',
            'acao' => 'Editar',
            'rotas' => 'admin.usuarios.edit admin.usuarios.update',
            'ordem' => 3
        ]);

        Acao::create([
            'modulo_id' => 1,
            'permissao' => 'usuarios.excluir',
            'acao' => 'Excluir',
            'rotas' => 'admin.usuarios.destroy',
            'ordem' => 4
        ]);

        Acao::create([
            'modulo_id' => 2,
            'permissao' => 'perfis.visualizar',
            'acao' => 'Visualizar',
            'rotas' => 'admin.perfis.index admin.perfis.show',
            'ordem' => 1
        ]);

        Acao::create([
            'modulo_id' => 2,
            'permissao' => 'perfis.inserir',
            'acao' => 'Inserir',
            'rotas' => 'admin.perfis.create admin.perfis.store',
            'ordem' => 2
        ]);

        Acao::create([
            'modulo_id' => 2,
            'permissao' => 'perfis.editar',
            'acao' => 'Editar',
            'rotas' => 'admin.perfis.edit admin.perfis.update',
            'ordem' => 3
        ]);

        Acao::create([
            'modulo_id' => 2,
            'permissao' => 'perfis.excluir',
            'acao' => 'Excluir',
            'rotas' => 'admin.perfis.destroy',
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
        Schema::dropIfExists('usuarios_modulos_acoes');
    }
}
