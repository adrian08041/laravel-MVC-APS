<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{

    public function index()
    {

        $categorias = Categoria::orderBy('created_at', 'desc')->get();


        return view('categorias.index', compact('categorias'));
    }


    public function create()
    {
        return view('categorias.create');
    }


    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'nome' => 'required|string|max:255|unique:categorias,nome',
            'descricao' => 'required|string|max:500',
        ], [
            'nome.required' => 'O nome da categoria é obrigatório.',
            'nome.unique' => 'Já existe uma categoria com este nome.',
            'descricao.required' => 'A descrição é obrigatória.',
        ]);


        Categoria::create($validatedData);


        return redirect()->route('categorias.index')
            ->with('success', 'Categoria cadastrada com sucesso!');
    }


    public function edit(Categoria $categoria)
    {
        return view('categorias.edit', compact('categoria'));
    }


    public function update(Request $request, Categoria $categoria)
    {

        $validatedData = $request->validate([
            'nome' => 'required|string|max:255|unique:categorias,nome,' . $categoria->id,
            'descricao' => 'required|string|max:500',
        ], [
            'nome.required' => 'O nome da categoria é obrigatório.',
            'nome.unique' => 'Já existe uma categoria com este nome.',
            'descricao.required' => 'A descrição é obrigatória.',
        ]);


        $categoria->update($validatedData);


        return redirect()->route('categorias.index')
            ->with('success', 'Categoria atualizada com sucesso!');
    }


    public function destroy(Categoria $categoria)
    {

        $categoria->delete();


        return redirect()->route('categorias.index')
            ->with('success', 'Categoria excluída com sucesso!');
    }
}
