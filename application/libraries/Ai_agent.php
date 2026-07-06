<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Ai_agent
{
    private $api_key = 'YOUR_LLM7_API_KEY_HERE';
    private $base_url = 'https://api.llm7.io/v1';
    private $model = 'default';
    public function get_response($prompt)
    {
        if (empty($prompt)) {
            return "Prompt tidak boleh kosong.";
        }
        $url = $this->base_url . "/chat/completions";
        $payload = [
            'model' => $this->model,
            'messages' => [
                [
                    'role' => 'user',
                    'content' => $prompt

                ]
            ],
            'temperature' => 0.7,
            'max_tokens' => 1000,
            'stream' => false
        ];
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Authorization: Bearer ' . $this->api_key
        ]);

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        $error = curl_error($ch);
        curl_close($ch);
        if ($error) {
            return "CURL Error: " . $error;
        }
        $result = json_decode($response, true);
        if (isset($result['choices'][0]['message']['content'])) {
            return $result['choices'][0]['message']['content'];
        } elseif (isset($result['error']['message'])) {
            return "API Error: " . $result['error']['message'];
        }
        return "Terjadi kesalahan tidak diketahui: " . $response;
    }
}