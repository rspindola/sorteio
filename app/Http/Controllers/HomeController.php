<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\Voto;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $results = Item::all();
        $total_votes = Voto::all()->count();
        return view('home')->with('results', $results)->with('total_votes', $total_votes);
    }
}
