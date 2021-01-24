<?php

namespace Nikservik\Commons\Settings;

use Illuminate\Support\Facades\Facade;

class Settings extends Facade 
{
    protected static function getFacadeAccessor() 
    { 
        return 'commons.settings'; 
    }
}