<?php

namespace Tests\Feature;

use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A Task Index API test.
     *
     * @return void
     */
    public function testTaskIndex()
    {
        // ARRANGE
        $uri = '/api/flows/1/tasks';
        // todo: use Factories to create Tasks to see + clear from DB after test
        $expectedStructure = ['message', 'data'];

        // ACT
        $response = $this->get($uri);

        //ASSERT
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonStructure($expectedStructure);
    }

    /**
     * A Task POST API test
     *
     * @return void
     */
    public function testTaskStore()
    {
        // ARRANGE
        $uri = '/api/flows/1/tasks';
        $data = [
            'title' => 'New Flow API Test',
            'hours' => 1,
            'minutes' => 13,
            'seconds' => 9,
        ];
        $expectedStructure = ['message', 'data'];

        // ACT
        $response = $this->postJson($uri, $data);
        // todo: figure out how to remove the entities from the database post test

        //ASSERT
        $response->assertStatus(Response::HTTP_CREATED);
        $response->assertJsonStructure($expectedStructure);
    }
//    public function testTaskShow()
//    public function testTaskUpdate()
//    public function testTaskDestroy()
}
