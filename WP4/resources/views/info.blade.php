@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Info</div>

                <div class="panel-body">
                    <h1> {{ $users->name }}</h1>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
