<?php

namespace tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class NonAdminTest extends TestCase {
	
	protected $basename = "users";
	
	
	// Clean up the database
	use RefreshDatabase;
	
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
	 * Index view
	 *
	 * @return void
	 */
	public function test_non_admin_users_can_see_non_admin_pages() {
				
		$this->be ( $this->user );
		$response = $this->get ( '/games' );
		$response->assertStatus ( 200 );
		$response->assertSeeText ( 'Games' );
		$response->assertSeeText ( 'Edit' );
	}		
	
	/**
	 *
	 * @return void
	 */
	public function test_cannot_access_admin_routes() {
		
		$this->be ( $this->user );
		$response = $this->get ( '/users' );
		$response->assertStatus ( 302 );
		// I still do not know how to test contains after redirections...
		// $response->assertSeeText ( 'You have not admin access' );
		// $response->assertSeeText ( 'Dashboard' );
	}
	
}
