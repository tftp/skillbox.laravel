<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class PushallService
{
    private $id;
    private $key;
    private  $uri;

    public function __construct($uri, $id, $key)
    {
        $this->id = $id;
        $this->key = $key;
        $this->uri = $uri;
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

        $result = Http::asForm()->post($this->uri, $data);

        return $result;
    }
}
