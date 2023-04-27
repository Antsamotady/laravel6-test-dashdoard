<?php

namespace Tests\Unit;

use App\Http\Controllers\TaskController;
use PHPUnit\Framework\TestCase;

class TaskControllerTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    public function testAdd()
    {
        $calculator = new TaskController();
        $result = $calculator->add(2, 3);

        $this->assertEquals(6, $result);
    }
}
