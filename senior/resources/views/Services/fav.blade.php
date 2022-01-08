@extends('includes.header')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-header text-center">
                <h2 class="card-text">{{ $user -> name }}の</h2>
                <h3 class="card-text">{{ config('const.title.fav', 'fav') }}</h3>
            </div>



            <div class="card-body">
                <div class="text-right">
                    <a href="{{ route('fav.favAdd', $user->id) }}" class="btn btn-outline-success btn-lg m-2 ml-2">{{ config('const.button.new', 'new') }}</a>
                </div>

            @if(count($services) == 0)
            <div class="text-center mt-2 mb-2">
                <h5 class="card-title">{{ config('const.message.not_add') }}</h5>
                <h5 class="card-title">{{ config('const.message.add') }}</h5>

            </div>

            <div class="border-bottom mt-2"></div>

            @else

            @foreach($services as $service)
                <ul class="list-unstyled col-9">
                    <li class="list-group list-group-horizontal">
                        <h3 class="card-text" href="{{ $service->site_url }}" target=”_blank”>{{$service->site_name}}</h3>
                    </li>
                    <h5 class="card-text">メモ:{{ $service->memo }}</h5>

                </ul>
                    <li class="list-group list-group-horizontal">
                        <a href="{{ $service->site_url }}" target=”_blank” class="btn btn-outline-primary m-1">{{ config('const.button.site', 'site') }}</a>
                        <a href="{{ route('fav.edit', $service->id) }}" class="btn btn-outline-secondary m-1">{{ config('const.button.edit', 'edit') }}</a>
                        <form action="{{ route('fav.destroy', $service->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="submit" class="btn btn-outline-danger m-1" value="{{ config('const.button.delete', 'delete') }}" onclick="{{ config('const.message.delete') }}"></input>
                        </form>
                    </li>

                    <div class="border-bottom mt-2 mb-2"></div>
            @endforeach
            @endif

            </div>



            @if(Auth::user()->manager_flg == 1)
                <div>
                    <a class="btn btn-sm btn-outline-dark mt-2 ml-4" href="{{ route('seniorList.show', $user->id) }}">{{ $user->name }}の{{config('const.button.users_info', 'users_info') }}</a>
                </div>
                <div>
                    <a href="{{ route('seniorList.index', $user->id) }}" class="btn btn-sm btn-outline-dark mt-2 ml-4">{{ config('const.button.senior', 'senior') }}</a>
                </div>
            @endif
        </div>


    </div>


</div>
@endsection
