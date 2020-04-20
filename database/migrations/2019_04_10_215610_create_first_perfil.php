<?php

use Illuminate\Database\Migrations\Migration;
use Impacto\Usuarios\Perfil;

class CreateFirstPerfil extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $perfil = Perfil::create([
            'perfil' => 'Administrador',
            'ativo' => 1
        ]);

        $perfil->update(['id_raw' => decrypt($perfil->id)]);

    }
}
