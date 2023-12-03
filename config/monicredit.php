<?php
/*
 * This file is part of the Monicredit package.
 *
 * (c) Ogegbo Oluwademilade <demscript@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

return [
    /**
     * Public Key From Monicredit developer Dashboard
     *
     */

    'key' => env('MONICREDIT_PUBLIC_KEY', null),

    /**
     * Secret Key From Monicredit developer Dashboard
     *
     */

    'secret' => env('MONICREDIT_SECRET_KEY', null)
];
