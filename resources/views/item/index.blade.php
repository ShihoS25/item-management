@extends('adminlte::page')

@section('title', '商品一覧')

@section('content_header')
    <h1>商品一覧</h1>
@stop

@section('content')
    <div class="row justify-content-end mr-3">
        <a href="{{ url('items/add') }}" class="btn-success btn-sm mb-3">商品登録</a>
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
                                <th>備考</th>
                                <th>操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr class="{{ $item->stock <= 10 ? 'bg-warning' : '' }}">
                                    <td>{{ $item->id }}</td>
                                    <td><img src="data:image/jpeg;base64,{{ $item->image }}" alt="商品画像"></td>
                                    <td class="item">{{ $item->name }}</td>
                                    <td>{{ $item->item_number }}</td>
                                    <td>{{ $item->category }}</td>
                                    <td>{{ $item->size }}</td>
                                    <td>{{ $item->price }}</td>
                                    <td>{{ $item->stock }}</td>
                                    <td class="item">{!!nl2br($item->note)!!}</td>
                                    <td>
                                        <a href="items/{{$item->id}}/edit" class="btn-primary btn-sm">編集</a>
                                        <a href="items/{{$item->id}}/delete" class="btn-danger btn-sm">削除</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-center">
        {{ $items->links('pagination::bootstrap-4') }}
    </div>
@stop

@section('css')
<link rel="stylesheet" href="/css/index.css">
@stop

@section('js')
@stop
