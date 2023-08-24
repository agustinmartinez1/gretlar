<?php

namespace App\Http\Controllers;

use App\Models\RecursoModel;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class ChatController extends Controller
{
    
    public function index()
    {
       
    }

    public function getResponse(Request $request)
    {
        $query = $request->input('q');
        $results = [];

        if ($query) {
            $results = RecursoModel::where('Descripcion_Recurso', 'LIKE', "%$query%")->get();
        }

        $response = '';

        $query = $results;

        $client = new Client();
        $apiKey = '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';

        $response = $client->post('https://api.openai.com/v1/engines/davinci-codex/completions', [
            'headers' => [
                'Authorization' => 'Bearer ' . $apiKey,
            ],
            'json' => [
                'prompt' => $query,
                'max_tokens' => 50,
            ],
        ]);

        $responseBody = json_decode($response->getBody(), true);
        $responseText = $responseBody['choices'][0]['text'];

        return view('bandeja.ADMIN.chat', [
            'query' => $query,
            'response' => $responseText,
        ]);
    }
}
