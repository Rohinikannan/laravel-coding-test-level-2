<?php

namespace Tests\Unit;

//use PHPUnit\Framework\TestCase;
use Tests\TestCase;


class UserTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $this->assertTrue(true);
    }


    public function testCreateResource()
    {
        $response = $this->postJson('/api/v1/users', ['username' => "Sally",'password' => "$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC",'role_id' => 1,'remember_token' => "nrrmtymtym"]);
         $response
        ->assertStatus(201)
        ->assertJson([
            'created' => true,
        ]);
        
    }

    public function testProjectRequest()
    {
       // $this->withoutExceptionHandling();
        //$user=\App\Models\User::factory()->count(1)->create();
    $this->actingAs(\App\Models\User::factory()->count(1)->create())
    ->json('POST', '/api/v1/create/project', [
          'name' => 'Lorem'
  
      ])
        ->assertStatus(200)
        ->assertJson(['created'=>true]);
    }
    public function testCreateTask()
    {

        $user = \App\Models\User::factory()->create();
        $token = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];
        $task = \App\Models\Task::factory()->create([
            'title'=>'First TItile',
            'description'=>'First Description',
            'status' =>'NOT_STARTED'
        ]);

        $payload = [
            'title'=>'Second Title',
            'description'=>'Second Description',
            'status' =>'IN_PROGRESS'
        ];

        $response = $this->json('PUT', '/api/v1/update/task' . $task->project_id, $payload, $headers)
            ->assertStatus(200)
            ->assertJson([ 
                'id' => 1, 
                'title' => 'Lorem', 
                'body' => 'Ipsum' 
            ]);
      }
}
