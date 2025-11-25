@extends('layouts.app')

@section('title', 'Produtos')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Gerenciamento de Produtos</h1>
            <div>
                <form method="POST" action="{{ route('preferences.toggleView') }}" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-outline-secondary btn-sm me-2">
                        <i class="bi bi-grid"></i> Alternar Visualização
                    </button>
                </form>
                <a href="{{ route('produtos.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle"></i> Novo Produto
                </a>
            </div>
        </div>

        <!-- Error Messages -->
        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Erro:</strong>
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        @if($produtos->isEmpty())
            <div class="alert alert-info">
                Nenhum produto cadastrado ainda. Clique em "Novo Produto" para adicionar o primeiro produto!
            </div>
        @else
            @php
                $viewMode = request()->cookie('view_mode', 'grid');
            @endphp

            @if($viewMode === 'grid')
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    @foreach($produtos as $produto)
                        <div class="col">
                            <div class="card h-100">
                                @if($produto->imagem)
                                    <img src="{{ asset('storage/' . $produto->imagem) }}" class="card-img-top" alt="{{ $produto->nome }}" style="height: 200px; object-fit: cover;">
                                @else
                                    <div class="bg-secondary text-white d-flex align-items-center justify-content-center" style="height: 200px;">
                                        <span>Sem Imagem</span>
                                    </div>
                                @endif
                                <div class="card-body">
                                    <h5 class="card-title">{{ $produto->nome }}</h5>
                                    <p class="card-text">{{ Str::limit($produto->descricao, 80) }}</p>
                                    <p class="card-text">
                                        <strong class="text-primary">R$ {{ number_format($produto->preco, 2, ',', '.') }}</strong>
                                    </p>
                                    <p class="card-text">
                                        <small class="text-muted">Estoque:
                                            <span class="badge {{ $produto->estoque > 0 ? 'bg-success' : 'bg-danger' }}">
                                                {{ $produto->estoque }}
                                            </span>
                                        </small>
                                    </p>
                                </div>
                                <div class="card-footer bg-transparent">
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('produtos.edit', $produto) }}" class="btn btn-sm btn-warning flex-fill">
                                            <i class="bi bi-pencil"></i> Editar
                                        </a>
                                        <form method="POST" action="{{ route('produtos.destroy', $produto) }}" class="flex-fill" onsubmit="return confirm('Deseja realmente excluir este produto?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger w-100">
                                                <i class="bi bi-trash"></i> Excluir
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>Imagem</th>
                                <th>Nome</th>
                                <th>Descrição</th>
                                <th>Preço</th>
                                <th>Estoque</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($produtos as $produto)
                                <tr>
                                    <td>
                                        @if($produto->imagem)
                                            <img src="{{ asset('storage/' . $produto->imagem) }}" alt="{{ $produto->nome }}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 4px;">
                                        @else
                                            <div class="bg-secondary text-white d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; border-radius: 4px; font-size: 10px;">
                                                Sem Img
                                            </div>
                                        @endif
                                    </td>
                                    <td><strong>{{ $produto->nome }}</strong></td>
                                    <td>{{ Str::limit($produto->descricao, 50) }}</td>
                                    <td><strong class="text-primary">R$ {{ number_format($produto->preco, 2, ',', '.') }}</strong></td>
                                    <td>
                                        <span class="badge {{ $produto->estoque > 0 ? 'bg-success' : 'bg-danger' }}">
                                            {{ $produto->estoque }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('produtos.edit', $produto) }}" class="btn btn-sm btn-warning">
                                                <i class="bi bi-pencil"></i> Editar
                                            </a>
                                            <form method="POST" action="{{ route('produtos.destroy', $produto) }}" class="d-inline" onsubmit="return confirm('Deseja realmente excluir este produto?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="bi bi-trash"></i> Excluir
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        @endif
    </div>
</div>
@endsection
