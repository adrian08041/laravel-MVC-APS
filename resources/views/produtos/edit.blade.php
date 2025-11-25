@extends('layouts.app')

@section('title', 'Editar Produto')

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-header bg-warning">
                <h5 class="mb-0">Editar Produto</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('produtos.update', $produto) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome do Produto *</label>
                        <input
                            type="text"
                            class="form-control @error('nome') is-invalid @enderror"
                            id="nome"
                            name="nome"
                            value="{{ old('nome', $produto->nome) }}"
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
                            required>{{ old('descricao', $produto->descricao) }}</textarea>
                        @error('descricao')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="imagem" class="form-label">Imagem do Produto</label>

                        @if($produto->imagem)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $produto->imagem) }}" alt="{{ $produto->nome }}" style="max-width: 200px; height: auto; border-radius: 4px;">
                                <p class="form-text">Imagem atual</p>
                            </div>
                        @endif

                        <input
                            type="file"
                            class="form-control @error('imagem') is-invalid @enderror"
                            id="imagem"
                            name="imagem"
                            accept="image/png, image/jpeg, image/jpg">
                        <div class="form-text">Formatos aceitos: PNG, JPG, JPEG (máx. 2MB). Deixe em branco para manter a imagem atual.</div>
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
                                value="{{ old('preco', $produto->preco) }}"
                                step="0.01"
                                min="0"
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
                                value="{{ old('estoque', $produto->estoque) }}"
                                min="0"
                                required>
                            @error('estoque')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-warning">
                            <i class="bi bi-check-circle"></i> Atualizar Produto
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
