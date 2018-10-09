<?php

namespace App\Http\Controllers;

use App\Voto;
use App\Item;
use Illuminate\Http\Request;
use DB;

class VotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $votos = Voto::all();
        return view('voto.index')->with('votos', $votos);
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
        $input = $request->all();
        $input['ip'] = request()->ip();
        $item = Voto::create($input);
        return view('obrigado');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Voto  $voto
     * @return \Illuminate\Http\Response
     */
    public function show(Voto $voto)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Voto  $voto
     * @return \Illuminate\Http\Response
     */
    public function edit(Voto $voto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Voto  $voto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Voto $voto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Voto  $voto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Voto $voto)
    {
        //
    }
}
