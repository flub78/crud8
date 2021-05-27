<?php

namespace tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Game;

class GamesModelTest extends TestCase
{
    
    // Clean up the database
    use RefreshDatabase;
        
    /**
     * Test element creation, read, update and delete
     * Given the database server is on
     * Given the schema exists in database
     * When creating an element
     * Then it is stored in database, it can be read, updated and deleted
     */
    public function testCRUD () {
        
        $initial_count = Game::count();
        
        // Create
        $game = Game::factory()->make();        
        $game->save();
        
        // and a second
        Game::factory()->make()->save();
        
        $count = Game::count();
        $this->assertTrue($count == $initial_count + 2, "Two new elements in the table");
        $this->assertDatabaseCount('games',  $initial_count + 2);
                
        # Read
        $stored = Game::where('name', $game->name)->first();
        
        $this->assertTrue($game->equals($stored), "Checks the element fetched from the database");
        
        // Update
        $new_name = "updated game";
        $new_price = 12;
        $stored->name = $new_name;
        $stored->price = $new_price;
        
        $stored->save();
        
        $back = Game::where('name', $new_name)->first();
        $this->assertEquals($back->price, $new_price, "After update");
        $this->assertDatabaseHas('games', [
            'name' => $new_name,
        ]);
        
        // Delete
        $stored->delete();   
        $this->assertDeleted($stored);
        $count = Game::count();
        $this->assertTrue($count == $initial_count + 1, "One less elements in the table");
        $this->assertDatabaseMissing('games', [
            'name' => $new_name,
        ]);
    }
    
    public function test_saving_incorrect_values() {
    	// Create
    	$game = Game::factory()->make();
    	$game->price = 300;
    	$game->save();
    	
    	
    }
    
    public function test_updating_with_incorrect_input () {
    	
    }
    
    public function test_deleting_non_existing_element () {
    	
    }
}
