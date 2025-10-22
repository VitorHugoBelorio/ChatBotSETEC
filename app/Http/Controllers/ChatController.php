<?php

namespace App\Http\Controllers;

use App\Services\GeminiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ChatController extends Controller
{
    protected $geminiService;
    protected $apiKey;

    public function __construct(GeminiService $geminiService)
    {
        $this->geminiService = $geminiService;
        $this->apiKey = config('services.gemini.api_key');
    }

    public function index()
    {
        return view('chat.index');
    }

    public function sendMessage(Request $request)
    {
        $userMessage = $request->input('message');
        try {
            $response = $this->geminiService->ask($userMessage);
            return response()->json($response);
        } catch (\Exception $e){
            return response()->json('Erro: ' . $e->getMessage(), 500);
        }
    }

    public function listarModelos()
    {
        $response = Http::get("https://generativelanguage.googleapis.com/v1/models?key=" . $this->apiKey);
        return $response->json();
    }
}