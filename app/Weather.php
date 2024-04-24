<?php

namespace App;

use Illuminate\Support\Facades\Cache;

class Weather
{
    public function isSunnyTomorrow(): bool
    {
        $result = Cache::get('weather');

        if ($result) {
            return $result;
        }

        //
        return false;
    }
}
