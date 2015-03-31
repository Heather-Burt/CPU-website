<?php
	include_once("../links/php/check_login_status.php");
	if($user_ok == true){
		header("Location:index.php?u=".$_SESSION["username"]);
		exit();
	}
?>
<?php
//email link click calls this page and code
	if(isset($_GET['u']) && isset($_GET['p']))
	{
		$u = preg_replace('#[^a-z0-9]#i', '', $_GET['u']);
		$temppasshash = preg_replace('#[^a-z0-9]#i', '', $_GET['p']);
		if(strlen($temppasshash)<10){
			exit();
		}
		$sql = "SELECT id FROM user WHERE username='$u' AND temp_pass='$temppasshash' LIMIT 1";
		$query = mysqli_query($db_conx, $sql);
		$numrows = mysqli_num_rows($query);
		if($numrows == 0){
			header("location: message.php?msg=There is no match for that username with that temporary password in the system. We cannot proceed.");
			exit();
		}
	}
?>
<?php
	if(isset($_POST['pass']) && isset($_POST['repass']))
	{
		if($_POST['pass'] == $_POST['repass'])
		{
			$pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);
			$sql = "UPDATE user SET temp_pass=' ' WHERE username='$u' LIMIT 1";
			$query = mysqli_query($db_conx, $sql);
			$sql = "UPDATE user SET userpassword='$pass' WHERE username='$u' LIMIT 1";
			$query = mysqli_query($db_conx, $sql);
			header("location: index.html");
			exit();
		}
	}
?>
<?xml version = "1.0"  encoding = "utf-8" ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns = "http://www.w3.org/1999/xhtml">
	<head>
		<link rel="stylesheet" type="text/css" href="../links/styles/styles.css" />
		<script>
			function changePass(){
				var p = _("pass").value;
				var rp = _("repass").value;
				if(p != rp){
					_("status").innerHTML = "Passwords do not match.";
				}else{
					_("changepass").style.display = "none";
					_("status").innerHTML = 'please wait ...';
					var ajax = ajaxObj("POST", "changePassword.php");
					ajax.onreadystatechange = function(){
						if(ajaxReturn(ajax) == true){
							var response = ajax.responseText;
							if(response == "success"){
								_("forgotpassform").innerHTML = '<h3>Password changed.</h3>";
							}
						}
					}
				}
			}
		</script>

		<title>
			Change Password
		</title>
	</head>
	<body>
		<div class="main">
			<p>Please change your password.</p>
			<form id="changepassform" onsubmit="return false;" method="post">
				<ul>
					<li>
						<label for="pass">Password:</label>
						<input id="pass" type="password" maxlength="88" required autofocus name="pass" /> 
					</li>
					<li>
						<label for="repass">Reenter Password:</label>
						<input id="repass" type="password" maxlength="88" required autofocus name="repass" />
					</li>
					<li>
						<button id="changepass" onclick="changePass()">Change Password</button>
					</li>
				</ul>
				<p id="status"></p>
			</form>
		</div>
	</body>
</html>