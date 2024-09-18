@extends('adminlte::page')

@section('title', '商品登録')

@section('content_header')
    <h1>商品編集</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-10">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card card-primary w-75">
                <form method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <input type="hidden" class="form-control-file" id="id" name="id" value="{{ $item->id }}">
                        </div>

                        <div class="form-group-img">
                            <img src="data:image/jpeg;base64,{{ $item->image }}" alt="商品画像">
                            <input type="file" class="form-control-file" id="image" name="image">
                        </div>

                        <div class="form-group">
                            <label for="name">商品名（100文字まで）</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $item->name }}">
                        </div>

                        <div class="form-group">
                            <label for="item_number">品番</label>
                            <input type="text" class="form-control" id="item_number" name="item_number" value="{{ $item->item_number }}">
                        </div>

                        <div class="form-group">
                            <label for="category">カテゴリー</label>
                            <select class="form-control" name="category">
                                <option value="アウター" {{ $item->category == 'アウター' ? 'selected' : '' }}>アウター</option>
                                <option value="トップス" {{ $item->category == 'トップス' ? 'selected' : '' }}>トップス</option>
                                <option value="ボトムス" {{ $item->category == 'ボトムス' ? 'selected' : '' }}>ボトムス</option>
                                <option value="シューズ" {{ $item->category == 'シューズ' ? 'selected' : '' }}>シューズ</option>
                                <option value="小物" {{ $item->category == '小物' ? 'selected' : '' }}>小物</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="size">サイズ</label>
                            <select class="form-control" name="size">
                                <option value="S" {{ $item->size == 'S' ? 'selected' : '' }}>S</option>
                                <option value="M" {{ $item->size == 'M' ? 'selected' : '' }}>M</option>
                                <option value="L" {{ $item->size == 'L' ? 'selected' : '' }}>L</option>
                                <option value="XL" {{ $item->size == 'XL' ? 'selected' : '' }}>XL</option>
                                <option value="F" {{ $item->size == 'F' ? 'selected' : '' }}>F</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="material">素材</label>
                            <input type="text" class="form-control" id="material" name="material" value="{{ $item->material }}">
                        </div>

                        <div class="form-group">
                            <label for="price">価格</label>
                            <input type="number" min="0" max="20000" value="{{ $item->price }}" class="form-control" id="price" name="price">
                        </div>

                        <div class="form-group">
                            <label for="stock">在庫</label>
                            <input type="number" min="0" max="500" value="{{ $item->stock }}" class="form-control" id="stock" name="stock">
                        </div>

                        <div class="form-group">
                            <label for="description">商品説明（500文字まで）</label><br>
                            <textarea id="description" name="description" class="form-control" rows="3">{{ $item->description }}</textarea>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">更新</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('css')
<link rel="stylesheet" href="/css/item/edit.css">
@stop

@section('js')
@stop
