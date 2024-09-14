@extends('adminlte::page')

@section('title', '商品一覧')

@section('content_header')
    <h1>商品一覧</h1>
@stop

@section('content')
    <div class="row justify-content-end mr-3">
        <a href="{{ url('items/add') }}" class="btn-sm btn-success mb-3">商品登録</a>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>商品画像</th>
                                <th>商品名</th>
                                <th>品番</th>
                                <th>カテゴリー</th>
                                <th>サイズ</th>
                                <th>価格</th>
                                <th>在庫</th>
                                <th>詳細</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td><img src="data:image/jpeg;base64,{{ $item->image }}" alt="商品画像"></td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->item_number }}</td>
                                    <td>{{ $item->category }}</td>
                                    <td>{{ $item->size }}</td>
                                    <td>{{ $item->price }}</td>
                                    <td>{{ $item->stock }}</td>
                                    <td>{{ $item->detail }}</td>
                                    <div class="btn-group">
                                        <td>
                                            <a href="items/{{$item->id}}/edit" class="btn-sm btn-info mb-3">編集</a>
                                            <!-- <a href="{{ url('items/delete') }}" class="btn-sm btn-danger mb-3">削除</a> -->
                                        </td>
                                    </div>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
<link rel="stylesheet" href="/css/index.css">
@stop

@section('js')
@stop
