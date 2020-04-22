<?php

namespace Tests\Feature;

use App\Flow;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FlowTest extends TestCase
{
    use RefreshDatabase;

    // todo: create a separate test database with seeded data to test full features .env.test

    /**
     * A GET Flow resources API test
     *
     * @return void
     */
    public function testFlowIndex()
    {
        // ARRANGE
        $flows = factory(Flow::class, 3)->create();
        $uri = '/api/flows';
        $expectedStructure = ['message', 'data'];

        // ACT
        $response = $this->get($uri);
        $json = $response->json();

        //ASSERT
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonStructure($expectedStructure);
        $this->assertCount(\count($flows), $json['data']);
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

    /**
     * A GET individual Flow resource API test
     *
     * @return void
     */
    public function testFlowShow()
    {
        // ARRANGE
        $flows = factory(Flow::class, 1)->create();
        $flow = $flows[0];
        $uri = '/api/flows/' . $flow->id;
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
        $this->assertEquals($flow->id, $json['data']['id']);
    }
//    public function testFlowUpdate()
//    public function testFlowDestroy()

}
