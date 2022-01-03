@extends('includes.header')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-header text-center">
                <h2 class="card-text">{{ config('const.title.add_senior')}}</h2>
            </div>
            <div>
            <form class="d-flex" method="GET" action="{{ route('seniorList.create') }}">
            @csrf
                <input class="form-control me-2" type="search" name="search" placeholder="名前で検索" aria-label="検索" value="{{ request('search') }}">
                <input class="btn btn-outline-success" type="submit" value="検索"></input>
            </form>
            </div>

            @if (count($users) == 0)
            <div class="text-center mt-2 mb-2">
                <h5 class="card-title">{{ config('const.message.nothing') }}</h5>
            </div>
            <div class="text-center mt-2 mb-2">
                <h5 class="card-title">{{ config('const.message.nothing_user') }}</h5>
            </div>
            @else
            <div class="text-center mt-2 mb-2">
                @if($message == '')
                <h5 class="card-title">{{ config('const.message.result') }}</h5>
                @else
                <h5 class="card-title">{{ $message }}</h5>
                @endif
                <h5 class="card-title">{{ count($users) }}件ヒットしました</h5>

            </div>
            @foreach ($users as $user)
                <div class="card-body">
                    <ul class="list-unstyled col-9">
                        <li class="list-group list-group-horizontal col-md-9">
                            <p class="card-text mr-2">{{ config('const.user.id') }}:{{ $user->id }}</p>
                            <p class="card-text">{{ config('const.user.email') }}:{{ $user->email }}</p>
                        </li>
                        <h5 class="card-text">{{ config('const.user.name') }}:{{ $user->name }}</h5>
                    </ul>
                    <form class="d-flex" action="{{ route('seniorList.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                        <input type="hidden" name="manager_id" value="{{ Auth::user()->id }}">
                        <button class="btn btn-outline-success m-1" type="submit">{{ config('const.button.add') }}</button>
                    </form>
                </div>
                <div class="border-bottom"></div>
            @endforeach
            
            @endif
        </div>
        <div class="col-md-2">
            <a href="{{ route('seniorList.index') }}" class="btn btn-sm btn-outline-dark m-2">{{ config('const.button.back') }}</a>
        </div>
    </div>

</div>
@endsection
