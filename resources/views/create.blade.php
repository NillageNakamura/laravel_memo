@extends('layouts.app')

@section('content')
<div class="card h-100 p-0">
    <div class="card-header">新規メモ作成</div>
        <div class="card-body">
            {{ Form::open(['route' => 'store']) }}
                {{ Form::hidden('user_id', $user['id']) }}
                <div class="form-group">
                    {{ Form::textarea('content', null, ['class' => 'form-control', 'rows' => 10]) }}
                </div>
                <div class="form-group mt-3">
                    {{ Form::label('tag', 'タグ') }}
                    {{ Form::text('tag', null, ['class' => 'form-control', 'id' => 'tag', 'placeholder' => 'タグを入力'])}}
                </div>
                {{ Form::button('保存', ['type' => 'submit', 'class' => 'btn btn-primary mt-3'])}}
            {{ Form::close() }}
        </div>
    </div>
</div>
@endsection
