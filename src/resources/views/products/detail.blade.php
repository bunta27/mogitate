@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="css/detail.css">
@endsection

@section('content')
<div class="detail-container">
    <p>
        <a href="{{ route('products') }}">
            商品一覧
        </a>
        ＞ {{ $product->name }}
    </p>

    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="detail-flex">
            <div class="detail-left">
                <img src="{{ $product->image }}" alt="{{ $product->name }}" class="img-preview">
                <div class="field">
                    <input type="file" name="image" accept=".png,.jpg,.jpeg">
                @error('image')
                    <div class="error-text">
                        {{ $message }}
                    </div>
                @enderror
                </div>
            </div>

            <div class="detail-right">
                <div class="field">
                    <label class="label">商品名
                        <span class="required-mark">必須</span>
                    </label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $product->name) }}">
                    @error('name')
                        <div class="error-text">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="field">
                    <label class="label">値段
                        <span class="required-mark">必須</span>
                    </label>
                    <input type="number" name="price" class="form-control" value="{{ old('price', $product->price) }}">
                    @error('price')
                        <div class="error-text">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="field">
                    <label class="label">季節
                        <span class="required-mark">必須</span>
                    </label>
                    @php
                        $checked = old('seasons', $product->seasons->pluck('id')->toArray());
                    @endphp
                    @foreach($seasons as $season)
                        <label class="season-option">
                            <input type="checkbox" name="seasons[]" value="{{ $season->id }}" {{ in_array($season->id, $checked) ? 'checked' : '' }}>
                                {{ $season->name }}
                        </label>
                    @endforeach
                    @error('seasons')
                        <div class="error-text">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="field description-field">
            <label class="label">商品説明
                <span class="required-mark">必須</span>
            </label>
            <textarea name="description" class="form-control" rows="5">
                {{ old('description', $product->description) }}
            </textarea>
            @error('description')
                <div class="error-text">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="actions">
            <a href="{{ route('products') }}" class="btn btn-secondary">戻る</a>
            <button type="submit" class="btn update-btn">変更を保存</button>
        </div>
    </form>

    <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="delete-form {{ $errors->any() ? 'hidden' : '' }}">
        @csrf
        <button type="submit" class="btn btn-danger delete-btn" title="削除">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" class="icon-trash">
                <polyline points="3 6 5 6 21 6"></polyline>
                <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"></path>
                <path d="M10 11v6"></path>
                <path d="M14 11v6"></path>
                <path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"></path>
            </svg>
        </button>
    </form>
@endsection