<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaskTest extends TestCase
{
    /**
     * A Task Index API test.
     *
     * @return void
     */
    public function testTaskIndex()
    {
        // ARRANGE

        // ACT
        $response = $this->get('/api/flows/1/tasks');

        //ASSERT
        $response->assertStatus(200);
    }
//    public function testTaskStore()
//    public function testTaskShow()
//    public function testTaskUpdate()
//    public function testTaskDestroy()
}
