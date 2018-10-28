<?php

namespace App\Models;

use App\Services\CoinHiveAPI;
use App\Services\CoinMarketCapApi;
use Illuminate\Database\Eloquent\Model;

class AppSetting extends Model
{
    public static function updateCurrencies()
    {
        $ethereum = CoinMarketCapApi::getTicker(CoinMarketCapApi::ETHEREUM);
        $monero = CoinMarketCapApi::getTicker(CoinMarketCapApi::MONERO);
        $coinhive = new CoinHiveAPI();
        $payout = $coinhive->getStatsPayout()->payoutPer1MHashes;

        AppSetting::set('ETH_PRICE', $ethereum->quotes->USD->price);
        AppSetting::set('XMR_PRICE', $monero->quotes->USD->price);
        AppSetting::set('COINHIVE_PAYOUT', $payout);
    }

    public static function get($key)
    {
        $setting = AppSetting::where('key', $key)->first();

        return $setting ? $setting->value : null;
    }

    public static function set($key, $value)
    {
        $setting = AppSetting::where('key', $key)->first();

        if (!$setting) {
            $setting = new AppSetting;
            $setting->key = $key;
        }

        $setting->value = $value;
        $setting->save();

        return $setting;
    }
}
