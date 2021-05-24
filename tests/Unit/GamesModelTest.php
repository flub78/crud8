<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
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
     * Then it is stored in database
     */
    public function testCRUD () {
        
        $initial_count = Game::count();
        
        // Create and save an element
        $game = Game::factory()->make();        
        $game->save();
        
        // and a second
        Game::factory()->make()->save();
        
        $count = Game::count();
        $this->assertTrue($count == $initial_count + 2, "Two more elements in the table");
        $this->assertDatabaseCount('games',  $initial_count + 2);
                
        # Fetch an object back from database
        $stored = Game::where('name', $game->name)->first();
        
        $this->assertTrue($game->equals($stored), "Checks the element fetched from the database");
        
        // Check update
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
        
        // delete
        $stored->delete();   
        $this->assertDeleted($stored);
        $count = Game::count();
        $this->assertTrue($count == $initial_count + 1, "One less elements in the table");
        $this->assertDatabaseMissing('games', [
            'name' => $new_name,
        ]);
    }
    
}
