<?php

namespace Tests\Unit;

use App\Weather;
use Illuminate\Support\Facades\Cache;
use PHPUnit\Framework\TestCase;

class WeatherTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_return_true(): void
    {
        Cache::shouldReceive('get')
                    ->once()
                    ->with('weather')
                    ->andReturn(false);
        $weather = new Weather();
        $this->assertNotTrue($weather->isSunnyTomorrow());
    }
}
