<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    
    public function index()
    {
       
        $produtos = Produto::orderBy('created_at', 'desc')->get();

       
        return view('produtos.index', compact('produtos'));
    }

   
    public function store(Request $request)
    {
       
        $validatedData = $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'required|string|max:1000',
            'preco' => 'required|numeric|min:0',
            'estoque' => 'required|integer|min:0',
        ], [
            'nome.required' => 'O nome do produto é obrigatório.',
            'descricao.required' => 'A descrição é obrigatória.',
            'preco.required' => 'O preço é obrigatório.',
            'preco.numeric' => 'O preço deve ser um número válido.',
            'estoque.required' => 'O estoque é obrigatório.',
            'estoque.integer' => 'O estoque deve ser um número inteiro.',
        ]);

       
        Produto::create($validatedData);

        
        return redirect()->route('produtos.index')
            ->with('success', 'Produto cadastrado com sucesso!');
    }
}
