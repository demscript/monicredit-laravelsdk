<?php

namespace Demscript\Monicredit\Facades;

use Illuminate\Support\Facades\Facade;

class MonicreditFacade extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'monicredit';
    }
}
