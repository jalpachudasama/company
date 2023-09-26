<?php

namespace Tests\Feature;

use App\Http\HttpCode;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    public function test_GetUsers_By_Sorting_Full_name(): void
    {
        $response = $this->get('/api/users');
        $response->assertStatus(HttpCode::HTTP_OK);
    }
}
