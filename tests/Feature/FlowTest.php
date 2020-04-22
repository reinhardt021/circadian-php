<?php

namespace Tests\Feature;

use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FlowTest extends TestCase
{
    /**
     * A Flow GET API test
     *
     * @return void
     */
    public function testFlowIndex()
    {
        // ARRANGE
        $uri = '/api/flows';
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

        //ASSERT
        $response->assertStatus(Response::HTTP_CREATED);
        $response->assertJsonStructure($expectedStructure);
    }

//    public function testFlowShow()
//    public function testFlowUpdate()
//    public function testFlowDestroy()

}
