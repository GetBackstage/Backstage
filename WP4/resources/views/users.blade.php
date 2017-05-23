@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Users</div>

                <div class="panel-body">
                    <table width="100%">
                        <tr>
                            <th>Name</th>
                            <th>email</th>
                        </tr>
                    @foreach($users as $user)
                        <tr>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td><a href="{{route('editUser.get', ['id'=>$user->id])}}"><img src="/edit_icon.png" width="20" height="20" alt="edit"></a></td>
                        </tr>
                    @endforeach
                    </table>
                </div>

            </div>
            <a href="{{URL::to('addUser')}}" ><button>Add User</button></a>
        </div>
    </div>
</div>
@endsection
