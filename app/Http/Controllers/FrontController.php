<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
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

    public function index(Request $request, $metal){

        switch ($metal){
            case 'cobre': $metal = 'valor_copper'; break;
            case 'zinco': $metal = 'valor_zinc'; break;
            case 'aluminio': $metal = 'valor_aluminium'; break;
            case 'chumbo': $metal = 'valor_lead'; break;
            case 'estanho': $metal = 'valor_tin'; break;
            case 'niquel': $metal = 'valor_nickel'; break;
            case 'dolar': $metal = 'valor_dolar'; break;
        }

        if(isset($request->periodo)){
            $data = explode('-', $request->periodo);
            $mes = $data[0];
            $ano = $data[1];
        }else{
            $mes = date('m');
            $ano = date('Y');
        }

        if($request->indicador == 'metal'){
            $listagem = $this->lmeRepository->indicadoresMetal($metal, $mes, $ano);
            $indicadoresMetal = [];

            foreach($listagem as $row){
                if($row->valor != 'feriado') {
                    $indicadoresMetal[$row->data] = $row->valor;
                }
            }

            return $indicadoresMetal;

        }else{
            $indicadores = $this->lmeRepository->indicadores($mes, $ano);

            return $indicadores;

        }

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
                    if(strlen($mat[1][0]) == 6 && Str::contains($mat[1][0], '/')) {
                        $registro = $this->lmeRepository->showByDate($mat[1][0]);

                        unset($valores);

                        if (!$registro) {
                            foreach ($mat[1] as $key => $col) {
                                $valores[$dados[$key]] = $col;
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

                                $dataArray = explode('/', $mat[1][0]);

                                if(isset($dataArray[1])) {
                                    $mes = $this->lmeRepository->mes($dataArray[1]);
                                    if($mes) {
                                        $data2 = date('Y') . '-' . $mes . '-' . $dataArray[0];
                                        $dia = Carbon::createFromFormat('Y-M-d', $data2);
                                    }
                                } else {
                                    continue;
                                }

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

                            }

                        }
                    }
                }
            }
        }

        dd('ok');

    }

}
