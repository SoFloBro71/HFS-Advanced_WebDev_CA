<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Publisher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PublisherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');

        $publishers = Publisher::all();
        $publishers = Publisher::paginate(10);
        $publishers = Publisher::with('games')->get();

        return view('admin.publishers.index')->with('publishers', $publishers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  Publisher $publisher
     * @return \Illuminate\Http\Response
     */
    public function show(Publisher $publisher)
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');

        if(!Auth::id()) {
            return abort(403);
        }

        return view('admin.publishers.show')->with('publisher', $publisher);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Publisher $publisher)
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');

        return view('admin.publishers.edit')->with('publisher', $publisher);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update( Request $request, Publisher $publisher)
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');

        if(!Auth::id()) {
            return abort(403);
        }

        $request->validate([
            'Publisher Name' => 'required',
            'Publisher Address' => 'required|max:500'
        ]);

        return view('admin.publishers.update')->with('publisher', $publisher);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Publisher $publisher)
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');
        $publisher->delete();

        if(!Auth::id()) {
            return abort(403);
        }

        return view('admin.publishers.delete')->with('publisher', $publisher)->with('success', 'Game Info deleted successfully');
    }
}