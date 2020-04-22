<?php

namespace Tests\Feature;

use App\Task;
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
        $tasks = factory(Task::class, 3)->create();
        $uri = '/api/flows/1/tasks';
        $expectedStructure = ['message', 'data'];

        // ACT
        $response = $this->get($uri);
        $json = $response->json();

        //ASSERT
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonStructure($expectedStructure);
        $this->assertCount(\count($tasks), $json['data']);
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
        $expectedStructure = [
            'message',
            'data' => [
                'id',
                'created_at',
                'updated_at',
                'title',
            ],
        ];

        // ACT
        $response = $this->postJson($uri, $data);
        $json = $response->json();

        //ASSERT
        $response->assertStatus(Response::HTTP_CREATED);
        $response->assertJsonStructure($expectedStructure);
        $this->assertEquals(
            $data['title'],
            $json['data']['title']
        );
    }
//    public function testTaskShow()
//    public function testTaskUpdate()
//    public function testTaskDestroy()
}
