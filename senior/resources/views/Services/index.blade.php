@extends('includes.header')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-header text-center">
                <p class="card-text">{{ config('const.list.list', 'list') }}</p>
            </div>

            @if(count($users) == 0)
            <div class="text-center mt-5 mb-2">
                <h5 class="card-title">{{ config('const.message.not_add', 'not_add') }}</h5>
            </div>
            @endif
            @foreach ($users as $user)

            @if($user->manager_id == Auth::user()->id)
            <div class="card-body">

                <ul class="list-unstyled col-9">
                    <li class="list-group list-group-horizontal">
                        <p class="card-text mr-2">{{ config('const.user.id', 'id') }}:{{ $user->id }}</p>
                        <p class="card-text">{{ config('const.user.email', 'email') }}:{{ $user->email }}</p>
                    </li>
                    <h5 class="card-title">{{ config('const.user.name', 'name') }}:{{ $user->name }}</h5>
                </ul>
                    <li class="list-group list-group-horizontal">
                        <a href="{{ route('seniorList.show', $user->id) }}" class="btn btn-outline-primary m-1">{{ config('const.button.users_info', 'users_info') }}</a>
                        <a href="{{ route('fav.show', $user->id) }}" class="btn btn-outline-secondary m-1">{{ config('const.button.service', 'service') }}</a>
                        <form action="{{ route('seniorList.destroy', $user->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="submit" class="btn btn-outline-danger m-1" value="管理対象から外す" onclick="{{ config('const.message.remove_management') }}"></input>
                        </form>
                    </li>

            </div>
            <div class="border-bottom">
            </div>
            @endif
            @endforeach
        </div>
        <div class="col-md-2">
            <a href="{{ route('seniorList.create') }}" class="btn btn-outline-success mt-2 ml-4">{{ config('const.button.new', 'new') }}</a>
        </div>
    </div>

</div>
@endsection
