<?php

namespace App\Http\Controllers;

use App\Models\RecursoModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use OpenAI;
class RecursoController extends Controller
{
    
    public function index(){
        return view('bandeja.ADMIN.chat');
    }
    
    public function buscarRecurso(Request $request) {
        
        $descripcion = $request->input('descripcion_recurso');
       

        // Hacer una solicitud a la API de OpenAI
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('OPENAI_SECRET_KEY'),
        ])->post('https://api.openai.com/v1/engines/davinci/completions', [
            'prompt' => "$descripcion,",
            'max_tokens' => 50,
        ]);

        $responseData = $response->json();
        dd($responseData);
        $respuestaChatGPT = $responseData['choices'][0]['text'];
        
        // Realizar la búsqueda en la base de datos utilizando la descripción proporcionada
        $resultados = RecursoModel::where('Descripcion_Recurso', 'like', "%$descripcion%")->get();

        return view('resultados-busqueda', [
            'descripcion' => $descripcion,
            'resultados' => $resultados,
            'respuestaChatGPT' => $respuestaChatGPT,
        ]);
    }

}
