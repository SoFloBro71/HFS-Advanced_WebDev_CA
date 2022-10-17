<?php
namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Fetch motes in order of when they were last updated - latest updated returned first
        $games = Game::where('customer_id', Auth::id())->latest('updated_at')->paginate();
        // dd($notes);
        return view('games.index')->with('games', $games);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('games.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:120',
            'text' => 'required'
        ]);

        Game::create([
            // Ensure you have the use statement for 
            // Illuminate\Support\Str at the top of this file.
            'uuid' => Str::uuid(),
            'customer_id' => Auth::id(),
            'title' => $request->title,
            'text' => $request->text
        ]);

        return to_route('gamess.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Game $game)
    {
        // /NOTE | findOrFail() firstOrFail() return a 404 not found view if not found.
        // This is OK for web application development, but not for API development as
        // API's return JSON not Views.

        if($game->customer_id != Auth::id()) {
            return abort(403);
        }

        return view('games.show')->with('game', $game);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Game $game)
    {
        if($game->customer_id != Auth::id()) {
            return abort(403);
        }

        return view('games.edit')->with('game', $game);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Game $game)
    {

        if($game->customer_id != Auth::id()) {
            return abort(403);
        }

        $request->validate([
            'title' => 'required|max:120',
            'text' => 'required'
        ]);

        $game->update([

            'title' => $request->title,
            'text' => $request->text
        ]);

        return to_route('games.show', $game)->with('success','Game Info updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Game $game)
    {

        if($game->customer_id != Auth::id()) {
            return abort(403);
        }

        $game->delete();

        return to_route('games.index')->with('success','Game Info deleted successfully');
    }
}