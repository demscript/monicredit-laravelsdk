<?php

namespace Demscript\Monicredit\helpers;

use Illuminate\Support\Facades\Config;
use Demscript\Monicredit\Action;

class Helper
{

    protected $url;

    public function __construct()
    {
        $this->url = 'https://live.backend.monicredit.com/api/v1';
    }

    protected function generateReference(int $len): string
    {
        $hex = md5(Config::get('monicredit.monicredit_secret_key') . uniqid("", true));
        $pack = pack('H*', $hex);
        $tmp =  base64_encode($pack);
        $uid = preg_replace("#(*UTF8)[^A-Za-z0-9]#", "", $tmp);
        $len = max(4, min(128, $len));

        while (strlen($uid) < $len)
            $uid .= $this->generateReference(22);

        return substr($uid, 0, $len);
    }

    protected function  urlWrapper(string $type, string $path = ''): string
    {
        $label = "";

        switch ($type) {
            case Action::INIT_TRANSACTION:
                $label = "/payment/transactions/init-transaction";
                break;
            case Action::CONFIRM_TRANSACTION:
                $label = "/payment/transactions/verify-transaction";
                break;
            case Action::CONFIRM_PAYMENT:
                $label = "/payment/transactions/verify-payment";
                break;
            case Action::GET_BANK_LIST:
                $label = "/banking/bank-list";
                break;
            case Action::GET_NAME_ENQUIRY:
                $label = "/banking/wallet/name/enquiry";
                break;
            case Action::GET_ACCEPTED_COINS:
                $label = "/coins";
                break;
            case Action::TRANSFER_FUNDS:
                $label = "/transfer";
                break;
            case Action::PAYMENT_LINK:
                $label = "/payment-links";
                break;
            case Action::SWAP_CRYPTO:
                $label = "/swap/crypto";
                break;
            case Action::GET_CRYPTO_AMOUNT:
                $label = "/swap/crypto/amount-out";
                break;
        };

        if ($path !== '') {
            return $this->url . $label . "/" . $path;
        }

        return $this->url . $label;
    }
}
