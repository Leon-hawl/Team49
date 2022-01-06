@extends('includes.header')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-header text-center">
                <h2 class="card-text">{{ config('const.title.add', 'add') }}</h2>
            </div>
            @if ( $errors -> any() )
                <div class="alert alert-danger mt-2">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="border-bottom p-2">
                <div class="text-center">
                    <a href="https://www.google.com/" class="card-text" target=”_blank”>google検索</a>
                </div>
            </div>
            <div class="card-body">

            <form action="{{ route('fav.store') }}" method="POST">
                @csrf
                    <div class="form-group">
                        <label for="site_name">{{ config('const.service.name', 'name') }}</label>
                        <input type="text" class="form-control" placeholder="サイト名を入力してください" name="site_name">
                    </div>
                    <div class="form-group">
                        <label for="site_url">{{ config('const.service.url', 'url') }}</label>
                        <input type="text" class="form-control" placeholder="urlを入力してください" name="site_url">
                    </div>
                    <div class="form-group">
                        <label for="memo">{{ config('const.service.memo', 'service.memo') }}</label>
                        <input type="text" class="form-control" name="memo">
                    </div>
                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                    <div class="mb-2">
                        <button class="btn btn-outline-primary" type="submit">{{ config('const.button.new', 'new') }}</button>
                    </div>
                </form>

            </div>
            <div class="border-bottom"></div>
            <div>
                <a class="btn btn-sm btn-outline-dark mt-2 ml-4" href="{{ route('fav.show', $user->id) }}">{{ config('const.button.service', 'service') }}</a>
            </div>
            @if(Auth::user()->manager_flg == 1)
            <div class>
                <a href="{{ route('seniorList.index', $user->id) }}" class="btn btn-sm btn-outline-dark mt-2 ml-4">{{ config('const.button.senior', 'senior') }}</a>
            </div>
            @endif
        </div>



    </div>


</div>
@endsection
