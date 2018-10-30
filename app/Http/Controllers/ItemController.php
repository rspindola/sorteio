<?php

namespace App\Http\Controllers;

use App\Item;
use Illuminate\Http\Request;
use Image;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Item::orderBy('id','DESC')->paginate(5);
        return view('votacao.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('votacao.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'titulo' => 'required',
        ]);
        $input = $request->all();
        
        //pegando e manipulando os dados da logo
        if ($request->imagem) {
            $imagem = $request->imagem;
            $filename = 'thumb-'.str_random(10).time().'.'.$imagem->getClientOriginalExtension(); 
            $destinationPath = public_path('images/thumb');
            $thumb_img = Image::make($imagem->getRealPath())->encode('jpg', 75)->resize(795, 550);
            $thumb_img->save($destinationPath.'/'.$filename,80);
            
            $destinationPath = public_path('images');
            $original = Image::make($imagem->getRealPath())->encode('jpg', 75);
            $original->save($destinationPath.'/'.$filename);

            $input['imagem'] = $filename;
        }

        $item = Item::create($input);
        return redirect()->route('item.index')
                        ->with('success','User created successfully');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Item::find($id);
        return view('votacao.edit',compact('item'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'titulo' => 'required',
        ]);
        $input = $request->all();
        //pegando e manipulando os dados da logo
        if ($request->imagem) {
            $imagem = $request->imagem;
            $filename = 'thumb-'.str_random(10).time().'.'.$imagem->getClientOriginalExtension(); 
            $destinationPath = public_path('images/thumb');
            $thumb_img = Image::make($imagem->getRealPath())->encode('jpg', 75)->resize(795, 550);
            $thumb_img->save($destinationPath.'/'.$filename,80);
            
            $destinationPath = public_path('images');
            $original = Image::make($imagem->getRealPath())->encode('jpg', 75);
            $original->save($destinationPath.'/'.$filename);

            $input['imagem'] = $filename;
        }
        $item = Item::find($id);
        $item->update($input);
        return redirect()->route('item.index')
                        ->with('success','User updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Item::find($id)->delete();
        return redirect()->route('item.index')
                        ->with('success','User deleted successfully');
    }
}