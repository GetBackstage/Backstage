@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Users</div>

                {{ Form::open(array('action' => array("UsersController@update", $users->id))) }}
                    {!! method_field('patch') !!}

                    {{csrf_field()}}

                    <div class="form-group">
                        <label for="InputName">Name</label>
                        <input type="name" class="form-control" id="name" name="name" value="{{$users->name}}">

                    </div>
                    <div class="form-group">
                        <label for="InputEmail">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{$users->email}}">
                    </div>

                    <div class="form-group">
                        <label for="InputPassword">New password</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>

                {{ Form::close() }}

            </div>
        </div>
    </div>
</div>
@endsection
