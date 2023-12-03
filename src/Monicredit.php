<?php

namespace Demscript\Monicredit;

use Illuminate\Http\Client\RequestException;
use Demscript\Monicredit\helpers\Helper;

class Monicredit extends Helper
{
    /**
     * @throws RequestException
     */
    public function initializePayment(array $data): mixed
    {
        $result = (new helpers\MonicreditAPI)->url()->post($this->urlWrapper(Action::INIT_TRANSACTION), array_merge($data, [
            'reference' => $this->generateReference(12)
        ]))->throw();

        return json_decode($result);
    }

    public function verifyTransaction(array $data): mixed
    {
        $result = (new helpers\MonicreditAPI)->url()->get($this->urlWrapper(Action::CONFIRM_TRANSACTION), $data)->throw();

        return json_decode($result);
    }

    public function verifyPayment(array $data): mixed
    {
        $result = (new helpers\MonicreditAPI)->url()->get($this->urlWrapper(Action::CONFIRM_PAYMENT), $data)->throw();

        return json_decode($result);
    }

    /**
     * @throws RequestException
     */
    public function getBankList(): mixed
    {
        $result = (new helpers\MonicreditAPI)->url()->get($this->urlWrapper(Action::GET_BANK_LIST))->throw();

        return json_decode($result);
    }

    /**
     * @throws RequestException
     */
    public function getNameEnquiry($data): mixed
    {
        $result = (new helpers\MonicreditAPI)->url()->get($this->urlWrapper(Action::GET_NAME_ENQUIRY), $data)->throw();

        return json_decode($result);
    }

    /**
     * @throws RequestException
     */
    // public function generatePaymentLink(array $data): mixed
    // {
    //     $result = (new helpers\MonicreditAPI)->url()->post($this->urlWrapper(Action::PAYMENT_LINK), $data)->throw();

    //     return json_decode($result);
    // }

    /**
     * @throws RequestException
     */
    // public function getSinglePaymentLink(string $identifier): mixed
    // {
    //     $result = (new helpers\MonicreditAPI)->url()->get($this->urlWrapper(Action::PAYMENT_LINK, $identifier))->throw();

    //     return json_decode($result);
    // }
}
