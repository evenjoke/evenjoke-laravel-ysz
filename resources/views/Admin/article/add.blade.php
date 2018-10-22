@extends('layout.default')

@section('contents')
    <h1>添加文章</h1>
    @include('layout._errors')
    <form method="post" action="{{ route('articles.store') }}" enctype="multipart/form-data">
        <div class="form-group">
            <label>标题</label>
            <input type="text" name="title" class="form-control" value="{{ old('title') }}">
        </div>

        <div class="form-group">
            <label>作者</label>
            <select name="author_id" class="form-control">
                @foreach($users as $user)
                    <option value="{{ $user->id }}"
                            @if(old('author_id')==$user->id)
                            selected="selected"
                            @endif
                    >{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>内容</label>
            <textarea name="content" class="form-control" rows="3">{{ old('content') }}</textarea>
        </div>
        <div class="form-group">
            <label>发布日期</label>
            <input type="date" name="publish_date" class="form-control" value="{{ old('publish_date') }}">
        </div>
        <input id="captcha" class="form-control" name="captcha" >
        <img class="thumbnail captcha" src="{{ captcha_src('inverse') }}" onclick="this.src='/captcha/flat?'+Math.random()" title="点击图片重新获取验证码">

        {{ csrf_field() }}
        <button class="btn btn-primary btn-block">提交</button>
    </form>
    @stop