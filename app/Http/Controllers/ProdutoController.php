<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProdutoController extends Controller
{

    public function index()
    {

        $produtos = Produto::orderBy('created_at', 'desc')->get();


        return view('produtos.index', compact('produtos'));
    }


    public function create()
    {
        return view('produtos.create');
    }


    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'required|string|max:1000',
            'imagem' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            'preco' => 'required|numeric|min:0',
            'estoque' => 'required|integer|min:0',
        ], [
            'nome.required' => 'O nome do produto é obrigatório.',
            'descricao.required' => 'A descrição é obrigatória.',
            'imagem.image' => 'O arquivo deve ser uma imagem.',
            'imagem.mimes' => 'A imagem deve ser do tipo: jpeg, jpg ou png.',
            'imagem.max' => 'A imagem não pode ter mais de 2MB.',
            'preco.required' => 'O preço é obrigatório.',
            'preco.numeric' => 'O preço deve ser um número válido.',
            'estoque.required' => 'O estoque é obrigatório.',
            'estoque.integer' => 'O estoque deve ser um número inteiro.',
        ]);


        if ($request->hasFile('imagem')) {
            $imagePath = $request->file('imagem')->store('produtos', 'public');
            $validatedData['imagem'] = $imagePath;
        }


        Produto::create($validatedData);


        return redirect()->route('produtos.index')
            ->with('success', 'Produto cadastrado com sucesso!');
    }


    public function edit(Produto $produto)
    {
        return view('produtos.edit', compact('produto'));
    }


    public function update(Request $request, Produto $produto)
    {

        $validatedData = $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'required|string|max:1000',
            'imagem' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            'preco' => 'required|numeric|min:0',
            'estoque' => 'required|integer|min:0',
        ], [
            'nome.required' => 'O nome do produto é obrigatório.',
            'descricao.required' => 'A descrição é obrigatória.',
            'imagem.image' => 'O arquivo deve ser uma imagem.',
            'imagem.mimes' => 'A imagem deve ser do tipo: jpeg, jpg ou png.',
            'imagem.max' => 'A imagem não pode ter mais de 2MB.',
            'preco.required' => 'O preço é obrigatório.',
            'preco.numeric' => 'O preço deve ser um número válido.',
            'estoque.required' => 'O estoque é obrigatório.',
            'estoque.integer' => 'O estoque deve ser um número inteiro.',
        ]);


        if ($request->hasFile('imagem')) {

            if ($produto->imagem) {
                Storage::disk('public')->delete($produto->imagem);
            }

            $imagePath = $request->file('imagem')->store('produtos', 'public');
            $validatedData['imagem'] = $imagePath;
        }


        $produto->update($validatedData);


        return redirect()->route('produtos.index')
            ->with('success', 'Produto atualizado com sucesso!');
    }


    public function destroy(Produto $produto)
    {

        if ($produto->imagem) {
            Storage::disk('public')->delete($produto->imagem);
        }


        $produto->delete();


        return redirect()->route('produtos.index')
            ->with('success', 'Produto excluído com sucesso!');
    }
}
