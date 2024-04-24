<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Property;
use Tests\TestCase;

class PropertyTest extends TestCase
{
    use RefreshDatabase;




    public function test_get_index()
    {
        $response = $this->get('/');
        $response->assertOk();
    }

    public function test_ok_on_contact(): void
    {
        $property = Property::factory()
            ->create();

        $response = $this->post("properties/{$property->id}/contact", [
            'name' => 'John',
            'surname' => 'Doe',
            'email' => 'fr',
            'phone' => '555555',
            'message' => 'Message me now !'
        ]);

        $response->assertRedirect();
        $response->assertSessionHasErrors('email');
        $response->assertSessionHasInput('email');
    }

    public function test_a_view_is_rendered(): void
    {
        $property = Property::factory()
            ->create();
        $view = $this->view("property.show", [
            "property" => $property,
            "errors" => null

        ]);
        $view->assertSee("Taylor");
    }
}
