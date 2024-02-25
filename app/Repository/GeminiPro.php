<?php

namespace App\Repository;

class GeminiPro
{
    public string $question;

    public function __construct($question)
    {
        $this->question = $question;
    }

    public function generateResponse()
    {
        // URL tujuan
        $url = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-pro:generateContent?key=' . env('GEMINI_API_KEY');

        // Data yang ingin dikirimkan (dalam format JSON)
        $data = array(
            "contents" => array(
                array(
                    "parts" => array(
                        array(
                            "text" => $this->question
                        )
                    )
                )
            )
        );

        // Konversi data ke format JSON
        $json_data = json_encode($data);

        // Konfigurasi curl
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($json_data)
            )
        );

        // Eksekusi curl dan tangani respons
        $response = curl_exec($ch);
        if ($response === FALSE) {
            return false;
        } else {
            // Tampilkan respons
            return json_decode($response);
        }
    }
}