<?php

namespace App\Http\Controllers;

use App\Services\CampeonatoService;
use Illuminate\Http\Request;

class CampeonatoController extends Controller
{
    protected $service;

    public function __construct(CampeonatoService $campeonatoService)
    {
        $this->service = $campeonatoService;
    }

    public function simularCampeonato(Request $request)
    {
        return $this->service->simularCampeonato($request->all());
    }
    
    public function listarHistorico()
    {
        return $this->service->listarHistorico();
    }
}
