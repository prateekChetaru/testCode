<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" >
<head>
  <title> Blue Data </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="shortcut icon" href="{{ asset('public/images/favicon.png') }}" type="image/x-icon"/>
  <link rel="stylesheet" type="text/css" href="{{ asset('public/css/bootstrap.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{ asset('public/css/style.css')}}">
  <link rel="stylesheet" type="text/css" href="{{ asset('public/css/responsive.css')}}">
  <style type="text/css">


  section.loging-section {
    background: url({{ asset('public/images/bg-img.jpg') }})no-repeat center center; 
}
.login-img {
  background:url({{ asset('public/images/round-img.png') }})no-repeat right center,url({{ asset('public/images/round-bg-img.jpg') }})no-repeat center;
}
.loing-form .form input[type="email"]{
  background:url({{ asset('public/images/use-icon.png') }})no-repeat 34px center;
}
.loing-form .form input[type="password"]{
  background:url({{ asset('public/images/key-icon.png') }})no-repeat 34px center;
}
.sidebar-menu ul li a { 
  background: url({{ asset('public/images/nav-arrow.png') }}) no-repeat 88% center;
}
.profile-user-list span {
  background: url({{ asset('public/images/user-drop-icon.png') }}) no-repeat right 6px;
}
</style>
</head>

<body>
  <section class="loging-section">    
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="logo-section">
            <div class="logo-box">
              <a href="#"><img src="{{ asset('public/images/login-logo.png')}}"> </a>
            </div>
          </div>
          <div class="login-content">
            <div class="login-img">
            </div>
            <div class="Reset-pass">
              <div class="loing-box">
               <!--  <div class="logo-img">
                  <img src="{{ asset('public/images/login-logo.png') }}">
                </div>  -->           
                <div class="loing-text">
                  <!-- <div class="logo-box">
                    <a href="#"><img src="{{ asset('public/images/login-logo.png')}}"> </a>
                  </div>  -->             
                  <div class="loing-top">         
                    <h1>Welcome<br> To Blue Data</h1>
                    <h2>Reset Password</h2>
                    <p>Please enter the new password below.</p>
                  </div>
                  <div class="form-section">

                    {!!Form::model($data,['method' => 'POST','url' =>  $data['token'], 'files' => true, 'class'=>'form-horizontal form-label-left', ])!!}
                    {{ csrf_field() }}
                    
                    <div class="form-group">  
                     {!!Form::hidden('email',$data['email'],['class'=>'form-control col-md-12 col-xs-12','required'=>'required','readonly'=>'readonly'])!!}
                   </div>

                   <div class="form-group"> 
                    {!!Form::password('password',['class'=>'form-control col-md-12 col-xs-12','required'=>'required','placeholder'=>'Enter new password','id'=>'password-field'])!!}

                    <span toggle="#password-field" class="field-icon toggle-password eye-icon"><img src="{{ asset('public/images/eye-icon.png')}}"><img src="{{ asset('public/images/v-eye-icon.png')}}"> </span>
                  </div>

                  <div class="form-group">  
                   {!!Form::password('confirm_password',['class'=>'form-control col-md-12 col-xs-12','required'=>'required','placeholder'=>'Re-enter new password' ,'id'=>'password-field-reset'])!!}
                   <span toggle="#password-field-reset" class="field-icon toggle-password eye-icon"><img src="{{ asset('public/images/eye-icon.png')}}"><img src="{{ asset('public/images/v-eye-icon.png')}}"> </span>
                 </div>

                 @if(count($errors) > 0)
                 <span class="alert-danger">
                  @foreach ($errors->all() as $error)
                  {{ $error }}
                  @endforeach  
                </span>
                @endif

                @if(session('success'))
                <span class="text-success">
                  <span id="resp">{{session('success')}}</span>
                </span>
                @endif

                <button type="submit" class="btn btn-primary">Reset Password</button>

                {!! Form::close() !!}
              </div>              
            </div>        
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</section>
<script type="text/javascript" src="{{ asset('public/js/jquery.min.js')}}"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="{{ asset('public/js/jquery.mCustomScrollbar.concat.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('public/js/popper.js')}}"></script>
<script type="text/javascript" src="{{ asset('public/js/bootstrap.min.js')}}"></script>

<script type="text/javascript">
    $(".toggle-password").click(function() {
      $(this).toggleClass("field-icon");
      var input = $($(this).attr("toggle"));
      if (input.attr("type") == "password") {
        input.attr("type", "text");
      } else {
        input.attr("type", "password");
      }
    });
</script>
</body>
</html>