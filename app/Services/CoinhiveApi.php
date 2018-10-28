<?php

namespace App\Services;

class CoinHiveAPI
{

    const API_URL = 'https://api.coinhive.com';

    private $secret;

    public function __construct()
    {
        $this->secret = env('COINHIVE_SECRET');

        if (strlen($this->secret) !== 32) {
            throw new \Exception('CoinHive - Invalid Secret');
        }
    }

    function getUserList($count = 4096, $page = 0)
    {
        return $this->get('/user/list', [
            'count' => $count,
            'page' => $page,
        ])->users;
    }

    function get($path, $data = [])
    {

        $data['secret'] = $this->secret;
        $url = self::API_URL . $path . '?' . http_build_query($data);
        $response = file_get_contents($url);
        return json_decode($response);
    }

    function post($path, $data = [])
    {
        $data['secret'] = $this->secret;
        $context = stream_context_create([
            'http' => [
                'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                'method' => 'POST',
                'content' => http_build_query($data)
            ]
        ]);
        $url = self::API_URL . $path;
        $response = file_get_contents($url, false, $context);
        return json_decode($response);
    }
}