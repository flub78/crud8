<?php

namespace tests\Feature;

use Tests\TestCase;
use App\Models\User;

class HomeControllerTest extends TestCase {
	
	/**
	 * Constructor
	 */
	function __construct() {
		parent::__construct ();

		// required to be able to use the factory inside the constructor
		$this->createApplication ();
		// $this->user = factory(User::class)->create();
		$this->user = User::factory ()->make ();
	}
	
	function __destruct() {
		$this->user->delete ();
	}


	/**
	 * A basic test example.
	 *
	 * @return void
	 */
	public function test_root() {
		$response = $this->get ( '/' );
		$response->assertStatus ( 200 );
	}

	/**
	 * A basic test example.
	 *
	 * @return void
	 */
	public function test_login() {
		$response = $this->get ( '/login' );
		$response->assertStatus ( 200 );
	}

	/**
	 * A basic test example.
	 *
	 * @return void
	 */
	public function test_home() {
		$this->be ( $this->user );
		$response = $this->get ( '/home' );
		$response->assertStatus ( 200 );
		$response->assertSeeText ( 'You are logged in!' );
	}



}
