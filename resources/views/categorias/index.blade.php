@extends('layouts.app')

@section('title', 'Categorias')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Gerenciamento de Categorias</h1>
            <a href="{{ route('categorias.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Nova Categoria
            </a>
        </div>

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
        @if($categorias->isEmpty())
            <div class="alert alert-info">
                Nenhuma categoria cadastrada ainda. Clique em "Nova Categoria" para adicionar a primeira categoria!
            </div>
        @else
            <div class="row">
                @foreach($categorias as $categoria)
                    <div class="col-md-4 mb-3">
                        <div class="card h-100">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <span class="badge bg-primary">{{ $categoria->id }}</span>
                                    {{ $categoria->nome }}
                                </h5>
                                <p class="card-text">{{ $categoria->descricao }}</p>
                                <hr>
                                <small class="text-muted">
                                    Cadastrado em: {{ $categoria->created_at->format('d/m/Y \à\s H:i') }}
                                </small>
                            </div>
                            <div class="card-footer bg-transparent">
                                <div class="d-flex gap-2">
                                    <a href="{{ route('categorias.edit', $categoria) }}" class="btn btn-sm btn-warning flex-fill">
                                        <i class="bi bi-pencil"></i> Editar
                                    </a>
                                    <form method="POST" action="{{ route('categorias.destroy', $categoria) }}" class="flex-fill" onsubmit="return confirm('Deseja realmente excluir esta categoria?')">
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
        @endif
    </div>
</div>
@endsection
