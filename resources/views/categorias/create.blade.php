@extends('layouts.app')

@section('title', 'Nova Categoria')

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">
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

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-circle"></i> Cadastrar Categoria
                        </button>
                        <a href="{{ route('categorias.index') }}" class="btn btn-secondary">
                            <i class="bi bi-x-circle"></i> Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
