@extends('adminlte::page')

@section('title', 'ホーム画面')

@section('content_header')
@stop

@section('content')
    <div class="jumbotron">
        <div class="container">
            <h1 class="display-4">WELCOME TO TECH SHOP ADMIN PAGE!</h1>
            <hr>
            <p class="lead">THIS IS THE ITEM MANAGEMENT SYSTEM.</p>
        </div>
    </div>

    <div class="container px-4 py-5" id="custom-cards">
    <h2 class="pb-2 border-bottom"><i class="fas fa-home"></i> HOME</h2>

    <div class="row row-cols-1 row-cols-lg-3 align-items-stretch g-4 py-5">
        <div class="col">
            <div class="card card-cover h-100 overflow-hidden text-bg-dark rounded-4 shadow-lg">
                <div class="d-flex flex-column h-100 p-5 pb-3 text-white text-shadow-1">
                    <h3 class="pt-5 mt-5 pb-5 display-6 lh-1 fw-bold"><a href="/items/add">商品登録</a></h3>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card card-cover h-100 overflow-hidden text-bg-dark rounded-4 shadow-lg">
                <div class="d-flex flex-column h-100 p-5 pb-3 text-white text-shadow-1">
                    <h3 class="pt-5 mt-5 pb-5 display-6 lh-1 fw-bold"><a href="/items">商品一覧</a></h3>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card card-cover h-100 overflow-hidden text-bg-dark rounded-4 shadow-lg">
                <div class="d-flex flex-column h-100 p-5 pb-3 text-white text-shadow-1">
                    <h3 class="pt-5 mt-5 pb-5 display-6 lh-1 fw-bold"><a href="/items/search">商品検索</a></h3>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/home.css">
@stop

@section('js')
@stop
