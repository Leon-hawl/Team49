@extends('includes.header')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-header text-center">
                <h2 class="card-text">{{ config('const.title.edit', 'edit') }}</h2>
            </div>
            <div class="border-bottom p-2">
                <div class="text-center">
                    <a href="https://www.google.com/" class="card-text" target=”_blank”>google検索</a>
                </div>
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

            <div class="card-body">
                <form action="{{ route('fav.update', $service->id) }}" method="POST">
                @csrf
                @method('PATCH')
                    <input type="hidden" value="{{ $service->user_id }}" name="user_id">
                    <div class="form-group">
                        <label for="site_name">{{ config('const.service.name', 'name') }}</label>
                        <input type="text" class="form-control" value="{{ $service->site_name }}" name="site_name">
                    </div>
                    <div class="form-group">
                        <label for="site_url">{{ config('const.service.url', 'url') }}</label>
                        <input type="text" class="form-control" value="{{ $service->site_url }}" name="site_url">
                    </div>
                    <div class="form-group">
                        <label for="memo">{{ config('const.service.memo', 'service.memo') }}</label>
                        <input type="text" class="form-control" name="memo" value="{{ $service->memo }}">
                    </div>
                    <li class="list-group list-group-horizontal">
                        <button type="submit" class="btn btn-outline-primary m-1">{{ config('const.button.update', 'update') }}</button>
                    </li>
                </form>
            </div>
            <div class="border-bottom m-2"></div>
            <div class="footer ml-2">
                <a href="{{ route('fav.show', $service->user_id) }}" class="btn btn-sm btn-outline-dark mt-2 ml-3">{{ config('const.button.back', 'back') }}</a>
            </div>
            @if(Auth::user()->manager_flg == 1)
            <div class>
                <a href="{{ route('seniorList.index', Auth::user()->id) }}" class="btn btn-sm btn-outline-dark mt-2 ml-4">{{ config('const.button.senior', 'senior') }}</a>
            </div>
            @endif
        </div>
    </div>


</div>
@endsection
