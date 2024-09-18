@extends('adminlte::page')

@section('title', '商品検索')

@section('content_header')
    <h1>商品検索</h1>
@stop

@section('content')
    <form action="/search/result" method="GET">
        @csrf
        <hr>
        <div class="form-group w-25">
            <label for="priceRange">価格</label>
            <input type="range" class="form-control-range" id="priceRange" name="priceRange" min="0" max="20000" step="500" value="{{ request()->input('priceRange', 20000) }}">
            <p>0円～<span id="currentValue"></span>円</p>
        </div>

        <hr>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" id="category1" name="categories[]" value="アウター" {{ in_array('アウター', request()->input('categories', [])) ? 'checked' : '' }}>
            <label class="form-check-label" for="category1">アウター</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" id="category2" name="categories[]" value="トップス" {{ in_array('トップス', request()->input('categories', [])) ? 'checked' : '' }}>
            <label class="form-check-label" for="category2">トップス</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" id="category3" name="categories[]" value="ボトムス" {{ in_array('ボトムス', request()->input('categories', [])) ? 'checked' : '' }}>
            <label class="form-check-label" for="category3">ボトムス</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" id="category4" name="categories[]" value="シューズ" {{ in_array('シューズ', request()->input('categories', [])) ? 'checked' : '' }}>
            <label class="form-check-label" for="category4">シューズ</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" id="category5" name="categories[]" value="小物" {{ in_array('小物', request()->input('categories', [])) ? 'checked' : '' }}>
            <label class="form-check-label" for="category5">小物</label>
        </div>

        <hr>
        <button type="submit" class="btn-secondary btn-sm">検索</button>
    </form>
    <br>

    <!-- 検索結果 -->
    @if (isset($items))
    <p>{{ count($items) }}<span class="itemCount">件ヒットしました。</span></p>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>商品画像</th>
                                <th>商品名</th>
                                <th>品番</th>
                                <th>カテゴリー</th>
                                <th>サイズ</th>
                                <th>素材</th>
                                <th>価格</th>
                                <th>在庫</th>
                                <th>商品説明</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    <td><img src="data:image/jpeg;base64,{{ $item->image }}" alt="商品画像"></td>
                                    <td class="longtxt">{{ $item->name }}</td>
                                    <td>{{ $item->item_number }}</td>
                                    <td>{{ $item->category }}</td>
                                    <td>{{ $item->size }}</td>
                                    <td>{{ $item->material }}</td>
                                    <td>{{ number_format($item->price) }}円</td>
                                    <td>{{ $item->stock }}個</td>
                                    <td class="longtxt">{!!nl2br($item->description)!!}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endif
@stop

@section('css')
<link rel="stylesheet" href="/css/search/index.css">
@stop

@section('js')
<script src="/js/search/index.js"></script>
@stop