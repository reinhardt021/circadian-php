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
        // todo: create Flow for tasks to attach to
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
        // todo: create Flow for tasks to attach to
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

    public function testTaskShow()
    {
        // ARRANGE
        // todo: create Flow for tasks to attach to
        $tasks = factory(Task::class, 1)->create();
        $task = $tasks[0];
        $uri = '/api/flows/1/tasks/' . $task->id;
        $expectedStructure = [
            'message',
            'data' => [
                'id',
                'title',
                'created_at',
                'updated_at',
                'deleted_at',
            ],
        ];

        // ACT
        $response = $this->get($uri);
        $json = $response->json();

        //ASSERT
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonStructure($expectedStructure);
        $this->assertEquals($task->id, $json['data']['id']);
    }

    public function testTaskUpdate()
    {
        // ARRANGE
        // todo: create Flow for tasks to attach to
        $tasks = factory(Task::class, 1)->create();
        $task = $tasks[0];
        $uri = '/api/flows/1/tasks/' . $task->id;
        $data = [
            'title' => 'Updated Flow API Test',
            'minutes' => 13,
        ];
        $expectedStructure = [
            'message',
            'data' => [
                'id',
                'title',
                'created_at',
                'updated_at',
                'deleted_at',
            ],
        ];

        // ACT
        $response = $this->put($uri, $data);
        $json = $response->json();

        // ASSERT
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonStructure($expectedStructure);
        $this->assertEquals($task->id, $json['data']['id']);
        $this->assertEquals($data['title'], $json['data']['title']);

        // test that the Task.hours stay the same
        $this->assertEquals($task->hours, $json['data']['hours']);
        $this->assertEquals($data['minutes'], $json['data']['minutes']);

        // test that the Task.seconds stay the same
        $this->assertEquals($task->seconds, $json['data']['seconds']);
    }

    public function testTaskDestroy()
    {
        // todo
    }
}
