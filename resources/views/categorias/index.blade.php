@extends('layouts.app')

@section('title', 'Categorias')

@section('content')
<div class="row">
    <div class="col-md-12">
        <h1 class="mb-4">Gerenciamento de Categorias</h1>

        
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

      
        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Erro ao cadastrar categoria:</strong>
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
    
    <div class="col-md-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Cadastrar Nova Categoria</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('categorias.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome da Categoria *</label>
                        <input
                            type="text"
                            class="form-control @error('nome') is-invalid @enderror"
                            id="nome"
                            name="nome"
                            value="{{ old('nome') }}"
                            placeholder="Ex: Eletrônicos"
                            required>
                        @error('nome')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="descricao" class="form-label">Descrição *</label>
                        <textarea
                            class="form-control @error('descricao') is-invalid @enderror"
                            id="descricao"
                            name="descricao"
                            rows="4"
                            placeholder="Descreva a categoria..."
                            required>{{ old('descricao') }}</textarea>
                        @error('descricao')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">
                            Cadastrar Categoria
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-secondary text-white">
                <h5 class="mb-0">Lista de Categorias ({{ $categorias->count() }})</h5>
            </div>
            <div class="card-body">
                @if($categorias->isEmpty())
                    <div class="alert alert-info mb-0">
                        Nenhuma categoria cadastrada ainda. Use o formulário ao lado para adicionar a primeira categoria!
                    </div>
                @else
                    <div class="row">
                        @foreach($categorias as $categoria)
                            <div class="col-md-6 mb-3">
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
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
