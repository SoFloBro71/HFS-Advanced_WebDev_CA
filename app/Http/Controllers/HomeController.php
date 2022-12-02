<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index(Request $request)
    {
       // dd($request);

        $user = Auth::user();
        $home = 'admin.games.index';

        if($user->hasRole('admin')){
            $home = 'admin.games.index';
        }
        else if ($user->hasRole('user')){
            $home = 'user.games.index';
        }

        // dd($home);
        return redirect()->route($home);
    }
    
}
