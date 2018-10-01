<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Project;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectTest extends TestCase
{
    public function testsCreateProject()
    {
        $payload = [
            'name' => 'move table',
            'description' => 'move table to another corner',
            'status' => 'planned',
        ];

        $this->json('POST', '/api/projects', $payload)
            ->assertStatus(200)
            ->assertJson([
                'id' => 1,
                'name' => 'move table',
                'description' => 'move table to another corner',
                'status' => 'planned',
            ]);
    }

    public function testsUpdateProject()
    {
        $project = factory(Project::class)->create([
            'name' => 'microCRM',
            'description' => 'create endpoints',
            'status' => 'planned',
        ]);

        $payload = [
            'name' => 'microCRM',
            'description' => 'create endpoints and write tests',
            'status' => 'finished',
        ];

        $response = $this->json('PUT', '/api/projects/' . $project->id, $payload)
            ->assertStatus(200)
            ->assertJson([
                'id' => 1,
                'name' => 'microCRM',
                'description' => 'create endpoints and write tests',
                'status' => 'finished',
            ]);
    }

    public function testsDeleteProject()
    {
        $project = factory(Project::class)->create();

        $this->json('DELETE', '/api/projects/' . $project->id, [])
            ->assertStatus(204);
    }

    public function testsGetAllProjects()
    {
        $project1 = [
            'name' => 'project1',
            'description' => 'create project1',
            'status' => 'cancel',
        ];

        $project2 = [
            'name' => 'project2',
            'description' => 'create project2',
            'status' => 'on hold',
        ];

        factory(Project::class)->create($project1);
        factory(Project::class)->create($project2);

        $response = $this->json('GET', '/api/projects', [])
            ->assertStatus(200)
            ->assertJson([$project1, $project2])
            ->assertJsonStructure([
                '*' => ['id', 'name', 'description', 'status', 'created_at', 'updated_at'],
            ]);
    }


    public function testsGetProject()
    {
        $project = factory(Project::class)->create([
            'name' => 'some project',
            'description' => 'create some project',
            'status' => 'running',
        ]);

        $response = $this->json('GET', '/api/projects/' . $project->id, [])
            ->assertStatus(200)
            ->assertJson([
                'id' => $project->id,
                'name' => 'some project',
                'description' => 'create some project',
                'status' => 'running',
            ])
            ->assertJsonStructure(['id', 'name', 'description', 'status', 'created_at', 'updated_at']);
    }
}
