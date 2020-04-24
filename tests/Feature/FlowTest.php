<?php

namespace Tests\Feature;

use App\Flow;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FlowTest extends TestCase
{
    use RefreshDatabase;

    private array $expectedFlowStructure = [
        'id',
        'title',
        'created_at',
        'updated_at',
    ];

    /**
     * A test for the GET Flow resources API
     */
    public function testFlowIndex()
    {
        // ARRANGE
        $flows = \factory(Flow::class, 3)->create();
        $uri = '/api/flows';
        $expectedStructure = [
            'message',
            'data' => [
                '*' => $this->expectedFlowStructure,
            ],
        ];

        // ACT
        $response = $this->get($uri);
        $json = $response->json();

        //ASSERT
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonStructure($expectedStructure);
        $this->assertCount(\count($flows), $json['data']);
    }

    /**
     * A test for the Flow POST API
     */
    public function testFlowStore()
    {
        // ARRANGE
        $uri = '/api/flows';
        $data = [
            'title' => 'New Flow API Test',
        ];
        $expectedStructure = [
            'message',
            'data' => $this->expectedFlowStructure,
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

    /**
     * A test for the GET individual Flow API
     */
    public function testFlowShow()
    {
        // ARRANGE
        $flows = \factory(Flow::class, 1)->create();
        $flow = $flows[0];
        $uri = '/api/flows/' . $flow->id;
        $expectedStructure = [
            'message',
            'data' => $this->expectedFlowStructure,
        ];

        // ACT
        $response = $this->get($uri);
        $json = $response->json();

        //ASSERT
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonStructure($expectedStructure);
        $this->assertEquals($flow->id, $json['data']['id']);
    }

    /**
     * A test for the Flow update API
     */
    public function testFlowUpdate()
    {
        // ARRANGE
        $flows = \factory(Flow::class, 1)->create();
        $flow = $flows[0];
        $uri = '/api/flows/' . $flow->id;
        $data = [
            'title' => 'New Flow API Test',
        ];
        $expectedStructure = [
            'message',
            'data' => $this->expectedFlowStructure,
        ];

        // ACT
        $response = $this->put($uri, $data);
        $json = $response->json();

        // ASSERT
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonStructure($expectedStructure);
        $this->assertEquals($flow->id, $json['data']['id']);
        $this->assertEquals(
            $data['title'],
            $json['data']['title']
        );
    }

    public function testFlowDestroy()
    {
        // ARRANGE
        $flows = \factory(Flow::class, 1)->create();
        $flow = $flows[0];
        $uri = '/api/flows/' . $flow->id;

        // ACT
        $response = $this->delete($uri);

        // ASSERT
        $response->assertStatus(Response::HTTP_NO_CONTENT);
        $this->assertEmpty($response->content());
    }
}
