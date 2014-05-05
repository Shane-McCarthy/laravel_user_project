@extends('layouts.main')

@section('content')

<?php if(User::hasRole('admin')){

	}elseif (User::hasRole('manager')) {
		echo "manager"; 
	} ?>
    <div class="container">
<div class="col-lg-6">
    <div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title">All Registrants</h3>
  </div>
  <div class="panel-body">
  <table class="table table-striped table-hover ">
  <tbody>
   @foreach($users->getCollection() as $user)
    <tr>
     <?php 
    echo "<td>".$user->firstname. " ";
    echo $user->lastname."</td>";
    echo "<td>".$user->email. "</td>";
     ?>
</tr>
    @endforeach
</tbody>
</table>

  </div>
  </div>
  </div>
</div>
 <div class="container">
<div class="col-lg-6">

{{ $users->links() }}
</div>
</div>

@stop

