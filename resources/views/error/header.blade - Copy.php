<!DOCTYPE html>
    <html>
    <head>
        
	    <title>@yield("title")</title>
         <meta charset="utf-8">
        <meta name="keywords" content="@yield('keywords')" />
        <meta name="description" content=" @yield('desc') ">
        @if(env("WEBSITENAME")==1)
          <meta name="author" content="The world Gateway">
        @elseif(env("WEBSITENAME")==0)
         <meta name="author" content="Rapidex Travels">
        @endif
       
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
        <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
        <!-- Bootstrap 3.3.2 -->
        <link href="{{ asset('/resources/assets/frontend/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- Font Awesome Icons -->
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        {{--  <link href="{{ asset('/resources/assets/frontend/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />  --}}
        <link href="{{ asset('/resources/assets/frontend/css/animate.min.css') }}" rel="stylesheet" type="text/css" />
        <link href='https://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>


         <!-- Current Page Styles -->
	    <link rel="stylesheet" type="text/css" href="{{ asset('/resources/assets/frontend/components/revolution_slider/css/settings.css') }}" media="screen" />
	    <link rel="stylesheet" type="text/css" href="{{ asset('/resources/assets/frontend/components/revolution_slider/css/style.css') }}" media="screen" />
	    <link rel="stylesheet" type="text/css" href="{{ asset('/resources/assets/frontend/components/jquery.bxslider/jquery.bxslider.css') }}" media="screen" />
	    <link rel="stylesheet" type="text/css" href="{{ asset('/resources/assets/frontend/components/flexslider/flexslider.css') }}" media="screen" />
	    <link id="main-style" rel="stylesheet" href="{{ asset('/resources/assets/frontend/css/style.css') }}">
	    <link rel="stylesheet" href="https://owlcarousel2.github.io/OwlCarousel2/assets/owlcarousel/assets/owl.carousel.min.css">
	    
	    <!-- Main Style -->
	    <link id="main-style" rel="stylesheet" href="{{ asset('/resources/assets/frontend/css/style.css') }}">
	    <link id="main-style" rel="stylesheet" href="{{ asset('/resources/assets/frontend/css/style-2.css') }}">
	    
	    <!-- Updated Styles -->
	    <link rel="stylesheet" href="{{ asset('/resources/assets/frontend/css/updates.css') }}">
       
	    <!-- Custom Styles -->
	    <link rel="stylesheet" href="{{ asset('/resources/assets/frontend/css/custom.css') }}">
	    
	    <!-- Responsive Styles -->
	    <link rel="stylesheet" href="{{ asset('/resources/assets/frontend/css/responsive.css') }}">
	    <link rel="stylesheet" href="{{ asset('/resources/assets/frontend/css/responsive-2.css') }}">
        <link href="{{ asset('/resources/assets/frontend/css/bootstrap-formhelpers.min.css') }}" rel="stylesheet">
        <link href="{{ asset('/resources/assets/frontend/css/bootstrap-validator.css') }}" rel="stylesheet">
	    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.2.0/min/dropzone.min.css" rel="stylesheet">

         <!--calender css start-->
         <!--<link rel="stylesheet" href="{{ asset("/resources/assets/frontend/css/fullcalendar.css") }}">-->
         <link rel="stylesheet" href="{{ asset('/resources/assets/frontend/css/fullcalendar.min.css') }}">
         
        <!--calender css end-->
 <link rel="stylesheet" href="{{ asset('/resources/assets/slick/css/slick.css') }}">
 <link rel="stylesheet" href="{{ asset('/resources/assets/slick/css/slick-theme.css') }}">
 <link rel="stylesheet" href="{{ asset('/resources/assets/frontend/css/style_nex.css') }}">
        <!--slick css-->
        <style>
            
     </style>   
        
     
    </head>
      
    <body>
    <input type="hidden" id="base_url" value="{{ url('/')}}">    
    <div id="page-wrapper">
        <header id="header" class="navbar-static-top">
    <!--<div class="topnav hidden-xs">


    <div class="container">

    @if(Sentinel::check())
                                    
                        
    <form action="{{URL::to('/logout-customer')}}" id="logout-form" method="POST">
    {{ csrf_field() }}
                            
    <ul class="quick-menu pull-left">
    <li><a href="{{URL::to('/customer-panel')}}">MY ACCOUNT</a></li>
    </ul>
    <ul class="quick-menu pull-right">
    <li><a href="#" onclick="document.getElementById('logout-form').submit()" class="soap-popupbox">Logout</a></li>
                               
    </ul>
    </form> 
                          
    @else
    <ul class="quick-menu pull-left">
    <li><a href="dashboard1.php">MY ACCOUNT</a></li>
    </ul> 
    <ul class="quick-menu pull-right">
    <li><a href="#travelo-login" class="soap-popupbox">LOGIN</a></li>
    <li><a href="#travelo-signup" class="soap-popupbox">SIGNUP</a></li>
    </ul>
    @endif
                   
    </div>
    </div>-->
    
    <div class="main-header">
                
    <a href="#mobile-menu-01" data-toggle="collapse" class="mobile-menu-toggle">
                    Mobile Menu Toggle
    </a>
    <!--<div class="line-top"></div>-->
    <div class="container">
    <div class="logo1 navbar-brand">
        @if(env("WEBSITENAME")=="1")
    <a href="{{URL::to('/')}}" title="The World Gateway">
    <img src="{{ url('/public/uploads/word.png') }}" alt="" />
    </a>
        @elseif(env("WEBSITENAME")=="0")
     <a href="{{URL::to('/')}}" title="Rapidex Travels">
    <img src="{{ url('/public/uploads/logo.png') }}" alt="" />
    </a>
        @endif
    


    </div>
                    
    <nav id="main-menu"  role="navigation">
    <ul class="menu">
    <li class="menu-item-has-children"><a href="{{URL::to('/')}}">Home</a></li>
    <!--<li class="menu-item-has-children"><a href="{{URL::to('/about')}}">About Us</a></li>-->
    <li class="menu-item-has-children"><a href="{{URL::to('/')}}">Holidays</a></li>
    <!--<li class="menu-item-has-children"><a href="{{URL::to('/hotels')}}">Hotels</a></li>-->
    <!--<li class="menu-item-has-children"><a href="{{URL::to('/flights')}}">Flights</a></li>
    <li class="menu-item-has-children"><a href="{{URL::to('/')}}">Hotels</a></li>-->
    <li class="menu-item-has-children"><a href="https://flights.theworldgateway.com/"  target="_blank">Flights</a></li>
    <!--<li class="menu-item-has-children"><a href="{{URL::to('/contact-us')}}">Contact Us</a></li>-->
     @if(Sentinel::check())
    <li class="menu-item-has-children"><a href="" id="myaccount">MY ACCOUNT</a></li>
    <div class="account">
    <div class="glyphicon glyphicon-user account_icon"></div>
    <form action="{{URL::to('/logout-customer')}}" id="logout-form" method="POST">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">

    <div style="margin-top: 10px;margin-bottom: 10px">
    <a href="{{URL::to('/customer-panel')}}"><span class="glyphicon glyphicon-cog" style="margin-right: 5px;color: #01b7f2"></span>ACCOUNT HISTORY</a>
    </div>
    <div style="text-align: left;">
    <a href="#" onclick="document.getElementById('logout-form').submit()" class="soap-popupbox"><span class="glyphicon glyphicon-log-out" style="margin-right: 5px;color: #01b7f2"></span>LOGOUT</a></div>
    </form> 
    </div>
    @else
    <li class="menu-item-has-children "><a href="#travelo-login" class="soap-popupbox "><span class="glyphicon glyphicon-user" style="margin-right: 5px"></span>Login</a></li>

    @endif
                            
    </ul>
    </nav>
    </div>
                
    <nav id="mobile-menu-01" class="mobile-menu collapse">
    <ul id="mobile-primary-menu" class="menu">
    <li class="menu-item-has-children menu_icon"><a href="{{URL::to('/')}}">Home</a></li>
    <!--<li class="menu-item-has-children menu_icon"><a href="{{URL::to('/about')}}">About Us</a></li>-->
    <li class="menu-item-has-children menu_icon"><a href="{{URL::to('/')}}">Holidays</a></li>
   <!-- <li class="menu-item-has-children menu_icon"><a href="{{URL::to('/hotels')}}">Hotels</a></li>-->
    <li class="menu-item-has-children menu_icon"><a href="{{URL::to('/flights')}}">Flights</a></li>
    <!--<li class="menu-item-has-children menu_icon"><a href="{{URL::to('/contact-us')}}">Contact Us</a></li>-->
    </ul>
                    
    <ul class="mobile-topnav container">
                       

    @if(Sentinel::check())
									
                        
    <form action="{{URL::to('/logout')}}" id="logout-form" method="POST">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <li><a href="{{URL::to('/customer-panel')}}">MY ACCOUNT</a></li>
    <li><a href="#" onclick="document.getElementById('logout-form').submit()" class="soap-popupbox">Logout</a></li>
                            
    </form> 
                          
    @else
						
    <li><a href="#travelo-login" class="soap-popupbox">LOGIN</a></li>
    <li><a href="#travelo-signup" class="soap-popupbox">SIGNUP</a></li>
    @endif
                        
    </ul>
                    
    </nav>
    </div>
    <!---->
    <div id="travelo-signup" class="travelo-signup-box travelo-box travel_login">
  {{--  <div class="login-social">
    <a href="#" class="button login-facebook"><i class="soap-icon-facebook"></i>Login with Facebook</a>
    <a href="#" class="button login-googleplus"><i class="soap-icon-googleplus"></i>Login with Google+</a>
    </div>
    <div class="seperator"><label>OR</label></div> --}}
    <div class="simple-signup">
    <div class="text-center signup-email-section">
    <a href="#" class="signup-email"><i class="soap-icon-letter"></i>Sign up with Email</a>
    </div>
    <p class="description">By signing up, I agree to The World Gateway Terms of Service, Privacy Policy, Guest Refund policy, and Host Guarantee Terms.</p>
    </div>
    <div class="email-signup">
    <form action="{{ URL::to('/register-customer') }}" method="post">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="form-group">
    <input type="text" id="firstName" name="first_name" value="{{old('first_name')}}" class="input-text full-width" placeholder="First Name" >
                           
    </div>
    <div class="form-group">
    <input type="text" id="lastName" name="last_name" placeholder="Last Name" value='{{old('last_name')}}' class="input-text full-width" >
                            
    </div>
    <div class="form-group">
                           
    <input type="email"  name="email" placeholder="Email" value='{{old('email')}}' class="input-text full-width">
    </div>
    <div class="form-group">
                            
    <input type="password" name="password" placeholder="Password" class="input-text full-width">
    </div>
    <div class="form-group">
                          
    <input type="password" name="password_confirmation" id="password2" placeholder="Password Confirmation" class="input-text full-width" >
    </div>
    <div class="form-group">
    <div class="checkbox">
    <label>
    <input type="checkbox"> Tell me about The World Gateway news
    </label>
    </div>
    </div>
    <div class="form-group">
    <p class="description">By signing up, I agree to The World Gateway Terms of Service, Privacy Policy, Guest Refund Policy, and Host Guarantee Terms.</p>
    </div>
    <input type="submit" value="SIGNUP" class="full-width btn-medium"/>
    </form>
    </div>
    <div class="seperator"></div>
    <p>Already a The World Gateway member? <a href="#travelo-login" class="goto-login soap-popupbox">Login</a></p>
    </div>
<!---->



  
    <div id="travelo-login" class="travelo-login-box travelo-box travel_login">
   <!-- <div class="login-social">
    <a href="#" class="button login-facebook"><i class="soap-icon-facebook"></i>Login with Facebook</a>
    <a href="#" class="button login-googleplus"><i class="soap-icon-googleplus"></i>Login with Google+</a>
    </div>
    <div class="seperator"><label>OR</label></div> --> 
    <form action="{{ URL::to('/login-customer') }}" method="post">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="form-group">
                      
    <input type="email"  name="email" placeholder="Email" class="input-text full-width" value="{{old('email')}}" required >
    </div>
    <div class="form-group">
    <input type="password" name="password" placeholder="Password" class="input-text full-width" required >
                       
    </div>
    <div class="form-group">
    <input type="hidden" name="currentURL" value="{{url()->current()}}">
    <input type="submit" class="input-text full-width" value="Login" >
                       
    </div>
    <div class="form-group">
    <a href="#publisher_forget" class="soap-popupbox  forgot-password pull-right">Forgot password?</a>
    <div class="checkbox checkbox-inline">
    <label>
    <input type="checkbox"> Remember me
    </label>
    </div>
    </div>
    </form>
    <div class="seperator"></div>
    <p>Don't have an account? <a href="#travelo-signup" class="goto-signup soap-popupbox">Sign up</a></p>
    </div>
   <!---->

   <!-- Modal -->
    <div id="publisher_forget" class="travelo-login-box travelo-box travel_login">
   <h3>Forget Password</h3>
        <form action="{{route('forget_password')}}" method="post">
           <input type="hidden" name="_token" value="{{ csrf_token() }}">

<div class="modal-body">

<div class="row">


<div class="col-md-12">
    <label>Email ID</label>
  <input type="email" name="email" required placeholder="Enter Email ID" class="form-control">

</div>
<!---->
</div>
</div>
<div class="modal-footer" style="text-align: left;">
   <button type="submit" class="btn btn-success">Submit</button>

</div>
</form>
   
    <div class="seperator"><label>OR</label></div>  
   
    <div class="seperator"></div>
    <p>Don't have an account? <a href="#travelo-signup" class="goto-signup soap-popupbox">Sign up</a></p>
    </div>


   <!---->

   </header>

        <!-- Header Part End  -->