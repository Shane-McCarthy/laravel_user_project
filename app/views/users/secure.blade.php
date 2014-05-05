@extends('layouts.main')

@section('content')
  <div class="container">
<div class="col-lg-6">
<div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title">Secure Area</h3>
  </div>
  <div class="panel-body">
  <?php if(User::hasRole('admin')){

	echo "admin"; 
	}elseif (User::hasRole('manager')) {
		echo "manager"; 
	} ?>
  </div>
</div>
</div>
</div>

@stop

