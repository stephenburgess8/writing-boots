<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WebRoutesTest extends TestCase
{
    /**
     * @test
     */
    public function route_root()
    {
	    $response = $this->call('GET', '/');
	    // $response->dumpHeaders();

        // $response->dump();
		$response = $this->get('/');
	    $this->assertEquals(200, $response->status());
    }

    /**
     * @test
     */
    public function route_home_no_auth_redirects()
    {
	    $response = $this->call('GET', '/home');
	    $response->assertRedirect('login');
    }
}
