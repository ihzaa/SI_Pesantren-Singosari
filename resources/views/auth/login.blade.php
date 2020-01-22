<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/login.css">
</head>
<body>
	<div class="wrapper fadeInDown">
	  <div id="formContent">
	    <!-- Tabs Titles -->
		<div class="fadeIn first">
	    	<h3 class="h2">Masuk</h3>
	    </div>
	    <!-- Login Form -->
	    <form action="/logincek" method="POST">
	    	@csrf
	      <input type="text" id="username" class="fadeIn second" name="username" placeholder="login">
	      <input type="password" id="password" class="fadeIn third" name="password" placeholder="password">
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