@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="css/products.css">
@endsection

@section('content')
<div class="content-title">
    <h2>商品一覧</h2>
    <input href="products.register" type="submit" value="+ 商品を追加">
</div>
<div class="container">
    <form class="content-search" method="get" action="{{ route('products') }}">
        <input class="content-search_keyword-input" type="text" name="search" placeholder="商品名で検索" value="{{ $searchKeyword }}">
        <input class="content-search_btn" type="submit" value="検索">
        <label for="sort">価格順で表示</label>
        <select class="sort-input" name="order" >
            <option disabled selected>価格で並び替え</option>
            <option value="price_desc" @selected($sortOrder === 'price_desc')>高い順に表示</option>
            <option value="price_asc" @selected($sortOrder === 'price_asc')>低い順に表示</option>
        </select>
    </form>
    <section class="content-card">
        <ul class="card-list">
            @foreach ($products as $product)
                <li class="card-item">
                    <img src="" alt="" srcset="">
                </li>
        </ul>
        <div class="filter-pager">
            {{ $products->onEachSide(1)->links('pagination') }}
        </div>
    </section>
</div>