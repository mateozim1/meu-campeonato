<?php
namespace App\Services;

use App\Models\Campeonato;
use App\Models\Time;

class CampeonatoService
{
    protected $model;

    public function __construct(Campeonato $campeonatoModel)
    {
        $this->model = $campeonatoModel;
    }

    public function simularCampeonato(array $dados)
    {
        try {
            $resultadoQuartas = $this->simulaQuartas($dados["times"]);
            $resultadoSemi = $this->simulaSemiFinal($resultadoQuartas);
            $resultadoTerceiroEQuarto = $this->simulaTerceiroEQuarto($resultadoSemi["desclassificados"]);
            $resultadoFinal = $this->simulaFinal($resultadoSemi["classificados"]);

            $campeonato = $this->model::create([
                'nome' => $dados["nomeCampeonato"],
                'primeiro' => $resultadoFinal["primeiro"],
                'segundo' => $resultadoFinal["segundo"],
                'terceiro' => $resultadoTerceiroEQuarto["terceiro"],
                'quarto' => $resultadoTerceiroEQuarto["quarto"],
            ]);

            return response()->json(['message' => 'Campeonato criado com sucesso!', 'data' => $campeonato], 200);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao criar campeonato!'], 500);
        }
    }

    private function gerarDuplas($times)
    {
        shuffle($times);
        $duplas = array();

        for ($i = 0; $i < count($times); $i += 2) {
            $dupla = array($times[$i], $times[$i + 1]);
            $duplas[] = $dupla;
        }
    
        return $duplas;
    }

    private function gerarPlacar()
    {
        $pythonScriptPath = realpath(dirname(dirname(__FILE__))) . '\Scripts\teste.py';
        $retorno = [];

        exec("python $pythonScriptPath", $retorno);
        return $retorno;
    }

    private function simulaQuartas($times)
    {
        $duplas = $this->gerarDuplas($times);

        for ($contador = 0; $contador < count($duplas); $contador++) {
            $placar = $this->gerarPlacar();
            $time1 = Time::find($duplas[$contador][0]);
            $time2 = Time::find($duplas[$contador][1]);

            $time1->pontos += $placar[0];
            $time2->pontos += $placar[1];

            $time1->pontos -= $placar[1];
            $time2->pontos -= $placar[0];

            $time1->pontos = max(0, $time1->pontos);
            $time2->pontos = max(0, $time2->pontos);

            if ($placar[0] > $placar[1]) {
                $time1->classifica = "S";
                $time2->classifica = "N";
            } elseif ($placar[0] < $placar[1]) {
                $time1->classifica = "N";
                $time2->classifica = "S";
            } else {
                if ($time1->created_at < $time2->created_at) {
                    $time1->classifica = "S";
                    $time2->classifica = "N";
                } else {
                    $time1->classifica = "N";
                    $time2->classifica = "S";
                }
            }

            $time1->save();
            $time2->save();
        }

        $timesClassificados = Time::where('classifica', 'S')->select('id')->get()->pluck('id')->toArray();

        return $timesClassificados;
    }

    private function simulaSemiFinal($times)
    {
        $duplas = $this->gerarDuplas($times);

        for ($contador = 0; $contador < count($duplas); $contador++) {
            $placar = $this->gerarPlacar();
            $time1 = Time::find($duplas[$contador][0]);
            $time2 = Time::find($duplas[$contador][1]);

            $time1->pontos += $placar[0];
            $time2->pontos += $placar[1];

            $time1->pontos -= $placar[1];
            $time2->pontos -= $placar[0];

            $time1->pontos = max(0, $time1->pontos);
            $time2->pontos = max(0, $time2->pontos);
            
            if ($placar[0] > $placar[1]) {
                $time1->classifica = "S";
                $time2->classifica = "N";
            } elseif ($placar[0] < $placar[1]) {
                $time1->classifica = "N";
                $time2->classifica = "S";
            } else {
                if ($time1->pontos > $time2->pontos) {
                    $time1->classifica = "S";
                    $time2->classifica = "N";
                } elseif ($time1->pontos < $time2->pontos) {
                    $time1->classifica = "N";
                    $time2->classifica = "S";
                } else {
                    if ($time1->created_at < $time2->created_at) {
                        $time1->classifica = "S";
                        $time2->classifica = "N";
                    } else {
                        $time1->classifica = "N";
                        $time2->classifica = "S";
                    }
                }
            }

            $time1->save();
            $time2->save();
        }
        die;
        $timesClassificados = Time::where('classifica', 'S')->select('id')->get()->pluck('id')->toArray();
        $timesDesclassificados = array_diff($times, $timesClassificados);

        $time["classificados"] = $timesClassificados;
        $time["desclassificados"] = $timesDesclassificados;

        return $time;
    }

    private function simulaFinal($times)
    {
        $retorno = [];
        $placar = $this->gerarPlacar();
        $time1 = Time::find($times[0]);
        $time2 = Time::find($times[1]);
        
        if ($placar[0] > $placar[1]) {
            $time1->classifica = "S";
            $time2->classifica = "N";

            $retorno["primeiro"] = $time1->id;
            $retorno["segundo"] = $time2->id;
        } else {
            $time1->classifica = "N";
            $time2->classifica = "S";

            $retorno["primeiro"] = $time2->id;
            $retorno["segundo"] = $time1->id;
        }

        $time1->pontos = $placar[0];
        $time2->pontos = $placar[1];

        $time1->save();
        $time2->save();

        return $retorno;
    }

    private function simulaTerceiroEQuarto($times)
    {
        $retorno = [];
        $placar = $this->gerarPlacar();

        $time1 = Time::find(reset($times));
        $time2 = Time::find(next($times));

        if ($placar[0] > $placar[1]) {
            $retorno["terceiro"] = $time1->id;
            $retorno["quarto"] = $time2->id;
        } else {
            $retorno["terceiro"] = $time2->id;
            $retorno["quarto"] = $time1->id;
        }

        // $time1->pontos = $placar[0];
        // $time2->pontos = $placar[1];

        // $time1->save();
        // $time2->save();

        return $retorno;
    }

    public function listarHistorico()
    {
        return $this->model::orderByDesc('id')->get();
    }
}
