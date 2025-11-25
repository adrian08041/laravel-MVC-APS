@extends('layouts.app')

@section('title', 'Novo Produto')

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Cadastrar Novo Produto</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('produtos.store') }}" method="POST" enctype="multipart/form-data">
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
                            rows="4"
                            placeholder="Descreva o produto..."
                            required>{{ old('descricao') }}</textarea>
                        @error('descricao')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="imagem" class="form-label">Imagem do Produto</label>
                        <input
                            type="file"
                            class="form-control @error('imagem') is-invalid @enderror"
                            id="imagem"
                            name="imagem"
                            accept="image/png, image/jpeg, image/jpg">
                        <div class="form-text">Formatos aceitos: PNG, JPG, JPEG (máx. 2MB)</div>
                        @error('imagem')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
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

                        <div class="col-md-6 mb-3">
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
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-circle"></i> Cadastrar Produto
                        </button>
                        <a href="{{ route('produtos.index') }}" class="btn btn-secondary">
                            <i class="bi bi-x-circle"></i> Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
