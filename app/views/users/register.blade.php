@extends('layouts.main')

@section('content')
<ul>
    @foreach($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
</ul>

<h1>User Registration</h1>
{{ Form::open(array('action' => 'create', 'method' => 'POST' )) }}
<h2>Please Register</h2>

{{ Form::text('firstname', null, array('class'=>'input-block-level', 'placeholder'=>'First Name')) }}<br>
{{ Form::text('lastname', null, array('class'=>'input-block-level', 'placeholder'=>'Last Name')) }}<br>
{{ Form::text('email', null, array('class'=>'input-block-level', 'placeholder'=>'Email Address')) }}<br>
{{ Form::password('password', array('class'=>'input-block-level', 'placeholder'=>'Password')) }}<br>
{{ Form::password('password_confirmation', array('class'=>'input-block-level', 'placeholder'=>'Confirm Password')) }}<br>

{{ Form::submit('Register')}}
{{ Form::close() }}

@stop

