@extends('layouts.main')
@section('content')
<h1>Reset Password</h1>
{{ Form::open(array('action' => 'resetPwdPost', 'method' => 'POST' )) }}


<ul>
    @foreach($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
</ul>
{{ Form::text('email', null, array('class'=>'input-block-level', 'placeholder'=>'Email Address')) }}
<input type="hidden" value="{{$token}}" name="token" id="token"/>
{{ Form::password('password', array('class'=>'input-block-level', 'placeholder'=>'Password')) }}
{{ Form::password('password_confirmation', array('class'=>'input-block-level', 'placeholder'=>'Confirm Password')) }}

{{ Form::submit('Reset')}}
{{ Form::close() }}

@stop
