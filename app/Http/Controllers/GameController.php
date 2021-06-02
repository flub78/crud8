<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;
use Illuminate\Support\Facades\Log;


class GameController extends Controller
{
	protected $rules = [
			'name' => 'required|max:255',
			'price' => 'required|integer|max:255|min:0',
	];
	
    /**
     * Display the resource table view
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        $games = Game::all();
        
        return view('games/index',compact('games'));
    }

    /**
     * Show the form to create a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {        
        return view('games/create');
    }

    /**
     * Store a new resource in database
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {        
        // TODO: handle price decimal values with comma (French localisation)
        // Curently price is an integer value ...
        $validatedData = $request->validate($this->rules);
        $show = Game::create($validatedData);
        
        return redirect('/games')->with('success', 'Game is successfully saved');
    }

    /**
     * Display a resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    public function show($id)
    {
    }
     */

    /**
     * Show the edit form
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $game = Game::findOrFail($id);
        
        return view('games/edit', compact('game'));
    }

    /**
     * Update the resource in database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {        
        $validatedData = $request->validate($this->rules);
        Game::whereId($id)->update($validatedData);
        
        return redirect('/games')->with('success', 'Game Data is successfully updated');
    }

    /**
     * Delete a resource from database.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {     
        $game = Game::findOrFail($id);
        $game->delete();
        
        return redirect('/games')->with('success', 'Game Data is successfully deleted');
    }
}
