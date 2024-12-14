@extends('adminlte::page')

@section('title', 'アカウント設定画面')

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

    <div class="container vh-100">
        <div class="row justify-content-center w-100 p-5">
            <div class="col-md-6">
                <div class="text-center m-2">
                    <img src="../img/profile.png" alt="プロフィールアイコン">
                </div>

                <form method="POST" action="/account">
                    @csrf
                    <div class="form-group">
                        <label for="name">名前</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{old('name', $user->name)}}" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="email">メールアドレス</label>
                        <input type="text" class="form-control" id="email" name="email" value="{{old('email', $user->email)}}" required>
                    </div>

                    <div class="float-right mt-2">
                        <button type="button" class="btn btn-secondary mr-2" onclick="location.href='/account/password'">パスワード変更</button>
                        <button type="submit" class="btn btn-danger">変更</button>
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
