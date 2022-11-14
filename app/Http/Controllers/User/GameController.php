<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class GameController extends Controller
{
    /**
     * Displays a listing of the resource made in order of new to old.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Fetches games in order of when they were last updated - latest updated returned first
        $games = Game::where('user_id', Auth::id())->latest('updated_at')->paginate();
        // dd($games);
        return view('games.index')->with('games', $games);
    }

    /**
     * Shows the create form for creating new resources.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('games.create');
    }

    /**
     * Stores newly created resources in storage file.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validates inputs and makes sure all needed info is added in order to create
        $request->validate([
            'title' => 'required',
            'description' => 'required|max:500',
            'category' => 'required',
            'developer' => 'required',
            
            // 'game_image' => 'file|image|dimensions:width300,height=400',
            'game_image' => 'file|image',
        ]);

        // changes the name of image file as to not have same file names 
        $game_image = $request->file('game_image');
        $extension = $game_image->getClientOriginalExtension();

        // changes image name to a year-month-date format
        $filename = date('Y-m-d-His') . '_' . $request->input('title') . '.' . $extension;

        $path = $game_image->storeAs('public/images', $filename);

        Game::create([
            // 
            'uuid' => Str::uuid(),
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'game_image' => $filename,
            'developer' => $request->developer,
            'category' => $request->category

        ]);

        return to_route('games.index');
    }

    /**
     * Displays the selected resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Game $game)
    {
        // /Game | findOrFail() firstOrFail() return a 404 not found view if not found.

        if ($game->user_id != Auth::id()) {
            return abort(403);
        }

        return view('games.show')->with('game', $game);
    }

    /**
     * Shows the edit form for the resource you've selected to edit.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Game $game)
    {
        // iff not found error 403 pops up
        if ($game->user_id != Auth::id()) {
            return abort(403);
        }

        return view('games.edit')->with('game', $game);
    }

    /**
     * Updates the selected resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Game $game)
    {

        if ($game->user_id != Auth::id()) {
            return abort(403);
        }

        $request->validate([
            'title' => 'required',
            'description' => 'required|max:500',
            'category' => 'required',
            'developer' => 'required',
            'game_image' => 'file|image'
        ]);

        // dd($request);
        $game_image = $request->file('game_image');
        $extension = $game_image->getClientOriginalExtension();
        // chamges file name to date-month-year format
        $filename = date('Y-m-d-His') . '_' . $request->input('title') . '.' . $extension;


        $path = $game_image->storeAs('public/images', $filename);

        $game->update([

            'title' => $request->title,
            'description' => $request->description,
            'category' => $request->category,
            'game_image' => $filename,
            'developer' => $request->developer
        ]);

        // adds a message at top of screen when resource is deleted successfully

        return to_route('games.show', $game)->with('success', 'Game Info updated successfully');
    }

    /**
     * Removes the selected resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Game $game)
    {

        if ($game->user_id != Auth::id()) {
            return abort(403);
        }

        $game->delete();

        // adds a message at top of screen when resource is deleted successfully

        return to_route('games.index')->with('success', 'Game Info deleted successfully');
    }
}
