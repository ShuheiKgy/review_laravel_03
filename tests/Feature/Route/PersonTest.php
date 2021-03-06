<?php

namespace Tests\Feature\Route;

use Mockery;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PersonTest extends TestCase
{

    protected $personMock;

    public function setUp()
    {
        parent::setUp();
        $this->personMock = Mockery::mock('App\Models\Person');
    }

    public function tearDown()
    {
        parent::tearDown();
        Mockery::close();
    }

    public function testPersonList()
    {
        $response = $this->json('GET', 'api/person');
        $response->assertStatus(200);
    }

    public function testPersonStore()
    {
        $response = $this->json(
            'POST',
            'api/person',
            [
                'name' => 'Johnny',
                'weight' => '60',
                'height' => '172.6',
            ]
        );
        $response->assertStatus(200);
    }

    public function testPersonView()
    {
        $response = $this->json('GET', 'api/person/1');
        $response->assertStatus(200);
    }

    public function testPersonUpdate()
    {
        $response = $this->json('POST', 'api/person/1', ['name' => 'Johnson']);
        $response->assertStatus(200);
    }

    public function testPersonDelete()
    {
        $response = $this->json('DELETE', 'api/person/1');
        $response->assertStatus(200);
    }

}
