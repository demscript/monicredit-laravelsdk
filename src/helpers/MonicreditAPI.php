<?php

namespace Demscript\Monicredit\helpers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Config;

class MonicreditAPI
{
    public static function url()
    {
        $publicKey = Config::get('monicredit.key');
        $secretKey = Config::get('monicredit.secret');

        return Http::retry(3, 100)->withToken($secretKey)->withHeaders([
            'mcpublickey' => $publicKey,
            'mcprivatekey' => $secretKey,
        ]);
    }
}
