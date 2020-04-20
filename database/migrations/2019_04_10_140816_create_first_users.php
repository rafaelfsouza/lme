<?php

use Illuminate\Database\Migrations\Migration;
use Impacto\Usuarios\Usuario;

class CreateFirstUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        $usuario = Usuario::create([
            'nome' => 'Rafael Souza',
            'email' => 'rafael@impacto.online',
            'password' => bcrypt('123456'),
            'ativo' => true,
            'perfil_id' => 1
        ]);

        $usuario->update(['id_raw' => decrypt($usuario->id)]);

        $usuario = Usuario::create([
            'nome' => 'Dev Impacto',
            'email' => 'dev@impacto.online',
            'password' => bcrypt('123456'),
            'ativo' => true,
            'perfil_id' => 1
        ]);

        $usuario->update(['id_raw' => decrypt($usuario->id)]);
    }

}
