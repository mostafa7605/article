<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
  <meta name="description" content=""/>
  <meta name="author" content=""/>
  <title>R-write</title>
  <!--favicon-->
  <link rel="icon" href="{{asset('/assets/img/logo/logo.svg')}}" type="image/x-icon">
  <!-- Bootstrap core CSS-->
  <link href="/rwrite/assets/css/bootstrap.min.css" rel="stylesheet"/>
  <!-- animate CSS-->
  <link href="/rwrite/assets/css/animate.css" rel="stylesheet" type="text/css"/>
  <!-- Icons CSS-->
  <link href="/rwrite/assets/css/icons.css" rel="stylesheet" type="text/css"/>
  <!-- Custom Style-->
  <link href="/rwrite/assets/css/app-style.css" rel="stylesheet"/>

</head>

<body>

<!-- start loader -->
   <div id="pageloader-overlay" class="visible incoming"><div class="loader-wrapper-outer"><div class="loader-wrapper-inner" ><div class="loader"></div></div></div></div>
   <!-- end loader -->

<!-- Start wrapper-->
 <div id="wrapper">

	   <div class="card-authentication2 mx-auto my-5">
	    <div class="card-group">
	    	<div class="card mb-0 ">
	    		<div class="card-body">
	    			<div class="card-content p-3">
	    				<div class="text-center">
					 		<img src="{{asset('/assets/img/logo/logo.svg')}}" style="width: 50%;" alt="logo icon">
					 	</div>
                     <div class="card-title text-uppercase text-center py-3">Sign In</div>
						@if($errors->any())
						<p class="alert alert-danger">{{$errors->first()}}</p>
						@endif
                       <form method="POST" action="{!! url('/admin/login') !!}">
                       @csrf
						  <div class="form-group">
						   <div class="position-relative has-icon-left">
							   <label for="exampleInputUsername" class="sr-only">Email</label>
								 <input type="email" id="exampleInputUsername" name="email" class="form-control" placeholder="Email">
								 <div class="form-control-position">
									<i class="icon-envelope"></i>
                                </div>
                                @error('email')
						<p class="alert alert-danger">{{ $message }}</p>
						@enderror
						   </div>
						  </div>
						  <div class="form-group">
						   <div class="position-relative has-icon-left">
							  <label for="exampleInputPassword" class="sr-only">Password</label>
							  <input type="password" id="exampleInputPassword" name ="password"class="form-control" placeholder="Password">
							  <div class="form-control-position">
								  <i class="icon-lock"></i>
                              </div>
                              @error('password')
						<p class="alert alert-danger">{{ $message }}</p>
						@enderror
						   </div>
						  </div>
						  <div class="form-row mr-0 ml-0">
						  <div class="form-group col-6">
							  <div class="icheck-material-primary">
				               <input type="checkbox" id="user-checkbox" checked="" />
				               <label for="user-checkbox">Remember me</label>
							 </div>
							</div>
							<!-- <div class="form-group col-6 text-right">
							 <a href="authentication-reset-password2.html">Reset Password</a>
							</div> -->
						</div>
						<button type="submit" class="btn btn-primary btn-block waves-effect waves-light">Sign In</button>
						<!-- <p class="text-dark">Do not have an account? <a href="{!! url('/signup') !!}"> Sign Up here</a></p> -->
					</form>
				 </div>
				</div>
	    	</div>
	     </div>
	    </div>

     <!--Start Back To Top Button-->
    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->



	</div><!--wrapper-->

  <!-- Bootstrap core JavaScript-->
  <script src="/rwrite/assets/js/jquery.min.js"></script>
  <script src="/rwrite/assets/js/popper.min.js"></script>
  <script src="/rwrite/assets/js/bootstrap.min.js"></script>

  <!-- horizontal-menu js -->
  <script src="/rwrite/assets/js/horizontal-menu.js"></script>

  <!-- Custom scripts -->
  <script src="/rwrite/assets/js/app-script.js"></script>

</body>
</html>
