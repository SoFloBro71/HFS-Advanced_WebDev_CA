<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\Publisher;
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
        $user = Auth::user();
        $user->authorizeRoles('admin');

        $games = Game::with('publisher')->get();

        // $games = Game::paginate(10);
       //  dd($games);
        return view('admin.games.index')->with('games', $games);
    }

    /**
     * Shows the create form for creating new resources.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');

        $publishers = Publisher::all();
        return view('admin.games.create')->with('publishers',$publishers);
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
            'publisher_id' => 'required'
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
            'category' => $request->category,
            'publisher_id' => $request->publisher_id,

        ]);

        return to_route('admin.games.index');
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

        $user = Auth::user();
        $user->authorizeRoles('admin');

        if (!Auth::id()) {
            return abort(403);
        }

        return view('admin.games.show')->with('game', $game);
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

        $user = Auth::user();
        $user->authorizeRoles('admin');

        return view('admin.games.edit')->with('game', $game);
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

        $user = Auth::user();
        $user->authorizeRoles('admin');

        $request->validate([
            'title' => 'required',
            'description' => 'required|max:500',
            'category' => 'required',
            'developer' => 'required',
            'game_image' => 'file|image'
        ]);

        // dd($request);
        if ($request->file('game_image')) {
            $game_image = $request->file('game_image');
            $extension = $game_image->getClientOriginalExtension();
            $filename = date('Y-m-d-His') . '_' . $request->input('title') . '.' . $extension;
    
            // checks request for new image and if no new image then it takes from old image
            $path = $game_image->storeAs('public/images', $filename);
        } else {
            $filename = $game->game_image;
        }

        $game->update([

            'title' => $request->title,
            'description' => $request->description,
            'category' => $request->category,
            'game_image' => $filename,
            'developer' => $request->developer
        ]);

        // adds a message at top of screen when resource is deleted successfully

        return to_route('admin.games.show', $game)->with('success', 'Game Info updated successfully');
    }

    /**
     * Removes the selected resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Game $game)
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');
        $game->delete();

        // adds a message at top of screen when resource is deleted successfully

        return to_route('admin.games.index')->with('success', 'Game Info deleted successfully');
    }
}
