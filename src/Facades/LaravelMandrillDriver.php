<?php

namespace BeSmarteeInc\LaravelMandrillDriver\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \BeSmarteeInc\LaravelMandrillDriver\LaravelMandrillDriver
 */
class LaravelMandrillDriver extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \BeSmarteeInc\LaravelMandrillDriver\LaravelMandrillDriver::class;
    }
}
