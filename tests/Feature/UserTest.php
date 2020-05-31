<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Route;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    

    public function testLogin()
    {
        $credential = [
            'email' => 'reachme@sreedevr.com',
            'password' => 'password'
        ];
    
        $response = $this->post('login',$credential);
        $response
            ->assertStatus(302)
            ->assertRedirect('admin/dashboard');
    }

    public function testDashboard()
    {
        $user = User::findOrFail(1);
        $response = $this->actingAs($user)->get('admin/dashboard');
        $response->assertOk();
    }

    public function testUsers()
    {
        $user = User::findOrFail(1);
        $response = $this->actingAs($user)->get('admin/users');
        $response->assertOk();
    }

    public function testUserEditGet()
    {
        $user = User::findOrFail(1);
        $response = $this->actingAs($user)->get('admin/user/edit/1');
        $response->assertOk();
    }

    public function testUserEditPost()
    {
        $admin = User::findOrFail(1);
        $user = factory(User::class)->create();
        $attributes = [
            'name' => 'tested Ok',
            'email' => 'tested@phptext.com'
        ];
        $response = $this->actingAs($user)->post('admin/user/edit/'.$user->id, $attributes);
        $response->assertRedirect();
    }

    public function testRoles()
    {
        $user = User::findOrFail(1);
        $response = $this->actingAs($user)->get('admin/users/roles');
        $response->assertOk();
    }
}
