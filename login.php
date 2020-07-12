<?php 
require('config.php');
if (isset($_COOKIE['login'])) {
	$pass_c = $_COOKIE['login'];
	$pass = str_replace('.', '_', $pass_c);
	if (isset($_COOKIE[$pass])){
		$_SESSION['login'] = $pass_c;
		$_SESSION[$pass_c] = $pass_c;
	}
}

if (isset($_SESSION['login'])) {
	$pass_s = $_SESSION['login'];
	if (isset($_SESSION[$pass_s])) {
		header("location: index.php");
		exit();
	}
}

$error = false;
if (isset($_POST['login'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	if (isset($_POST['remember'])) $remember = $_POST['remember'];
	else $remember = false;
	
	$cek = mysqli_query($conn, "SELECT * FROM tb_admin WHERE username = '$username'");
	$get = mysqli_fetch_assoc($cek);
	$get_pass = $get['password'];

	if (password_verify($password, $get['password'])) {
		$_SESSION['login'] = $get_pass;
		$_SESSION[$get_pass] = $get_pass;

		if ($remember == true) {
			setcookie('login', $get_pass, time()+172800);
			setcookie($get_pass, $get_pass, time()+172800);
		}

		header("location: index.php");
		exit();
	}
	$error = true;
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
	<meta name="author" content="Coderthemes">

	<link rel="shortcut icon" href="assets/images/favicon_1.png">

	<title>Page Login</title>

	<link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<link href="assets/css/core.css" rel="stylesheet" type="text/css" />
	<link href="assets/css/components.css" rel="stylesheet" type="text/css" />
	<link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
	<link href="assets/css/pages.css" rel="stylesheet" type="text/css" />
	<link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />
	<script src="assets/js/modernizr.min.js"></script>

</head>
<body>

	<div class="account-pages"></div>
	<div class="clearfix"></div>
	<div class="wrapper-page">
		<div class=" card-box">
			<div class="panel-heading"> 
				<h3 class="text-center"> Login to <strong class="text-custom">Admin</strong> </h3>
			</div> 


			<div class="panel-body">
				<form class="form-horizontal m-t-20" method="POST">

					<div class="form-group ">
						<div class="col-xs-12">
							<input class="form-control" type="text" name="username" required="" placeholder="Username">
						</div>
					</div>

					<div class="form-group">
						<div class="col-xs-12">
							<input class="form-control" type="password" name="password" required="" placeholder="Password">
						</div>
					</div>

					<div class="form-group">
						<div class="col-xs-12">
							<?php if ($error == true): ?>
								<label class="text-danger">Uername atau password salah</label>
							<?php endif ?>
						</div>
					</div>

					<div class="form-group ">
						<div class="col-xs-12">
							<div class="checkbox checkbox-primary">
								<input id="checkbox-signup" type="checkbox" name="remember">
								<label for="checkbox-signup">
									Remember me
								</label>
							</div>

						</div>
					</div>

					<div class="form-group text-center m-t-40">
						<div class="col-xs-12">
							<button type="submit" name="login" class="btn btn-default btn-block text-uppercase waves-effect waves-light" type="submit">Log In</button>
						</div>
					</div>

					<div class="form-group m-t-30 m-b-0">
						<div class="col-sm-12">
							<a href="reset_password.php" class="text-dark"><i class="fa fa-lock m-r-5"></i> Forgot your password?</a>
						</div>
					</div>
				</form> 

			</div>   
		</div>  
	</div>

	<script>
		var resizefunc = [];
	</script>

	<!-- jQuery  -->
	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/detect.js"></script>
	<script src="assets/js/fastclick.js"></script>
	<script src="assets/js/jquery.slimscroll.js"></script>
	<script src="assets/js/jquery.blockUI.js"></script>
	<script src="assets/js/waves.js"></script>
	<script src="assets/js/wow.min.js"></script>
	<script src="assets/js/jquery.nicescroll.js"></script>
	<script src="assets/js/jquery.scrollTo.min.js"></script>


	<script src="assets/js/jquery.core.js"></script>
	<script src="assets/js/jquery.app.js"></script>
	
</body>
</html>