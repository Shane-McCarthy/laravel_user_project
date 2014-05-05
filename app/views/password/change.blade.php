@extends('layouts.main')
@section('content')
<h1>Change Password</h1>
{{ Form::open(array('action' => 'passwordPost', 'method' => 'POST' )) }}


<ul>
    @foreach($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
</ul>

<input type="hidden" value="<?php echo Session::get('userId');?>" name="userId" id="userId"/>
{{ Form::password('password', array('class'=>'input-block-level', 'placeholder'=>'Password')) }}
{{ Form::password('password_confirmation', array('class'=>'input-block-level', 'placeholder'=>'Confirm Password')) }}

{{ Form::submit('Reset')}}
{{ Form::close() }}

@stop
