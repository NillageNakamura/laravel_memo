@extends('layouts.app')

@section('content')
<div class="row justify-content-center m-0 h-100">
    <div class="card w-100 p-0">
        <div class="card-header d-flex justify-content-between">
            メモ編集
            {{ Form::open(['url' => route('delete', ['id' => $memo['id']])]) }}
                {{ Form::button('<i id="delete-button" class="fas fa-trash"></i>', ['type' => 'submit', 'class' => 'p-0 mr-2', 'style' => 'border:none;']) }}
            {{ Form::close() }}
        </div>
        <div class="card-body">
            {{ Form::open(['url' => route('update', ['id' => $memo['id']])]) }}
                {{ Form::hidden('user_id', $user['id']) }}
                <div class="form-group">
                    {{ Form::textarea('content', $memo['content'], ['class' => 'form-control', 'rows' => 10]) }}
                </div>
                <div class="form-group mt-3">
                    <select class='form-control mt-3' name='tag_id'>
                        @foreach($tags as $tag)
                            <option value="{{ $tag['id'] }}" {{ $tag['id'] == $memo['tag_id'] ? "selected" : "" }}>{{$tag['name']}}</option>
                        @endforeach
                    </select>
                </div>
                {{ Form::button('更新', ['type' => 'submit', 'class' => 'btn btn-primary btn-lg mt-3'])}}
            {{ Form::close() }}
        </div>
    </div>
</div>
@endsection
