<?php

namespace Tests\Unit;

use App\Http\Controllers\Admin\PropertyController;
use App\Models\Property;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\TestCase;

class ControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     */
    public function test_redirect_to_route(): void
    {
        $property = Property::factory()
            ->create();
        $propertyController = new PropertyController();
        $this->assertTrue($propertyController->destroy($property->id));
    }
}
