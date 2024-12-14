@extends('adminlte::page')

@section('title', '商品一覧')

@section('content_header')
    <h1>商品一覧<span>（全{{ $items->total() }}件）</span></h1>
@stop

@section('content')
    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    icon: 'success',
                    text: '{{ session('success') }}',
                    confirmButtonText: 'OK'
                });
            });
        </script>
    @endif

    <div class="row justify-content-end mr-2 mb-2">
        <a href="{{ url('items/add') }}" class="btn-sm btn-info">商品登録</a>
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
                                <th>@sortablelink('item_number', '品番')</th>
                                <th>@sortablelink('category', 'カテゴリー')</th>
                                <th>サイズ</th>
                                <th>素材</th>
                                <th>@sortablelink('price', '価格')</th>
                                <th>@sortablelink('stock', '在庫')</th>
                                <th>商品説明</th>
                                <th>@sortablelink('created_at', '登録日')</th>
                                <th>@sortablelink('updated_at', '更新日')</th>
                                <th>操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr class="{{ $item->stock <= 50 ? 'bg-warning' : '' }}">
                                    <td>{{ $item->id }}</td>
                                    <td><img src="data:image/jpeg;base64,{{ $item->image }}" alt="商品画像"></td>
                                    <td class="longtxt">{{ $item->name }}</td>
                                    <td>{{ $item->item_number }}</td>
                                    <td>{{ $item->category }}</td>
                                    <td>{{ $item->size }}</td>
                                    <td>{{ $item->material }}</td>
                                    <td>{{ number_format($item->price) }}円</td>
                                    <td>{{ $item->stock }}個</td>
                                    <td class="longtxt">{!!nl2br($item->description)!!}</td>
                                    <td>{{ date_format($item->created_at, 'Y-m-d') }}</td>
                                    <td>{{ date_format($item->updated_at, 'Y-m-d') }}</td>
                                    <td>
                                        <a href="items/{{$item->id}}/edit" class="btn-primary btn-sm">編集</a>
                                        <a href="#" class="btn-danger btn-sm" onclick="confirmDelete({{$item->id}})">削除</a>
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
        {{ $items->appends(request()->query())->links('pagination::bootstrap-4') }}
    </div>
@stop

@section('css')
<link rel="stylesheet" href="/css/item/index.css">
@stop

@section('js')
<script>
    function confirmDelete(itemId) {
        Swal.fire({
            title: "本当に削除しますか？",
            text: "一度削除したデータは復元できません。",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "削除する",
            cancelButtonText: "キャンセル"
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = `items/${itemId}/delete`;
            }
        });
    }
</script>
@stop