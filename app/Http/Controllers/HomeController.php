<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Auth;
use Illuminate\Contracts\Support\Renderable;

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
     * @return Renderable
     */
    public function index(): Renderable
    {
        return view('home', [
                'groups' => Group::all(),
                'user' => Auth::user()
            ]
        );
    }
}
