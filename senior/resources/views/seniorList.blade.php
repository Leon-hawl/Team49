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
            <div class="text-center mt-2 mb-2">
                <h5 class="card-title">{{ $resultMessage }}</h5>

            </div>
            @foreach ($users as $user)

            <div class="card-body">

                <ul class="list-unstyled col-2">
                    <li class="list-group list-group-horizontal col-md-2">
                        <p class="card-text">id:{{ $user->id }}</p>
                        <p class="card-text col-md-2">email:{{ $user->email }}</p>
                    </li>
                    <h5 class="card-title">名前:{{ $user->name }}</h5>
                </ul>
                <form class="d-flex" action="{{ route('seniorList.update', $user->id) }}" method="POST">
                @csrf
                @method('PATCH')
                    <input type="hidden" name="manager_id" value="{{ Auth::user()->id }}">
                    <button class="btn btn-outline-success" type="submit">add</button>
                </form>

            </div>
            <div class="card-footer text-muted">
            </div>

            @endforeach
        </div>
        <div class="col-md-2">
            <a href="{{ route('seniorList.index') }}" class="btn btn-outline-success">戻る</a>
        </div>
    </div>

</div>
@endsection
