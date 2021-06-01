<?php

/**
 * Test cases:
 *
 * Nominal:
 *
 * Error test case:
 * delete a non existing backup
 * restore a non existing backup
 *
 * attempt to create, restore or delete a backup as non admin
 */
namespace tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Game;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BackupControllerTest extends TestCase {
	protected $basename = "games";

	// Clean up the database
	// Not refreshing the database may break others tests
	// TODO: as this test restore the database experiment without RefreshDatabase
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
	 *
	 * @return int
	 */
	private function create_first() {
		$this->be ( $this->user );

		$initial_count = Game::count ();
		$this->assertTrue ( $initial_count == 0, "No element after refresh" );

		// Create
		$game = Game::factory ()->make ();
		$game->save ();
		$count = Game::count ();
		$this->assertTrue ( $count == 1, "One element created" );

		# Read
		$stored = Game::where ( 'name', $game->name )->first ();
		return ($stored->id);
	}

	/**
	 * count existing backups
	 * @return number
	 */
	private function local_backup_count() {
		$dirpath = storage_path () . "/app/backup/";
		$backup_list = scandir ( $dirpath );

		return count ( $backup_list ) - 2;
	}

	/**
	 * get a signature/hash of the database
	 * backup current database state (check that a new backup is created)
	 * change the database
	 * restore the previous state
	 * check that the database is back in its initial state
	 * delete the backup
	 * check that there is one less backup in the local storage
	 */
	public function test_backup_create_delete() {
		$this->be ( $this->user );

		$initial_count = $this->local_backup_count ();
		
		// backup list
		$response = $this->get ( '/backup' );
		$response->assertStatus ( 200 );
		$response->assertSeeText('Local backups');
		$response->assertSeeText('Number');
		$response->assertSeeText('Restore');
		$response->assertSeeText('New backup');
		
		// create a backup
		$response = $this->get ( '/backup/create' );
		$response->assertStatus ( 200 );

		$this->assertEquals ( $this->local_backup_count (), $initial_count + 1, "a backup has been created" );

		$id = $initial_count + 1;

		echo "   warning: restore is not tested\n";
		
		/*
		 * It seems that restoring a database while phpunit is running has some negative effects...
		 * It blocks the test ....
		 * 
		// Change the database
		$initial_table_count = Game::count ();
		$game = Game::factory ()->make ();
		$game->save ();
		$count = Game::count ();
		$this->assertEquals ( $count, $initial_table_count + 1, "One element created" );

		// Restore the database
		$response = $this->get ( "/backup/$id/restore" );
		$response->assertStatus ( 302 ); // redirected

		// Check rollback
		$this->assertEquals ( Game::count (), $initial_table_count, "Back to initial state" );
		*/

		// Delete the backup
		$response = $this->delete ( "/backup/$id" );
		$response->assertStatus ( 302 ); // redirected
		// $response->assertSeeText ( 'deleted' );
		
		$this->assertEquals ( $this->local_backup_count (), $initial_count, "a backup has been deleted" );
	}

	
	/**
	 * 
	 */
	public function test_delete_non_existing_backup() {
		$this->be ( $this->user );

		$response = $this->delete ( "/backup/999999999" );
		$response->assertStatus ( 302 ); // redirected
		
		echo "   warning: no reported error is checked\n";
		
	}
	
	/**
	 *
	 */
	public function test_restore_non_existing_backup() {
		$this->be ( $this->user );
		
		$response = $this->get ( "/backup/999999999/restore" );
		$response->assertStatus ( 302 ); // redirected

		echo "   warning: no reported error is checked\n";
	}
}
