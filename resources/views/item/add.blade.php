@extends('adminlte::page')

@section('title', '商品登録')

@section('content_header')
    <h1>商品登録</h1>
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
                <form method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="image">商品画像<span class="badge badge-danger ml-2">必須</span></label>
                            <input type="file" class="form-control-file" id="image" name="image">
                        </div>

                        <div class="form-group">
                            <label for="name">商品名<span class="badge badge-danger ml-2">必須</span></label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="100文字以内">
                        </div>

                        <div class="form-group">
                            <label for="item_number">品番<span class="badge badge-danger ml-2">必須</span></label>
                            <input type="text" class="form-control" id="item_number" name="item_number" placeholder="ABCD123456">
                        </div>

                        <div class="form-group">
                            <label for="category">カテゴリー<span class="badge badge-danger ml-2">必須</span></label>
                            <select class="form-control" name="category">
                                <option value="アウター" selected>アウター</option>
                                <option value="トップス">トップス</option>
                                <option value="ボトムス">ボトムス</option>
                                <option value="シューズ">シューズ</option>
                                <option value="小物">小物</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="size">サイズ<span class="badge badge-danger ml-2">必須</span></label>
                            <select class="form-control" name="size">
                                <option value="S" selected>S</option>
                                <option value="M">M</option>
                                <option value="L">L</option>
                                <option value="XL">XL</option>
                                <option value="F">F</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="price">価格<span class="badge badge-danger ml-2">必須</span></label>
                            <input type="text" class="form-control" id="price" name="price" placeholder="1,000,000">
                        </div>

                        <div class="form-group">
                            <label for="stock">在庫<span class="badge badge-danger ml-2">必須</span></label>
                            <input type="number" min="0" max="50" value="50" class="form-control" id="stock" name="stock">
                        </div>

                        <div class="form-group">
                            <label for="note">備考（300文字以内）</label><br>
                            <textarea id="note" name="note" cols="75" rows="2" maxlength="300"></textarea>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">登録</button>
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
