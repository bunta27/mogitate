@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="css/detail.css">
@endsection

@section('content')
<div class="container">
    <a href="{{ route('products') }}" class="btn-back">← 商品一覧に戻る</a>

    <div class="product-detail">
        <h2>{{ $product->name }}</h2>

        @if($product->image)
            <img src="{{ $product->image }}" alt="{{ $product->name }}" class="detail-image">
        @endif

        <p class="price">¥{{ number_format($product->price) }}</p>

        @if($product->description)
            <p class="description">{{ $product->description }}</p>
        @endif
    </div>
</div>
@endsection