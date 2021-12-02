@extends('layouts.app')
 
@section('content')
 
<!-- タスク一覧表示 -->
@if (count($seniors) > 0)
<div class="panel panel-default">
    <div class="panel-heading">
        Current Seniors
    </div>
 
    <div class="panel-body">
        <table class="table table-striped task-table">
 
            <!-- テーブルヘッダ -->
            <thead>
                <th>Senior</th>
                <th>&nbsp;</th>
            </thead>
 
            <!-- テーブル本体 -->
            <tbody>
                @foreach ($seniors as $senior)
                <tr>
                    <!-- タスク名 -->
                    <td class="table-text">
                        <div>{{ $senior->name }}</div>
                    </td>
 
                    <td>
                        <!-- TODO: 削除ボタン -->
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif
@endsection
