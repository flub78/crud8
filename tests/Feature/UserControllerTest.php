<?php

namespace tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserControllerTest extends TestCase {
	
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
	 * Create an element and returns its id
	 * @return int
	 */
	private function create_first() {
		$this->be ( $this->user );
		
		$initial_count = User::count();
		$this->assertTrue($initial_count == 0, "No element after refresh");
		
		// Create
		$game = User::factory()->make();
		$game->save();
		$count = User::count();
		$this->assertTrue($count == 1, "One element created");

		# Read
		$stored = User::where('name', $game->name)->first();
		return ($stored->id);		
	}

	/**
	 * Index view
	 *
	 * @return void
	 */
	public function test_users_index_view() {
		
		$this->markTestSkipped('must be revisited.');
		
		$this->be ( $this->user );
		$response = $this->get ( '/users' );
		$response->assertStatus ( 200 );
		$response->assertSeeText ( 'User Name' );
		$response->assertSeeText ( 'Edit' );
	}

	/**
	 * Create view
	 *
	 * @return void
	 */
	public function test_users_create_view() {
		$this->be ( $this->user );
		$response = $this->get ( '/users/create' );
		$response->assertStatus ( 200 );
		$response->assertSeeText ( 'New user' );
	}
	
	/**
	 * Edit view
	 *
	 * @return void
	 */
	public function test_users_edit_view_existing_element() {
		
		$id = $this->create_first();
		
		$response = $this->get ( "/users/$id/edit" );
		$response->assertStatus ( 200 );
		$response->assertSeeText ( 'Edit User' );
	}
	
	/**
	 * Edit view
	 *
	 * @return void
	 */
	public function test_users_edit_view_unknown_element_return_404() {
		
		$id = $this->create_first() + 1000;
		
		$response = $this->get ( "/users/$id/edit" );
		$response->assertStatus ( 404 );	// not found		
	}
		
	/**
	 * Test element storage
	 */
	public function test_users_store() {
		
		$this->markTestSkipped('must be revisited.');
		
		
		// to avoid the error: 419 = Authentication timeout
		$this->withoutMiddleware();
				
		$initial_count = User::count();
		
		$elt = array('name' => 'go', 'price' => 12);
		$response = $this->post('/users', $elt);
		
		if (session('errors')) {
			$this->assertTrue(session('errors'), "session has no errors");
		}
		
		$count = User::count();
		$this->assertTrue($count == $initial_count + 1, "One new elements in the table");
	}

	/**
	 * Test element storage
	 */
	public function test_users_store_incorrect_element() {
		
		// to avoid the error: 419 = Authentication timeout
		$this->withoutMiddleware();
		
		$initial_count = User::count();
		
		$elt = array('name' => 'go', 'price' => 300);
		$response = $this->post('/users', $elt);
		
		if (!session('errors')) {
			$this->assertTrue(session('errors'), "session has errors");
		}
		
		$count = User::count();
		$this->assertTrue($count == $initial_count, "No creation in the table");
	}
	
	/**
	 * 
	 */
	public function test_users_update_and_delete() {
		$this->test_users_store();
		
		$initial_count = User::count();
		
		$stored = User::where('name', 'go')->first();
		$this->assertEquals( $stored->price, 12, "check retrieve value");
		$elt = array('name' => $stored->name, 'price' => $stored->price * 2, 'id' => $stored->id);
		
		$url = "/users/" . $stored->id;
		$response = $this->patch($url, $elt);
		$stored = User::where('name', 'go')->first();
		$this->assertEquals( $stored->price, 24, "value updated");
		
		$url = "/users/" . $stored->id;
		$this->delete($url);
		$count = User::count();
		$this->assertTrue($count == $initial_count - 1, "Element updated then deleted ($url)"); 
		
	}
	
	
}
