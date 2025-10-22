<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class GeminiService{
    protected $apiKey;
    protected $endpoint;
    protected $systemPrompt;
    protected $temperature;

    public function __construct(){
        $this->apiKey = config('services.gemini.api_key');
        $this->endpoint = config('services.gemini.url');
        $this->temperature = 0.7;

        $this->systemPrompt = "Você é um assistente de estudos voltado para alunos da área de tecnologia, com foco em:
            - Programação
            - Banco de Dados
            - Redes de Computadores
            - Engenharia de Software
            - Desenvolvimento Web

        Seu papel é gerar conteúdos educativos e técnicos de forma clara, organizada e didática.  
        Siga sempre o formato abaixo nas respostas:

        1. **Explicação resumida (até 5 linhas)**  
        Apresente uma explicação direta e fácil de entender sobre o tema solicitado.

        2. **Questões de estudo (3 a 5 perguntas)**  
        Crie perguntas mistas — algumas de múltipla escolha, outras dissertativas — que ajudem o estudante a refletir e fixar o conteúdo.

        3. **Exemplo prático (quando aplicável)**  
        Mostre uma aplicação prática ou um trecho de código simples que demonstre o conceito em uso.

        4. **Dica de estudo**  
        Dê uma dica rápida para memorizar, revisar ou relacionar o tema a situações reais da área de TI.

        O tom das respostas deve ser educacional, motivador e técnico, como o de um tutor universitário que ajuda alunos a entenderem os fundamentos da computação.";}

        public function ask(string $prompt){
            $response = Http::withHeaders 
            ([
                'Content-Type' => 'aplication/json'
            ])->post($this->endpoint . "?key=" . $this->apiKey,
            [
                "contents" => [
                    [
                        "parts" => [
                            ["text" => $this->systemPrompt],
                            ["text" => $prompt]
                        ]
                    ]
                ],
                "generationConfig" => [
                    "temperature" => $this->temperature
                ]
            ]);

            if($response->successful()){
                return $response->json('candidates.0.content.parts.0.text');
            }

            return "Erro: " . $response->body();
        }

}