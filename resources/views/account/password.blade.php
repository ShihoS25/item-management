@extends('adminlte::page')

@section('title', 'パスワード変更画面')

@section('content_header')
@stop

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger w-50 mx-auto">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="container vh-100">
        <div class="row justify-content-center w-100 p-5">
            <div class="col-md-6">
                <div class="text-center m-2">
                    <img src="../img/profile.png" alt="プロフィールアイコン">
                </div>

                <form method="POST" action="/account/password">
                    @csrf
                    <div class="form-group">
                        <label for="current_password">現在のパスワード</label>
                        <input type="password" class="form-control" id="current_password" name="current_password">
                    </div>
                    
                    <div class="form-group">
                        <label for="new_password">新しいパスワード</label>
                        <input type="password" class="form-control" id="new_password" name="new_password" placeholder="８文字以上">
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">新しいパスワード（確認）</label>
                        <input type="password" class="form-control" id="password_confirmation" name="new_password_confirmation" placeholder="８文字以上">
                    </div>

                    <button type="submit" class="btn btn-danger float-right mt-2">変更</button>
                </form>
            </div>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
@stop
