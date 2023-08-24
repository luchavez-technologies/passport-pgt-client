<?php

/**
 * @author James Carlo Luchavez <jamescarloluchavez@gmail.com>
 */

use Luchavez\PassportPgtClient\Services\PassportPgtClient;

if (! function_exists('passportPgtClient')) {
    /**
     * @return PassportPgtClient
     */
    function passportPgtClient(): PassportPgtClient
    {
        return resolve('passport-pgt-client');
    }
}

if (! function_exists('passport_pgt_client')) {
    /**
     * @return PassportPgtClient
     */
    function passport_pgt_client(): PassportPgtClient
    {
        return passportPgtClient();
    }
}
