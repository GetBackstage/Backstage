@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Add User</div>

                {{ Form::open(array('action' => "UsersController@store")) }}

                    {{csrf_field()}}

                    <div class="form-group">
                        <label for="InputName">Name</label>
                        <input type="name" class="form-control" id="name" name="name">
                    </div>
                    <div class="form-group">
                        <label for="InputEmail">Email address</label>
                        <input type="email" class="form-control" id="email" name="email">
                    </div>

                    <div class="form-group">
                        <label for="InputPassword">Password</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                {{ Form::close() }}

                </div>



            </div>
        </div>
    </div>
</div>
@endsection
