<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>

    <title>Login - Mantrackr Admin</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="">
	<meta name="author" content="" />

	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,800italic,400,600,800" type="text/css">
	<link rel="stylesheet" href="<?php echo assets_url()?>/css/font-awesome.min.css" type="text/css" />		
	<link rel="stylesheet" href="<?php echo assets_url()?>/css/bootstrap.min.css" type="text/css" />	
	<link rel="stylesheet" href="<?php echo assets_url()?>/js/libs/css/ui-lightness/jquery-ui-1.9.2.custom.css" type="text/css" />	
	
	<link rel="stylesheet" href="<?php echo assets_url()?>/css/App.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo assets_url()?>/css/Login.css" type="text/css" />

	<link rel="stylesheet" href="<?php echo assets_url()?>/css/custom.css" type="text/css" />
	
</head>

<body>

<div id="login-container">

	<div id="logo">
		<a href="<?php echo site_url('/admin/login');?>">
			<img src="<?php echo assets_url()?>/img/logos/logo-login.png" alt="Logo" />
		</a>
	</div>

	<div id="login">

		<h3>Welcome to Mantrackr Admin.</h3>

		<h5>Please sign in to get access.</h5>

		<form id="login-form" action="<?php echo site_url('/admin/processLogin');?>" class="form" method="POST">

			<div class="form-group">
				<label for="login-username">Username</label>
				<input type="text" class="form-control" id="login-email" name="login-email" placeholder="User email">
			</div>

			<div class="form-group">
				<label for="login-password">Password</label>
				<input type="password" class="form-control" id="login-password" name="login-password" placeholder="Password">
			</div>
			
			<?php include ('common/message_list.php');?>
			
			<div class="form-group">

				<button type="submit" id="login-btn" class="btn btn-primary btn-block">Signin &nbsp; <i class="fa fa-play-circle"></i></button>

			</div>
		</form>


		<a href="javascript:;" class="btn btn-default">Forgot Password?</a>

	</div> <!-- /#login -->

	<a href="javascript:;" id="signup-btn" class="btn btn-lg btn-block">
		Create an Account
	</a>


</div> <!-- /#login-container -->

<script src="<?php echo assets_url()?>/js/libs/jquery-1.9.1.min.js"></script>
<script src="<?php echo assets_url()?>/js/libs/jquery-ui-1.9.2.custom.min.js"></script>
<script src="<?php echo assets_url()?>/js/libs/bootstrap.min.js"></script>

<script src="<?php echo assets_url()?>/js/App.js"></script>

<script src="<?php echo assets_url()?>/js/Login.js"></script>

</body>
</html>