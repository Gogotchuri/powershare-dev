<?php

namespace App\Services;

class CoinMarketCapApi
{
    const API_URL = 'https://api.coinmarketcap.com/v2/';
    const ETHEREUM = 1027;
    const MONERO = 328;

    public static function getTicker($currency)
    {
        return CoinMarketCapApi::get('ticker/' . $currency)->data;
    }

    public static function get($path, $data = [])
    {
        $url = self::API_URL . $path . '?' . http_build_query($data);
        $response = file_get_contents($url);
        return json_decode($response);
    }
}