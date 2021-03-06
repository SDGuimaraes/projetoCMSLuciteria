<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorias = Categoria::paginate(8);
        return view('admin.categoria', [
            'categorias' => $categorias
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categoria.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->only([
            'categoria'
        ]);
        
        $validator = Validator::make($data, [
            'categoria' => ['string']
        ]);
        if($validator->fails()){
            return redirect()->route('categorias.index')
            ->withErrors($validator)
            ->withInput();
        }
        
        $categorias = new Categoria;
        $categorias->categoria = $data['categoria'];
        $categorias->save();
        


        return redirect()->route('categorias.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function show(Categoria $categoria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $categorias = Categoria::find($id);
        return view('admin.categoria.edit', ['categorias' => $categorias]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $categoria = Categoria::find($id);
        if($categoria){
            $data = $request->only(['categoria']);
            
            $validator = Validator::make([
            'categoria' => $data['categoria']
            ],
            ['categoria' => ['string']]);
        
            
            if($validator->errors()){
            return redirect()->route('categorias.edit',[
                'categoria' => $id
            ])
            ->withErrors($validator)->withInput();
            }
            dd($validator);
            $categoria->categoria = $data['categoria'];
            
            $categoria->save();
        }
        return redirect()->route('categorias.index');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categoria = Categoria::find($id);
        $categoria->delete();

        return redirect()->route('categorias.index');
    }
}
