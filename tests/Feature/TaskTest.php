<?php

namespace Tests\Feature;

use App\Flow;
use App\Task;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    private array $expectedTaskStructure = [
        'id',
        'title',
        'hours',
        'minutes',
        'seconds',
        'created_at',
        'updated_at',
        'flow_id',
    ];

    /**
     * A Task Index API test.
     *
     * @return void
     */
    public function testTaskIndex()
    {
        // ARRANGE
        $tasks = \factory(Task::class, 3)->create();

        /** @var Flow $flow */
        $flow = \factory(Flow::class)->create();
        $flow->tasks()->saveMany($tasks);
        $uri = "/api/flows/{$flow->id}/tasks";
        $expectedStructure = [
            'message',
            'data' => [
                '*' => $this->expectedTaskStructure,
            ],
        ];

        // ACT
        $response = $this->get($uri);
        $json = $response->json();

        //ASSERT
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonStructure($expectedStructure);
        $this->assertCount(\count($tasks), $json['data']);
        foreach ($json['data'] as $task)
        {
            $this->assertEquals($flow->id, $task['flow_id']);
        }
    }

    /**
     * A Task POST API test
     *
     * @return void
     */
    public function testTaskStore()
    {
        // ARRANGE
        /** @var Flow $flow */
        $flow = \factory(Flow::class)->create();
        $uri = "/api/flows/{$flow->id}/tasks";
        $data = [
            'title' => 'New Flow API Test',
            'hours' => 1,
            'minutes' => 13,
            'seconds' => 9,
        ];
        $expectedStructure = [
            'message',
            'data' => $this->expectedTaskStructure,
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
        $this->assertEquals($flow->id, $json['data']['flow_id']);
    }

    public function testTaskShow()
    {
        // ARRANGE
        $tasks = \factory(Task::class, 1)->create();

        /** @var Flow $flow */
        $flow = \factory(Flow::class)->create();
        $flow->tasks()->saveMany($tasks);
        $task = $tasks[0];
        $uri = "/api/flows/{$flow->id}/tasks/{$task->id}";
        $expectedStructure = [
            'message',
            'data' => $this->expectedTaskStructure,
        ];

        // ACT
        $response = $this->get($uri);
        $json = $response->json();

        //ASSERT
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonStructure($expectedStructure);
        $this->assertEquals($task->id, $json['data']['id']);
        $this->assertEquals($flow->id, $json['data']['flow_id']);
    }

    public function testTaskUpdate()
    {
        // ARRANGE
        $tasks = \factory(Task::class, 1)->create();

        /** @var Flow $flow */
        $flow = \factory(Flow::class)->create();
        $flow->tasks()->saveMany($tasks);
        $task = $tasks[0];
        $uri = "/api/flows/{$flow->id}/tasks/{$task->id}";
        $data = [
            'title' => 'Updated Flow API Test',
            'minutes' => 13,
        ];
        $expectedStructure = [
            'message',
            'data' => $this->expectedTaskStructure,
        ];

        // ACT
        $response = $this->put($uri, $data);
        $json = $response->json();

        // ASSERT
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonStructure($expectedStructure);
        $this->assertEquals($task->id, $json['data']['id']);
        $this->assertEquals($flow->id, $json['data']['flow_id']);

        // test that the Task.title & Task.minutes are updated
        $this->assertEquals($data['title'], $json['data']['title']);
        $this->assertEquals($data['minutes'], $json['data']['minutes']);

        // test that the Task.hours & Task.seconds stay the same
        $this->assertEquals($task->hours, $json['data']['hours']);
        $this->assertEquals($task->seconds, $json['data']['seconds']);
    }

    public function testTaskDestroy()
    {
        // ARRANGE
        $tasks = \factory(Task::class, 1)->create();

        /** @var Flow $flow */
        $flow = \factory(Flow::class)->create();
        $flow->tasks()->saveMany($tasks);
        $task = $tasks[0];
        $uri = "/api/flows/{$flow->id}/tasks/{$task->id}";

        // ACT
        $response = $this->delete($uri);

        // ASSERT
        $response->assertStatus(Response::HTTP_NO_CONTENT);
        $this->assertEmpty($response->content());
    }
}
