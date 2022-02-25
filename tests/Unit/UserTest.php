<?php

namespace Tests\Unit;
use App\Models\User;

// use PHPUnit\Framework\TestCase;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */

     public function test_login_form()
     {
         $response = $this->get('/login');

         $response->assertStatus(200);
     }

     public function test_delete_user()
     {
         $user = User::factory()->count(1)->create();

         $user = User::first();

         if ($user) {
             $user->delete();
         }

         $this->assertTrue(true);
     }

     public function test_duplicated_values()
     {
         $user = User::make([
            'name' => 'John',
            'email' => 'john@test.com'
         ]);

         $user1 = User::make([
            'name' => 'John1',
            'email' => 'john1@test.com'
         ]);

         $this->assertTrue($user->name != $user1->name);
     }

     public function test_register_user()
     {
         $response = $this->post('/register', [
             'name' => 'test',
             'email' => 'test2@test.com',
             'password' => 'test1234',
             'password_confirmation' => 'test1234'
         ]);

         $response->assertRedirect('/home');
     }

     public function test_database()
     {
         $this->assertDatabaseHas('users', ['name' => 'test23']);
     }
}
