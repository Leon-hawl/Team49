@extends('includes.header')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-header">
                <h5>アカウント編集</h5>
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
                <form action="{{ route('users.update', $user->id) }}" method="POST">
                @csrf
                @method('PATCH')
                    <div class="form-group">
                        <label for="name">名前</label>
                        <input type="text" class="form-control" value="{{ $user->name }}" name="name">
                    </div>
                    <div class="form-group">
                        <label for="email">メールアドレス</label>
                        <input type="email" class="form-control" value="{{ $user->email }}" name="email">
                    </div>
                    <div class="form-group">
                        <label for="password">新しいパスワード</label>
                        <input type="password" class="form-control" name="password">
                    </div>
                    @if ((Auth::user()->id == $user -> id) && $user -> manager_flg == 1)
                    <div class="form-check form-check-inline">
                        <input type="radio" class="form-check-input" id="manager_flg" value=1 checked name="manager_flg">
                        <label class="form-check-input" for="manager_flg">管理者の方はこちら</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="radio" class="form-check-input" id="remove_manager_flg" value=0 name="manager_flg">
                        <label class="form-check-input" for="remove_manager_flg">管理者登録を外す</label>
                    </div>
                    @endif
                    @if ((Auth::user()->id == $user -> id) && $user -> manager_flg == 0)
                        <input type="hidden" class="form-check-input" id="manager_flg" value=0 name="manager_flg">
                        <label class="form-check-input" for="manager_flg"></label>
                    <div class="form-check form-check-inline">
                        <input type="checkbox" class="form-check-input" id="add_manager_flg" value=1 name="manager_flg">
                        <label class="form-check-input" for="add_manager_flg">管理者の方はこちら</label>
                    </div>
                    @endif
                    @if(Auth::user()->id !== $user -> id)
                        <input type="hidden" class="form-check-input" id="manager_flg" value="{{ $user->manager_flg }}" name="manager_flg">
                    @endif
                    <div class="mb-2">
                        <button class="btn btn-outline-primary" type="submit">更新する</button>
                    </div>
                </form>
                <div class="form-group">
                    <form action="{{ route('users.destroy', $user->id) }}"  method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="submit" value="削除する" class="btn btn-outline-danger" onclick='return confirm("削除しますか");'>
                    </form>
                </div>



            </div>
        </div>
        <div class="col-md-2">
            <a href="{{ route('seniorList.index') }}" class="form-group btn btn-outline-success">戻る</a>
        </div>
    </div>
</div>
@endsection
