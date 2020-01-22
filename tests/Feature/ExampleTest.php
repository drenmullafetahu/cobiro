<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $response = $this->get('/api/menus/1');

        $response->assertStatus(200);
    }

    public function test_menu_store(){

        $response = $this->json('POST', '/menus', ['name' => 'Home 1','max_depth'=>'3','max_children'=> '2']);

        $response
            ->assertStatus(201)
            ->assertJson([
                'created' => true,
            ]);

    }

    public function test_menu_put(){

        $response = $this->json('PUT', '/menus/1', ['name' => 'Home 2','max_depth'=>'4','max_children'=> '3']);

        $response
            ->assertStatus(201)
            ->assertJson([
                'created' => true,
            ]);
    }

    public function test_menu_patch(){

        $response = $this->json('Patch', '/menus/1', ['name' => 'Home 3','max_depth'=>'5','max_children'=> '4']);

        $response
            ->assertStatus(201)
            ->assertJson([
                'created' => true,
            ]);
    }

    public function test_menu_items_get()
    {
        $response = $this->get('/menus/1/items');

        $response->assertStatus(200);
    }


    public function test_menu_layers()
    {
        $response = $this->get('/menus/1/layers/1');

        $response->assertStatus(200);
    }


    public function test_menu_depth()
    {
        $response = $this->get('/menus/1/depth');

        $response->assertStatus(200);
    }

    public function test_item_get()
    {
        $response = $this->get('/items/1');

        $response->assertStatus(200);
    }

    public function test_item_children_get()
    {
        $response = $this->get('/items/1/children');

        $response->assertStatus(200);
    }


}
