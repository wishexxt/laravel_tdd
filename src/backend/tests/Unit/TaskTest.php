<?php

namespace Tests\Unit;

use App\Project;
use App\Task;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_task_belongs_to_a_project()
    {
        $task = factory(Task::class)->create();

        $this->assertInstanceOf(Project::class, $task->project);
    }

   /** @test */
   public function it_has_a_path()
   {
        $task = factory(Task::class)->create();

        $this->assertEquals('/projects/' . $task->project_id . '/tasks/' . $task->id, $task->path());
   }
}