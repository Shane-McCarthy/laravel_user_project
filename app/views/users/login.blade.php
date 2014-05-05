@extends('layouts.main')

@section('content')
<div class="container">
<div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title">Login</h3>
  </div>
  <div class="panel-body">
   
 
{{ Form::open(array('action' => 'login_post', 'method' => 'POST' )) }}


   
     <div class="form-group">
                    <label for="inputEmail" class="col-lg-2 control-label">Email</label>
                    <div class="col-lg-10">
      {{ Form::text('email', null, array('class'=>'input-block-level', 'placeholder'=>'Email Address')) }}
      </div>
      </div>
       <div class="form-group">
                    <label for="inputPassword" class="col-lg-2 control-label">Password</label>
                    <div class="col-lg-10">
       {{ Form::password('password', array('class'=>'input-block-level', 'placeholder'=>'Password')) }}

        </div>
      </div>
      {{ Form::submit('Login')}}
{{ Form::close() }}

<p>Admin login : rx@doctorphong.com - 999999 </p>
   </div>
   </div>
</div>
@stop





