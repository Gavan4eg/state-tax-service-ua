<?php

namespace Gavan4eg\StateTaxServiceUkraine\Facades;

use Illuminate\Support\Facades\Facade;

class StateTaxServiceUkraine extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'statetaxserviceukraine';
    }
}
