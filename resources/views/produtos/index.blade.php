@extends('layouts.app')

@section('title', 'Produtos')

@section('content')
<div class="row">
    <div class="col-md-12">
        <h1 class="mb-4">Gerenciamento de Produtos</h1>

        <!-- Success Message -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Error Messages -->
        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Erro ao cadastrar produto:</strong>
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
    <!-- Formulário de Cadastro -->
    <div class="col-md-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Cadastrar Novo Produto</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('produtos.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome do Produto *</label>
                        <input
                            type="text"
                            class="form-control @error('nome') is-invalid @enderror"
                            id="nome"
                            name="nome"
                            value="{{ old('nome') }}"
                            placeholder="Ex: Notebook Dell"
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
                            rows="3"
                            placeholder="Descreva o produto..."
                            required>{{ old('descricao') }}</textarea>
                        @error('descricao')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="preco" class="form-label">Preço (R$) *</label>
                        <input
                            type="number"
                            class="form-control @error('preco') is-invalid @enderror"
                            id="preco"
                            name="preco"
                            value="{{ old('preco') }}"
                            step="0.01"
                            min="0"
                            placeholder="0.00"
                            required>
                        @error('preco')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="estoque" class="form-label">Estoque *</label>
                        <input
                            type="number"
                            class="form-control @error('estoque') is-invalid @enderror"
                            id="estoque"
                            name="estoque"
                            value="{{ old('estoque', 0) }}"
                            min="0"
                            placeholder="0"
                            required>
                        @error('estoque')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">
                            Cadastrar Produto
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Lista de Produtos -->
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-secondary text-white">
                <h5 class="mb-0">Lista de Produtos ({{ $produtos->count() }})</h5>
            </div>
            <div class="card-body">
                @if($produtos->isEmpty())
                    <div class="alert alert-info mb-0">
                        Nenhum produto cadastrado ainda. Use o formulário ao lado para adicionar o primeiro produto!
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Nome</th>
                                    <th>Descrição</th>
                                    <th>Preço</th>
                                    <th>Estoque</th>
                                    <th>Data de Cadastro</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($produtos as $produto)
                                    <tr>
                                        <td>{{ $produto->id }}</td>
                                        <td><strong>{{ $produto->nome }}</strong></td>
                                        <td>{{ Str::limit($produto->descricao, 50) }}</td>
                                        <td>R$ {{ number_format($produto->preco, 2, ',', '.') }}</td>
                                        <td>
                                            <span class="badge {{ $produto->estoque > 0 ? 'bg-success' : 'bg-danger' }}">
                                                {{ $produto->estoque }}
                                            </span>
                                        </td>
                                        <td>{{ $produto->created_at->format('d/m/Y H:i') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
