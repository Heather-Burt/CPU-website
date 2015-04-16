<?php
	include('../links/php/config.php');
	
	session_start();
	
	if(!isset($_SESSION['username'])){
		header('Location: index.php');
	}
?>
<?xml version = "1.0"  encoding = "utf-8" ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns = "http://www.w3.org/1999/xhtml">
	<head>
		<link rel="stylesheet" type="text/css" href="../links/styles/styles.css" />

		<title>
			CPU Tracker
		</title>
	</head>
	<body>

	</body>
</html>