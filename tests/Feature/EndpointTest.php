<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\User;
use App\Storage;
use App\Component;

class EndpointTest extends TestCase
{
    use RefreshDatabase;

    public function testRedirect()
    {
        $response = $this->get('/');

        $response->assertStatus(302);
    }

    public function testComponentsIndex()
    {
        parent::setUp();

        $user = factory(User::class)->create();

        $storage = factory(Storage::class)->create();

        $component = factory(Component::class)->create([
            'storage_id' => $storage->id,
        ]);

        $response = $this->actingAs($user)
                          ->get('/components');

        $response->assertStatus(200);
        $response->assertSeeText($component->name);
        $response->assertSeeText($component->category);
        $response->assertSeeText($component->stock);
    }
}
