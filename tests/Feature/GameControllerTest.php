<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;
use App\Models\User;

class GameControllerTest extends TestCase
{
    
    protected $basename = "games";	

    function __construct() {
        parent::__construct();
        
        // required to be able to use the factory inside the constructor
        $this->createApplication();
        // $this->user = factory(User::class)->create();
        $this->user = User::factory()->make();
    }
    
    function __destruct() {
        $this->user->delete();
    }
    
    /**
     *
     * @param string $segments
     * @return string
     */
    protected function base_url($segments = "") {
        $url = "/" . $this->basename;
        if ($segments) {
            $url = join("/", [$url, $segments]);
        }
        return $url;
    }
    
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_root()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }
    
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_login()
    {
        $response = $this->get('/login');
        $response->assertStatus(200);      
    }
    
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_home()
    {
        $this->be($this->user);
        $response = $this->get('/home');
        $response->assertStatus(200);
        $response->assertSeeText('You are logged in!');
    }
    
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_games_index()
    {
        $this->be($this->user);
        $response = $this->get('/games');
        $response->assertStatus(200);
        $response->assertSeeText('Game Name');
        $response->assertSeeText('Action');
    }
    
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_games_create()
    {
        $this->be($this->user);
        $response = $this->get('/games/create');
        $response->assertStatus(200);
        $response->assertSeeText('Add Games Data');
    }
}
