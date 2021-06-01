<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Log;


class UserController extends Controller
{
    /**
     * Display the resource table view
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        $users = User::all();
        
        return view('users/index',compact('users'));
    }

    /**
     * Show the form to create a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {        
        return view('users/create');
    }

    /**
     * Store a new resource in database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {        
        // TODO: handle price decimal values with comma (French localisation)
        // Curently price is an integer value ...
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'price' => 'required|integer|max:255',
        ]);
        $show = User::create($validatedData);
        
        return redirect('/users')->with('success', 'User is successfully saved');
    }

    /**
     * Display the specified resource.
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
        $user = User::findOrFail($id);
        
        return view('users/edit', compact('user'));
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
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'price' => 'required'
        ]);
        User::whereId($id)->update($validatedData);
        
        return redirect('/users')->with('success', 'User Data is successfully updated');
    }

    /**
     * Delete a resource from database.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {     
        $user = User::findOrFail($id);
        $user->delete();
        
        return redirect('/users')->with('success', 'User is successfully deleted');
    }
}
