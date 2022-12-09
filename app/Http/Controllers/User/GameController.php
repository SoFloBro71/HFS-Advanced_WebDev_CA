<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;


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
        $user = Auth::user();
        $user->authorizeRoles('user');

        $games = Game::paginate(10);
        // $games = Game::with('publisher')->get();

        return view('user.games.index')->with('games', $games);
    }


    /**
     * Displays the selected resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Game $game)
    {
        // /Game | findOrFail() firstOrFail() return a 404 not found view if not found

        return view('user.games.show')->with('game', $game);
    }

    // /**
    //  * Shows the edit form for the resource you've selected to edit.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function edit(Game $game)
    // {
    //     // iff not found error 403 pops up
    //     if ($game->user_id != Auth::id()) {
    //         return abort(403);
    //     }

    //     return view('games.edit')->with('game', $game);
    // }

    // /**
    //  * Updates the selected resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function update(Request $request, Game $game)
    // {

    //     if ($game->user_id != Auth::id()) {
    //         return abort(403);
    //     }

    //     $request->validate([
    //         'title' => 'required',
    //         'description' => 'required|max:500',
    //         'category' => 'required',
    //         'developer' => 'required',
    //         'game_image' => 'file|image'
    //     ]);

    //     // dd($request);
    //     $game_image = $request->file('game_image');
    //     $extension = $game_image->getClientOriginalExtension();
    //     // chamges file name to date-month-year format
    //     $filename = date('Y-m-d-His') . '_' . $request->input('title') . '.' . $extension;


    //     $path = $game_image->storeAs('public/images', $filename);

    //     $game->update([

    //         'title' => $request->title,
    //         'description' => $request->description,
    //         'category' => $request->category,
    //         'game_image' => $filename,
    //         'developer' => $request->developer
    //     ]);

    //     // adds a message at top of screen when resource is deleted successfully

    //     return to_route('games.show', $game)->with('success', 'Game Info updated successfully');
    // }

    // /**
    //  * Removes the selected resource from storage.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function destroy(Game $game)
    // {

    //     if ($game->user_id != Auth::id()) {
    //         return abort(403);
    //     }

    //     $game->delete();

    //     // adds a message at top of screen when resource is deleted successfully

    //     return to_route('games.index')->with('success', 'Game Info deleted successfully');
    // }
}
