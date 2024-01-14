<?php

namespace App\Http\Controllers;

use App\Models\Time;
use Illuminate\Http\Request;

class TimeController extends Controller
{
    public function getAll()
    {
        try {
            $times = Time::all();

            return response()->json(['times' => $times], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao obter time'], 500);
        }
    }
    
    public function create(Request $request)
    {
        try {
            $user = Time::create($request->all());
            return response()->json(['message' => 'Time inserido com sucesso!', 'data' => $user], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao inserir time'], 500);
        }
        
    }

    public function update(Request $request, int $id)
    {
        try {
            $user = Time::where('id', $id)->update($request->all());
            return response()->json(['message' => 'Time atualizado com sucesso!', 'data' => $user], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao atualizar time'], 500);
        }
        
    }

    public function delete(int $id)
    {
        try {
            Time::where('id', $id)->delete();
            return response()->json(['message' => 'Time excluído com sucesso!'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao excluír time'], 500);
        }
    }
}
