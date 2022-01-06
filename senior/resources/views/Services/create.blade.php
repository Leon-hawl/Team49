@extends('includes.header')


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-header text-center">
                <p class="card-text">入居者登録</p>
            </div>
            <div>
            <form class="d-flex" method="GET" action="{{ route('seniorList.create') }}">
            @csrf
                <input class="form-control me-2" type="search" name="search" placeholder="名前で検索" aria-label="検索" value="{{ request('search') }}">
                <input class="btn btn-outline-success" type="submit" value="検索"></input>
            </form>
            </div>
            <div class="card-body">
                <h5 class="card-title text-center">
                    検索してね
                </h5>
            </div>

        </div>
        <div class="col-md-2">
            <a href="{{ route('seniorList.index') }}" class="btn btn-outline-success">戻る</a>
        </div>
    </div>

</div>
@endsection
