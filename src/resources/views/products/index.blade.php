@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="content-title">
    <h2>商品一覧</h2>
    <a href="{{ route('products.register') }}" class="button btn-register">
        + 商品を追加
    </a>
</div>
<div class="container">
    <form class="content-search" method="get" action="{{ route('products') }}">
        <input class="content-search_keyword-input" type="text" name="search" placeholder="商品名で検索" value="{{ $keyword }}">

        <input class="content-search_btn" type="submit" value="検索">

        @php $currentOrder = old('order', $sortOrder); @endphp

        <label for="sort" class="sort-title">価格順で表示</label>
        <select id="sort" class="sort-input" name="order" onchange="this.form.submit()">
            <option value="" disabled {{ $currentOrder ? '' : 'selected' }}>価格で並び替え</option>
            <option value="price_desc" {{ $currentOrder === 'price_desc' ? 'selected' : '' }}>高い順に表示</option>
            <option value="price_asc"  {{ $currentOrder === 'price_asc'  ? 'selected' : '' }}>低い順に表示</option>
        </select>

        @if ($currentOrder)
            <div class="filter-tags">
                <span class="tag-pill">
                    {{ $currentOrder === 'price_desc' ? '高い順に表示' : '低い順に表示' }}
                    <a href="{{ route('products', array_merge(request()->except('order'), ['page' => 1])) }}" class="tag-close">×</a>
                </span>
            </div>
        @endif
    </form>

    <section class="content-card">
        <ul class="card-list">
            @foreach ($products as $product)
                <li class="card-item">
                    <a href="{{ route('products.detail', $product->id) }}" class="card-link">
                        <img src="{{ $product->image }}" alt="{{ $product->name }}" loading="lazy">
                        <div class="card-info">
                            <span class="card-name">{{ $product->name }}</span>
                            <span class="card-price">￥{{ number_format($product->price) }}</span>
                        </div>
                    </a>
                </li>
            @endforeach
        </ul>
        <div class="filter-pager">
            {{ $products->onEachSide(1)->links('pagination') }}
        </div>
    </section>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const select = document.getElementById('sort');
    if (!select) return;
    const update = () => select.classList.toggle('is-placeholder', !select.value);
    select.addEventListener('change', update);
    update();
});
</script>

@endsection