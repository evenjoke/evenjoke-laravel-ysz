@extends('layout.default')
@section('contents')
<table class="table table-bordered table-striped" >
    <tr>
        <th>ID</th>
        <th>用户名</th>
        <th>用户头像</th>
        <th>用户邮箱</th>
        <th>用户创建时间</th>
        <th>用户最后修改</th>
        <th>用户操作</th>
    </tr>
    @foreach ($users as $user)

        <tr>
            <td>{{$user->id}}</td>
            <td>{{$user->name}}</td>
            <td>{{$user->head}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->created_at}}</td>
            <td>{{$user->updated_at}}</td>
            <td>
                <span class="label label-warning"><a href="{{route('Admin.user.edit',[$user])}}">修改</a></span>
                <span class="label label-danger"><a href="{{route('Admin.user.delete',[$user])}}">删除</a></span>
            </td>
        </tr>
    @endforeach
</table>
@endsection

