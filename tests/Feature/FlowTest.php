<?php

namespace Tests\Feature;

use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FlowTest extends TestCase
{
    use RefreshDatabase;

    // todo: create a separate test database with seeded data to test full features

    /**
     * A Flow GET API test
     *
     * @return void
     */
    public function testFlowIndex()
    {
        // ARRANGE
        $uri = '/api/flows';
        // todo: use Factories to create Tasks to see + clear from DB after test
        $expectedStructure = ['message', 'data'];

        // ACT
        $response = $this->get($uri);

        //ASSERT
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonStructure($expectedStructure);
    }

    /**
     * A Flow POST API test
     *
     * @return void
     */
    public function testFlowStore()
    {
        // ARRANGE
        $uri = '/api/flows';
        $data = [
            'title' => 'New Flow API Test',
        ];
        $expectedStructure = ['message', 'data'];

        // ACT
        $response = $this->postJson($uri, $data);
        // todo: figure out how to remove the entities from the database post test

        //ASSERT
        $response->assertStatus(Response::HTTP_CREATED);
        $response->assertJsonStructure($expectedStructure);
    }

//    public function testFlowShow()
//    public function testFlowUpdate()
//    public function testFlowDestroy()

}
