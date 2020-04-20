<?php

namespace App\Http\Controllers\Admin\Usuarios;

use App\Http\Controllers\Controller;
use App\Http\Requests\Usuarios\Senha;
use App\Http\Requests\Usuarios\Usuario;
use App\Http\Requests\Usuarios\UsuarioUpdate;
use Illuminate\Http\Request;
use Impacto\Usuarios\PerfilRepository;
use Impacto\Usuarios\UsuarioRepository;

class UsuarioController extends Controller {

    protected $usuarioRepository;
    /**
     * @var PerfilRepository
     */
    private $perfilRepository;

    public function __construct(UsuarioRepository $usuarioRepository, PerfilRepository $perfilRepository){
        $this->usuarioRepository = $usuarioRepository;
        $this->perfilRepository = $perfilRepository;
    }

    public function index(Request $request){

        $listagem = $this->usuarioRepository->listagem($request->get('s'));

        return view('admin.usuarios.index')->with(compact('listagem'));

    }

    public function create(){

        $perfis   = $this->perfilRepository->data();

        return view('admin.usuarios.create')->with(compact('perfis'));

    }

    public function store(Usuario $request){

        $input = $request->all();

        $usuario = $this->usuarioRepository->store($input);
        if ($usuario){
            $request->session()->flash('success', 'Registro Cadastrado!');
        }

        return redirect()->intended(route('admin.usuarios.index'));

    }

    public function edit($id){

        $usuario = $this->usuarioRepository->show($id);

        if(!$usuario){
            return redirect()->route('admin.usuarios.index');
        }

        $perfis = $this->perfilRepository->data();

        return view('admin.usuarios.edit')->with(compact('usuario', 'perfis'));

    }

    public function update(UsuarioUpdate $request, $id){

        $input = $request->all();

        $usuario = $this->usuarioRepository->update($id, $input);

        if ($usuario){
            $request->session()->flash('success', 'Registro Atualizado!');
        }

        return redirect()->intended(route('admin.usuarios.index'));

    }

    public function destroy($id){

        $usuario = $this->usuarioRepository->delete($id);

        session()->flash('success', 'Registro Excluído!');

        return response()->json($usuario);


    }

    public function AlterarSenha()
    {

        $usuario = $this->usuarioRepository->show(encrypt(auth()->user()->id));

        return view('admin.usuarios.senha')->with(compact('usuario'));
    }

    public function SenhaUpdate(Senha $request)
    {
        $input = $request->all();

        $usuario = $this->usuarioRepository->updateSenha(encrypt(auth()->user()->id), $input);

        if ($usuario){
            $request->session()->flash('success', 'Senha Alterada!');
        }

        return redirect()->intended(route('admin.dashboard'));

    }

    public function show($id)
    {
        $usuario = $this->usuarioRepository->show($id);

        if(!$usuario){
            return redirect()->route('admin.usuarios.index');
        }

        return view('admin.usuarios.show')->with(compact('usuario'));
    }
}
