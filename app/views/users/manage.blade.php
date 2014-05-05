@extends('layouts.main')

@section('content')
<h1>Manage Registrants</h1>
<?php if(User::hasRole('admin')){

	
	}elseif (User::hasRole('manager')) {
		echo "manager"; 
	}
 $role_array = array (); 
 foreach ($roles as $role) {
 	$role_array[$role->id] = $role->name; 
 }

	 ?>
@foreach ($users->getCollection() as $user) 
<div class="container">
<div class="col-lg-6">
	<div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title"> {{ $user->firstname}} {{$user->lastname}} - {{$user->email}}</h3>
  </div>
  <div class="panel-body">
 {{ Form::open(array('action' => 'roleUpdate', 'method' => 'POST' )) }}{{ Form::hidden('id', $user->id) }}

   <h4><?php echo User::checkAdmin($user->id); ?> </h4> 
@if(User::checkAdmin($user->id) !=  'admin')
    {{ Form::label('roles', 'User Roles:')}}
        {{Form::select('roles',$role_array)}}
        <button type="button" class="btn btn-default"> {{ HTML::linkRoute("delete_user", "Delete this User ", array($user->id)) }}</button>
        <button type="button" class="btn btn-default"> {{ Form::submit('Update User') }}</button>

        
        @else
 <button type="button" class="btn btn-default"> {{ HTML::linkRoute("adminManage",
                        "Admin Settings") }}</button>
@endif     
{{Form::close()}}
</div>
  </div>
</div>
</div>
@endforeach
 {{ $users->links() }}
@stop

