@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
<div class="register-container">
    <h2 class="register-title">商品登録</h2>

    <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="field">
            <label class="label">商品名
                <span class="required-mark">必須</span>
            </label>
            <input type="text" name="name" class="form-control" placeholder="商品名を入力" value="{{ old('name') }}">
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
            <input type="number" name="price" class="form-control" placeholder="値段を入力" value="{{ old('price') }}">
            @error('price')
                <div class="error-text">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="field">
            <label class="label">商品画像
                <span class="required-mark">必須</span>
            </label>
            <input type="file" name="image" accept=".png,.jpg,.jpeg" onchange="previewImage(this)">
            @error('image')
                <div class="error-text">
                    {{ $message }}
                </div>
            @enderror
            <img id="imgPreview" class="img-preview" style="display:none;" alt="image preview">
        </div>

        <div class="field">
            <label class="label">季節
                <span class="required-mark">必須</span>
            </label>

            @foreach(($seasons ?? []) as $season)
                <label class="season-option">
                    <input type="checkbox" name="seasons[]" value="{{ $season->id }}" {{ in_array($season->id, old('seasons', [])) ? 'checked' : '' }}>
                    {{ $season->name }}
                </label>
            @endforeach

            @error('seasons')
                <div class="error-text">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="field">
            <label class="label">商品説明
                <span class="req">必須</span>
            </label>
            <textarea name="description" class="form-control" placeholder="商品の説明を入力">{{ old('description') }}</textarea>
            @error('description')
                <div class="error-text">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="actions">
            <a class="button btn-secondary" href="{{ route('products') }}">戻る</a>
            <button class="button btn-register" type="submit">登録</button>
        </div>
    </form>
</div>

<script>
    function previewImage(input) {
        const img = document.getElementById('imgPreview');
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = e => { img.src = e.target.result; img.style.display = 'block'; };
            reader.readAsDataURL(input.files[0]);
        } else {
            img.src = ''; img.style.display = 'none';
        }
    }
</script>
@endsection