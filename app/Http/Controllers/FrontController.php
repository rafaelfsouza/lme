<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Impacto\Lme\LmeRepository;

class FrontController extends Controller
{

    /**
     * @var LmeRepository
     */
    private $lmeRepository;

    public function __construct(LmeRepository $lmeRepository)
    {
        $this->lmeRepository = $lmeRepository;
    }

// leitura lme
//    function lme()
//    {
//        $dom = new \DOMDocument();
//
//        libxml_use_internal_errors(true);
//
//        $lme_html = file_get_contents("https://www.lme.com/");
//
//        $dom->loadHTML($lme_html);
//
//        $tabelas = $dom->getElementsByTagName('table');
//
//        foreach ($tabelas as $book) {
//            $tabela = $book->nodeValue;
//        }
//
//        libxml_clear_errors();
//
//        $tabela = preg_replace('/\s+/', ' ', $tabela);
//        $tabela = str_replace('*', '', $tabela);
//
//        preg_match_all("/(LME (.*?) (\d.+?) )/", $tabela, $matches);
//        $nomes = $matches[2];
//        $valores = $matches[3];
//
//        $data = [];
//
//        $ths = $dom->getElementsByTagName('th');
//        $dia = trim(str_replace('US$:', '', $ths[0]->nodeValue));
//        $dia = Carbon::createFromFormat('d F Y', $dia);
//        $data['data'] = $dia->format('d/m/Y');
//        $data['semana'] = $dia->format('W');
//
//        foreach ($nomes as $chave => $nome) {
//            $nome = strtolower($nome);
//            $nome = str_replace(' ', '_', $nome);
//            $data['valor_'.$nome] = str_replace(',', '', $valores[$chave]);
//        }
//
//        $this->lmeRepository->store($data);
//
//        dd('ok');
//
//    }

// leitura shockmetais
    function lme()
    {
        $dom = new \DOMDocument();

        libxml_use_internal_errors(true);

        $lme_html = file_get_contents("https://shockmetais.com.br/lme");

        $dom->loadHTML($lme_html);

        $dados = [];
        $valores = [];

        switch (date('m')){
            case '01':
                $dia = date('d').'/Jan';
                break;
            case '02':
                $dia = date('d').'/Fev';
                break;
            case '03':
                $dia = date('d').'/Mar';
                break;
            case '04':
                $dia = date('d').'/Abr';
                break;
            case '05':
                $dia = date('d').'/Mai';
                break;
            case '06':
                $dia = date('d').'/Jun';
                break;
            case '07':
                $dia = date('d').'/Jul';
                break;
            case '08':
                $dia = date('d').'/Ago';
                break;
            case '09':
                $dia = date('d').'/Set';
                break;
            case '10':
                $dia = date('d').'/Out';
                break;
            case '11':
                $dia = date('d').'/Nov';
                break;
            case '12':
                $dia = date('d').'/Dez';
                break;
        }

        if(preg_match_all("#<tr[^>]*>(.*?)</tr>#is",$lme_html,$matches)){
            foreach($matches[1] as $linha){
                if(preg_match_all("#<th[^>]*>(.*?)</th>#is",$linha,$mat)){
                    foreach($mat[1] as $col) {
                        $valor = str_replace(' <small>U$/t</small>', '', $col);
                        $valor = str_replace('<small>R$/US$</small>', '', $valor);
                        $dados[] = trim($valor);
                    }
                }
                if(preg_match_all("#<td[^>]*>(.*?)</td>#is",$linha,$mat)){
                    if($mat[1][0] == $dia){
                        foreach($mat[1] as $key => $col) {
                            $valores[$dados[$key]] = $col;
                        }
                    }
                }
            }
        }

        if($valores){

            $metais = [
                "Cobre" => "valor_copper",
                "Zinco" => "valor_zinc",
                "Alumínio" => "valor_aluminium",
                "Chumbo" => "valor_lead",
                "Estanho" => "valor_tin",
                "Níquel" => "valor_nickel",
                "Dólar" => "valor_dolar"
            ];

            $dia = now();
            $data['data'] = $dia->format('d/m/Y');
            $data['semana'] = $dia->format('W');

            foreach($valores as $metal => $valor){
                if(isset($metais[$metal])) {
                    if($metais[$metal] != 'valor_dolar') {
                        $data[$metais[$metal]] = str_replace(',', '', $valor);
                    }else {
                        $data[$metais[$metal]] = str_replace(',', '.', $valor);
                    }
                }
            }

            $this->lmeRepository->store($data);

            dd('ok');

        }

    }

}
