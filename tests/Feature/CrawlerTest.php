<?php

namespace Tests\Feature;

use App\Mail\YourPassword;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CrawlerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function a_user_is_registered_when_adding_a_website()
    {
        Mail::fake();

        $url = 'https://peoplewave.co';
        $email = 'phil@peoplewave.co';
        $query = 'people';

        $this->post('/crawl',
            ['email' => $email, 'url' => $url, 'query' => $query],
            ['X-Requested-With' => 'XMLHttpRequest']
        )->assertStatus(200);

        $this->assertDatabaseHas('users', [
            'email' => $email
        ])->assertDatabaseHas('websites', [
            'user_id' => User::first()->id,
            'url' => $url,
            'query' => $query
        ]);

        Mail::assertSent(YourPassword::class);
    }

    /** @test */
    function a_valid_url_must_be_submitted()
    {
        $this->withExceptionHandling();

        $response = $this->post('/crawl', ['url' => 'www.peoplewave.co', 'query' => 'people'],
            ['X-Requested-With' => 'XMLHttpRequest']);

        $response->assertStatus(422);
    }

    /** @test */
    function a_valid_query_must_be_submitted()
    {
        $this->withExceptionHandling();

        $response = $this->post('/crawl', ['url' => 'https://peoplewave.co', 'query' => 'i contain spaces'],
            ['X-Requested-With' => 'XMLHttpRequest']);

        $response->assertStatus(422);
    }
}
