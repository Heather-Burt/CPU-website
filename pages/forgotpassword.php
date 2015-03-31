<?php
	include_once("../links/php/check_login_status.php");
	if($user_ok == true){
		header("Location:index.php?u=".$_SESSION["username"]);
		exit();
	}
?><?php
	if(issest($_POST["e"])){
		$e = mysqli_real_escape_string($db_conx, $_POST['e']);
		$sql = "SELECT id, username FROM users WHERE email = '$e' AND activated='1' LIMIT 1";
		$query = mysqli_query($db_conx, $sql);
		$numrows = mysqli_num_rows($query);
		if($numrows > 0)
		{
			while($row = mysqli_fetch_array($query, MYSQLI_ASSOC))
			{
				$id = $row["id"];
				$u = $row["username"];
			}
			$emailcut = substr($e, 0, 4);
			$randNum = rand(10000, 999999);
			$t = $u.$randNum;
			$temPass = password_hash($t, PASSWORD_DEFAULT);
			$sql = "UPDATE user SET temp_pass='$temPass' WHERE username='$u' LIMIT 1";
			$query = mysqli_query($db_conx, $sql);
			$to = "$e";
			//change this when we get site
			$from = "auto_responder@nameofsite.com"
			$headers = "From: $from\n";
			$headers .= "MIME-Version: 1.0\n";
			$headers .= "Content-type: text/html; charset=iso-8859-1 \n";
			//change this when we get site
			$subject = "yoursite Temporary Password";
			$msg = "<h2>Hello ".$u."</h2><p>This is an automated message from yoursite. If you did not recently initiate the
			Forgot Password process, please disregard this email.</p></p>You indicated that you forgot your login password. We
			can generate a temporary password for you to log in with, then once logged in you can change your password to anything
			you like.</p><p>After you click the link below your password to login will be:<br /><b>".$tempPass."</b></p><p>
			<a href='http://www.yoursite.com/page/changePassword.php?u=".$u."&p=".$tempPass."'>Click here now to apply the temporary password
			shown below to your account</a></p><p>If you do not click the link in this email, no changes will be made to your account.
			In order to set your login password to the temporary password you must click the link above.</p>";
			
			if(mail($to,$subject,$msg,$headers)){
				echo "success";
				exit();
			}else
			{
				echo "email_send_failed";
				exit();
			}
		}else
		{
			echo "no_exist";
		}
		exit();
	}
	?>
	
<?xml version = "1.0"  encoding = "utf-8" ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns = "http://www.w3.org/1999/xhtml">
	<head>
		<link rel="stylesheet" type="text/css" href="../links/styles/styles.css" />
		<script>
			function forgotpass(){
				var e = _("email".value;
				if(e == ""){
					_("status").innerHTML = "Type in your email address";
				}else{
					_("forgotpassbtn").style.display = "none";
					_("status").innerHTML = 'please wait...';
					var ajax = ajaxObj("POST", "forgot_pass.php");
					ajax.onreadystatechange = function(){
						if(ajaxReturn(ajax) == true){
							var response = ajax.responseText;
							if(response == "success"){
								_("forgotpassform").innerHTML = '<h3>Step 2. Check your email inbox in a few minutes</h3><p>You can close this window or tab if you like.</p>';
							}else if(response == "no_exist"){
								_("status").innerHTML = "Sorry that email address is not in our system";
							}else if(response == "email_send_failed"){
								_("status").innerHTML = "Mail function failed to execute";
							}else{
								_("status").innerHTML = "An unknown error occurred:";
							}
						}
					}
					ajax.send("e="+e);
				}
			}
		</script>
		<title>
			Forgot Password
		</title>
	</head>
	<body>
		<div class="main">
			<p>Please enter email address.</p>
			<form id="forgotpassform" onsubmit="return false;">
				<ul>
					<li>
						<label for="forgotEmail">Email</label>
						<input id="email" type="text" maxlength="88" required autofocus name="forgotEmail" /> 
					</li>
					<li>
						<button id="forgotpassbtn" onclick="forgotpass()">Generate Temporary Log In Password</button>
					</li>
				</ul>
				<p id="status"></p>
			</form>
		</div>
	</body>
</html>