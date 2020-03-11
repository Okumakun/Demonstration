@extends('layouts.app')


@section('content')
    <div class="jumbotron">
        <div class="container">
            <h2 class="text-success"> Hello Tips</h2>
            <p class="text-primary">
               <span class="label label-default">妙笔生花</span> 、行云流水、一气呵成、淋漓尽致、满天星斗、洋洋洒洒、深入浅出、斐然成章、不忍卒读、鼻头生花、拍案叫绝
            </p>
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <button class="btn btn-log btn-success"> 火速发布</button>

                    @else
                        <a href="{{ route('login') }}">Login</a>
                        <a href="{{ route('register') }}">Register</a>
                    @endauth
                </div>
            @endif

        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">小贴士</div>

                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
