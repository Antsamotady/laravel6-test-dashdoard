<?php

namespace Tests\Feature;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test for the home page.
     *
     * @return void
     */
    public function test_home_page()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertViewIs('tasks.index');
    }

    /**
     * A basic test for the create task page.
     *
     * @return void
     */
    public function test_create_task_page()
    {
        $response = $this->get('/tasks/create');
        $response->assertStatus(200);
        $response->assertViewIs('tasks.create');
    }
}
