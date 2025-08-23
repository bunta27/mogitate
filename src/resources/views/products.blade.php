@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="css/products.css">
@endsection

@section('content')
<div class="content-title">
    <h2>商品一覧</h2>
    <input href="register" type="submit" value="+ 商品を追加">
</div>
<div class="container">
    <div class="content-search">
        <input class="content-search_keyword-input" type="text" name="name" placeholder="商品名で検索">
        <input class="content-search_btn" type="submit" value="検索">
        <label for="sort">価格順で表示</label>
        <select class="sort-input">
            <option disabled selected>価格で並び替え</option>
            <option value="">高い順に表示</option>
            <option value="">低い順に表示</option>
        </select>
    </div>
    <section class="content-card">
        <ul class="card-list">
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
        </ul>
    </section>
</div>