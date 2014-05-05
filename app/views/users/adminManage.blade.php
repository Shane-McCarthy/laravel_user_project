@extends('layouts.main')

@section('content')

@if (User::countAdmin()>=2 )
	
<?php if(User::hasRole('admin')){

	}elseif (User::hasRole('manager')) {
		echo "manager"; 
	}
 $role_array = array (); 
 foreach ($roles as $role) {
 	$role_array[$role->id] = $role->name; 
 }

	 ?>
	 <div class="container">
<h2>Admin Settings Area</h2>
@foreach ($users as $user) 

  
	@if(User::checkAdmin($user->id) ==  'admin') 
	<div class="col-lg-6">
	<div class="panel panel-primary">
  <div class="panel-heading">
	 <h3 class="panel-title"> {{ $user->firstname}} {{$user->lastname}}</h3>
  </div>
  <div class="panel-body">
{{ Form::open(array('action' => 'roleUpdate', 'method' => 'POST' )) }}{{ Form::hidden('id', $user->id) }}
<p>
    {{ $user->firstname}} {{$user->lastname}} ||  {{ Form::label('roles', 'User Roles:')}}<br/>
        {{Form::select('roles',$role_array)}}<br/>
        
</p>
<p>
    {{ Form::submit('Update User') }}
</p>
{{Form::close()}}
	</div>
	</div>
	</div>

@endif
@endforeach
</div>
@else 
<div class="container">
<div class="col-lg-6">
	<div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title">Please add one more Admin Before making changes</h3>
  </div>
  <div class="panel-body">
	<p></p>
	</div>
	</div>
	</div>
	</div>

@endif 
@stop

