@extends('layout.default')


@section('contents')
    <div class="col-md-offset-2 col-md-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h5>修改用户信息</h5>

            </div>
            @include('layout._errors')
            <div class="panel-body">
                <form method="POST" enctype="multipart/form-data" action="{{ route('Admin.user.update',[$user]) }}">
                    <div class="form-group">
                        <label for="name">用户名：</label>
                        <input type="text" name="name" class="form-control" value="{{ $user->name}}">
                    </div>
                    <div class="form-group">
                        <label for="name">头像：</label>
                        <input type="file" name="head" class="form-control" value="{{ $user->head }}">
                    </div>

                    <div class="form-group">
                        <label for="email">邮箱：</label>
                        <input type="email" name="email" class="form-control" value="{{ $user->email }}">
                    </div>
                    <div class="form-group">
                        <label for="password">密码：</label>
                        <input type="password" name="password" class="form-control" >
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">确认密码：</label>
                        <input type="password" name="password_confirmation" class="form-control" ">
                    </div>

                    {{csrf_field()}}
                    <button type="submit" class="btn btn-primary">确认修改</button>
                </form>
            </div>
        </div>
    </div>
@stop

