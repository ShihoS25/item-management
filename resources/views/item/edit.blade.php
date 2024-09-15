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

            <div class="card card-primary">
                <form method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <input type="hidden" class="form-control-file" id="id" name="id" value="{{ $item->id }}">

                        <div class="form-group">
                            <img src="data:image/jpeg;base64,{{ $item->image }}" alt="商品画像">
                            <input type="file" class="form-control-file" id="image" name="image">
                        </div>

                        <div class="form-group">
                            <label for="name">商品名</label>
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
                            <label for="price">価格</label>
                            <input type="text" class="form-control" id="price" name="price" value="{{ $item->price }}">
                        </div>

                        <div class="form-group">
                            <label for="stock">在庫</label>
                            <input type="number" min="0" max="50" class="form-control" id="stock" name="stock" value="{{ $item->stock }}">
                        </div>

                        <div class="form-group">
                            <label for="note">備考（300文字以内）</label><br>
                            <textarea id="note" name="note" cols="75" rows="2" maxlength="300">{{ $item->note }}</textarea>
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
@stop

@section('js')
@stop
