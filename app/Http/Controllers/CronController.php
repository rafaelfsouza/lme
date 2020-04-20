<?php

namespace App\Http\Controllers;

use App\Mail\TarefaVencimento;
use Illuminate\Support\Facades\Mail;
use Impacto\Notificacoes\NotificacaoRepository;
use Impacto\Tarefas\TarefaRepository;

class CronController extends Controller
{

    /**
     * @var TarefaRepository
     */
    private $tarefaRepository;
    /**
     * @var NotificacaoRepository
     */
    private $notificacaoRepository;

    public function __construct(TarefaRepository $tarefaRepository, NotificacaoRepository $notificacaoRepository)
    {
        $this->tarefaRepository = $tarefaRepository;
        $this->notificacaoRepository = $notificacaoRepository;
    }

    public function notificarVencimento()
    {

        $tarefas = $this->tarefaRepository->notificarVencimento();

        foreach ($tarefas as $tarefa) {
            $data['sindico_id'] = $tarefa->sindico_id;
            $data['tarefa_id'] = $tarefa->id_raw;
            $data['arquivar'] = 0;

            $this->notificacaoRepository->store($data);

            $tarefa->update(['alarme_status' => 1]);

        }

    }

    public function notificarEmail()
    {

        $notificacoes = $this->notificacaoRepository->notificarEmail();

        foreach($notificacoes as $notificacao){

            try {
                Mail::to($notificacao->sindico->email)->send(new TarefaVencimento($notificacao->tarefa));
                $notificacao->update(['data_envio' => now()]);
            } catch (Exception $e) {
                continue;
            }


        }

    }

}
