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
                            <th>ID</th>
                            <th>Name</th>
                            <th>email</th>
                        </tr>
                    @foreach($users as $user)
                        <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td><a href="{{URL::to('editUser')}}"><img src="/storage/app/public/edit_icon.png" width="20" height="20" alt="edit"></a></td>
                        </tr>
                    @endforeach
                    </table>
                </div>

            </div>
            <a href="{{URL::to('addUser')}}" ><button>Add User</button></a>
            <a href="{{URL::to('editUser')}}"><button>Edit Users</button></a>
        </div>
    </div>
</div>
@endsection
