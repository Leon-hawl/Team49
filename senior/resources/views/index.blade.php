@extends('includes.header')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-header text-center">
                <p class="card-text">入居者一覧</p>
            </div>

            @if(count($users) == 0)
            <div class="text-center mt-5 mb-2">
                <h5 class="card-title">{{ $message }}</h5>
            </div>
            @endif
            @foreach ($users as $user)

            @if($user->manager_id == Auth::user()->id)
            <div class="card-body">
                <ul class="list-unstyled col-2">
                    <li class="list-group list-group-horizontal col-md-2">
                        <p class="card-text">id:{{ $user->id }}</p>
                        <p class="card-text col-md-2">email:{{ $user->email }}</p>
                    </li>
                    <h5 class="card-title">名前:{{ $user->name }}</h5>
                </ul>
                <li class="list-group list-group-horizontal">
                    <a href="{{ route('seniorList.show', $user->id) }}" class="btn btn-outline-primary">詳細へ</a>
                    <form action="{{ route('seniorList.destroy', $user->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="submit" class="btn btn-outline-danger" value="管理対象から外す" onclick='return confirm("管理対象から外しますか?");'></input>
                    </form>

                </li>
            </div>
            <div class="card-footer text-muted">
            </div>
            @endif
            @endforeach
        </div>
        <div class="col-md-2">
            <a href="{{ route('seniorList.create') }}" class="btn btn-outline-success">新規登録</a>
        </div>
    </div>

</div>
@endsection
