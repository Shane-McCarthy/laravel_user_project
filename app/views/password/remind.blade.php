@extends ('layouts.main')
@section ('content')
<h1>Reset Password </h1>
{{Form::open(array('action'=>'remindPost', 'method'=> 'POST'))}}

<ul> 
@foreach ($errors->all() as $error)
<li>{{$error}}</li> 
@endforeach 

</ul> 
{{Form::text('email', null , array('class'=> 'input-block-level', 'placeholder'=> 'Email Address'))}}
{{Form::submit('Reset')}}
{{Form::close()}}
@stop 
