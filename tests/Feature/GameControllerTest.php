<?php

namespace tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Game;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GameControllerTest extends TestCase {
	
	protected $basename = "games";
	
	
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
		
		$initial_count = Game::count();
		$this->assertTrue($initial_count == 0, "No element after refresh");
		
		// Create
		$game = Game::factory()->make();
		$game->save();
		$count = Game::count();
		$this->assertTrue($count == 1, "One element created");

		# Read
		$stored = Game::where('name', $game->name)->first();
		return ($stored->id);		
	}

	/**
	 * Index view
	 *
	 * @return void
	 */
	public function test_games_index_view() {
		$this->be ( $this->user );
		$response = $this->get ( '/games' );
		$response->assertStatus ( 200 );
		$response->assertSeeText ( 'Game Name' );
		$response->assertSeeText ( 'Edit' );
	}

	/**
	 * Create view
	 *
	 * @return void
	 */
	public function test_games_create_view() {
		$this->be ( $this->user );
		$response = $this->get ( '/games/create' );
		$response->assertStatus ( 200 );
		$response->assertSeeText ( 'Add Games Data' );
	}
	
	/**
	 * Edit view
	 *
	 * @return void
	 */
	public function test_games_edit_view_existing_element() {
		
		$id = $this->create_first();
		
		$response = $this->get ( "/games/$id/edit" );
		$response->assertStatus ( 200 );
		$response->assertSeeText ( 'Edit Game Data' );
	}
	
	/**
	 * Edit view
	 *
	 * @return void
	 */
	public function test_games_edit_view_unknown_element_return_404() {
		
		$id = $this->create_first() + 1000;
		
		$response = $this->get ( "/games/$id/edit" );
		$response->assertStatus ( 404 );	// not found		
	}
		
}
