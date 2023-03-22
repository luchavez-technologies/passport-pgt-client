<?php

namespace Luchavez\PassportPgtClient\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class PassportPgtClient
 *
 * @author James Carlo Luchavez <jamescarloluchavez@gmail.com>
 *
 * @see \Luchavez\PassportPgtClient\Services\PassportPgtClient
 */
class PassportPgtClient extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'passport-pgt-client';
    }
}
