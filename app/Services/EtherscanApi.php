<?php

namespace App\Services;

class EtherscanApi
{
    const API_URL = 'https://api.etherscan.io/api';

    public static function getAddressTransactions($address)
    {
        return EtherscanApi::get([
            'module' => 'account',
            'action' => 'txlist',
            'address' => $address,
            'startblock' => 0,
            'endblock' => 99999999,
            'sort' => 'asc',
        ])->result;
    }

    public static function get($data = [])
    {
        $data['apikey'] = env('ETHERSCAN_TOKEN');
        $url = self::API_URL . '?' . http_build_query($data);
        $response = file_get_contents($url);
        return json_decode($response);
    }
}