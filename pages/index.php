<?php
	include_once("../links/php/config.php");
?>
<?php if(!(issset($_POST['login']))){ ?>

<?xml version = "1.0"  encoding = "utf-8" ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns = "http://www.w3.org/1999/xhtml">
	<head>
		<link rel="stylesheet" type="text/css" href="../links/styles/styles.css" />

		<title>
			Login
		</title>
	</head>
	<body>
		<div class="main">
			<h3 id="loginHead">Please login.</h3>
			<p class="small">If registered user please input username and password.<br /> If new user please click the link below to register.<img id="registrationLogin" src="../pictures/buttons/btnADDNEW.png" />
			<br /><a href="forgotpassword.html" style="text-align:right;">Forgot password</a>
			</p>
			<form id="login" method="post" action="">
				<ul>
					<li>
						<label for="usn">Username : </lable>
						<input type="text" maxlength="30" required autofocus name="username" />
					</li>
					<li>
						<label for="passwd">Password : </label>
						<input type="password" maxlength ="30" required name="password" />
						
					</li>
					<li class="buttons">
						<input type="submit" name="login" value="Log me in" />
						<input type="image" class="button" name="register" alt="new user registration" src="../pictures/buttons/btnADDNEW.png" onclick="location.href='register.php'" />
					</li>
				</ul>
			</form>
		</div>
	</body>
</html>
<?php
	}else{
	$usr = new Users;
	$usr->storeFormValuse($_POST);
	
	if($usr->userLogin()){
		header("location: index.html");
	}else{
		echo "Incorrect Username/Password";
	}
}
?>