<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="/css/login.css">
</head>
<body>
	{{-- <div class="container"> --}}
		{{-- Outer Row --}}
		{{-- <div class="row justify-content-center">
			<div class="col-xl-10 col-lg-12 col-md-9">
				<div class="card o-hidden border-0 shadow-lg my-5">
					<div class="card-body p-0"> --}}
						{{-- Nested Row Within Card Body --}}
						{{-- <div class="row">
							<div class="col-lg-6 d-none d-lg-block bg-login-image">
								<div class="col-lg-6">
									<div class="p-5">
										<div class="text-center">
											
										</div>
									</div>
									
								</div>
								
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div> --}}

	<div class="wrapper fadeInDown ">
	  <div id="formContent">
	    <!-- Tabs Titles -->
		<div class="fadeIn first">
	    	<h3 class="h2">Login Admin</h3>
        </div>
        @if(Session::get('pesan'))
          <div class="alert alert-danger alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            {{Session::get('pesan')}}
          </div>
          @endif
	    <!-- Login Form -->
	    <form action="/logincek" method="POST">
	    	@csrf
	      <input type="text" id="username" class="fadeIn second" name="username" placeholder="login" required="">
	      <input type="password" id="password" class="fadeIn third" name="password" placeholder="password" required="">
	      <input type="submit" class="fadeIn fourth" value="Masuk">
	    </form>

	    <!-- Remind Passowrd -->
	    <div id="formFooter">
	      <a class="underlineHover" href="#">Lupa Password?</a>
	    </div>

	  </div>
	</div>
</body>
</html>
