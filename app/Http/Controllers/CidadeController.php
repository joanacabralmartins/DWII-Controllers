<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CidadeController extends Controller
{
    public $cidades = [[
        'id' => 1,
        'nome'  => 'Porto Alegre',
        'porte' => 'Grande'
    ]];

    public function __construct() {

        $aux = session('cidades');

        if(!isset($aux)) {
            session(['cidades' => $this->cidades]);
        }
    }

    public function index()
    {
        $cidades = session('cidades');
       
       return view('cidades.index', compact('cidades'));
    }

    public function create()
    {
        return view('cidades.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $aux = session('cidades');
       
       $ids = array_column($aux, 'id');
       
       if(count($ids) > 0) {
           $new_id = max($ids) + 1;
       }
       else {
           $new_id = 1;
       }
       
       $novo = [  
           'id' => $new_id,
           'nome' => $request->nome,
           'porte' => $request->porte
       ];
       
       array_push($aux, $novo);
       
       session(['cidades' => $aux]);
       
       return redirect()->route('cidades.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $aux = session('cidades');

       $indice = array_search($id, array_column($aux, 'id'));

       $dados = $aux[$indice];
       
       return view('cidades.show', compact('dados'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
       $aux = session('cidades');

       $indice = array_search($id, array_column($aux, 'id'));

       $dados = $aux[$indice];

       return view('cidades.edit', compact('dados')); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $alterado = [
            'id' => $id,
            'nome' => $request->nome,
            'porte' => $request->porte
            ];
    
            $aux = session('cidades');
            
            $indice = array_search($id, array_column($aux, 'id'));
            
            $aux[$indice] = $alterado;
            
            session(['cidades' => $aux]);
            
            return redirect()->route('cidades.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         $aux = session('cidades');

         $indice = array_search($id, array_column($aux, 'id'));
         
         unset($aux[$indice]);
         
         session(['cidades' => $aux]);
         
         return redirect()->route('cidades.index');
    }
}
