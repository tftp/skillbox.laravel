<?php

namespace App\Services;

use GuzzleHttp\Client;

class PushallService
{
    private $id;
    private $key;

    public function __construct($id, $key)
    {
        $this->id = $id;
        $this->key = $key;
    }

    public function send($title, $text)
    {
        $data = [
            'type' => 'self',
            'id' => $this->id,
            'key' => $this->key,
            'title' => $title,
            'text' => $text,
        ];
        $client = new Client([
            'base_uri' => config('pushall.uri'),
            'timeout' => config('pushall.timeout'),
        ]);

        $result = $client->post('', ['form_params' => $data]);

        return $result;
    }
}
