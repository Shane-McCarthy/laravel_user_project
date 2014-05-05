<!DOCTYPE html>
<html>
<head>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
 <!-- Navbar
      ================================================== -->
     
      @if(!Auth::check())
       <div class="bs-docs-section clearfix">
        <div class="row">
          <div class="col-lg-12">
       <div class="bs-component">
              <div class="navbar navbar-default">
                <div class="navbar-header">
                  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </button>
                  <div class="navbar-brand">
                   {{ HTML::linkRoute("login", "Login") }}
                </div>
                </div>
       <div class="navbar-collapse collapse navbar-responsive-collapse">
                  <ul class="nav navbar-nav">
                    <li >{{ HTML::linkRoute("register", "Register")  }}</li>
                    <li>{{ HTML::linkRoute("remind", "Forgot Your Password") }}</li>
           </ul>
           </div>
           </div>
           </div>
           </div>
       
       
      @elseif(Auth::check())
   
     <div class="bs-docs-section clearfix">
        <div class="row">
          <div class="col-lg-12">
          <div class="bs-component">
              <div class="navbar navbar-default">
                <div class="navbar-header">
                  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </button>
                  <div class="navbar-brand">
                  {{ HTML::linkRoute("logout", "Logout")  }}
                </div>
                </div>
                  <div class="navbar-collapse collapse navbar-responsive-collapse">
                  <ul class="nav navbar-nav">
                   <li >{{ HTML::linkRoute("passwordChange", "Settings")  }}</li>
                    <li> {{ HTML::linkRoute("secure", "Secure Area")  }}</li>

        @if(User::hasRole('manager'))
      
        <li>{{ HTML::linkRoute("allUsers", "View Registrants")  }}</li>
         @endif
    
     @if(User::hasRole('admin'))
       
       <li> {{ HTML::linkRoute("allUsers", "View Registrants")  }}</li>
      <li>  {{ HTML::linkRoute("manage", "Manage Registrants")  }}</li>
       <li> {{ HTML::linkRoute("adminManage", "Admin Settings")  }}</li>
         @endif

       @endif
    </ul>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
  <div class="container">
@if(Session::has('message'))
    {{ Session::get('message') }}

@endif
</div>
<br/>

@yield('content')
</body>
</html>
