<?php

namespace App\Http\Controllers\Admin\Lme;

use App\Http\Controllers\Controller;
use App\Http\Requests\Lme\Lme;
use Illuminate\Http\Request;
use Impacto\Lme\LmeRepository;

class LmeController extends Controller {

    protected $lmeRepository;

    public function __construct(LmeRepository $lmeRepository){
        $this->lmeRepository = $lmeRepository;
    }

    public function index(Request $request){

        $listagem = $this->lmeRepository->listagem($request->get('s'));

        return view('admin.lme.index')->with(compact('listagem'));

    }

    public function create(){
        return view('admin.lme.create');
    }

    public function store(Lme $request){

        $input = $request->all();

        $lme = $this->lmeRepository->store($input);
        if ($lme){
            $request->session()->flash('success', 'Registro Cadastrado!');
        }

        return redirect()->intended(route('admin.lme.index'));

    }

    public function edit($id){

        $lme = $this->lmeRepository->show($id);

        if(!$lme){
            return redirect()->route('admin.lme.index');
        }

        return view('admin.lme.edit')->with(compact('lme'));

    }

    public function update(Lme $request, $id){

        $input = $request->all();

        $lme = $this->lmeRepository->update($id, $input);

        if ($lme){
            $request->session()->flash('success', 'Registro Atualizado!');
        }

        return redirect()->intended(route('admin.lme.index'));

    }

    public function destroy($id){

        $lme = $this->lmeRepository->delete($id);

        session()->flash('success', 'Registro Excluído!');

        return response()->json($lme);

    }

}
