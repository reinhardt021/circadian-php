<?php

namespace Tests\Feature;

use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FlowTest extends TestCase
{
    /**
     * A Flow Index API test
     *
     * @return void
     */
    public function testFlowIndex()
    {
        // ARRANGE

        // ACT
        $response = $this->get('/api/flows');

        //ASSERT
        $response->assertStatus(Response::HTTP_OK);
    }

    /**
     * A Flow POST API test
     *
     * @return void
     */
    public function testFlowStore()
    {
        // ARRANGE
        $data = [
            'title' => 'New Flow API Test'
        ];

        // ACT
        $response = $this->postJson('/api/flows', $data);

        //ASSERT
        $response->assertStatus(Response::HTTP_CREATED);
    }

//    public function testFlowShow()
//    public function testFlowUpdate()
//    public function testFlowDestroy()

}
