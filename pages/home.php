<?php
	include('../links/php/config.php');
	
	session_start();
	
	if(!isset($_SESSION['username'])){
		header('Location: index.php');
	}
	else{
		$userID = $_SESSION['userID'];
		
	}
	$doc = new DOMDocument();
	$doc->formatOutpur = true;
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
		<p>
			<a href="map.php">
				<img id="allAnimals" src="../pictures/icons/allAnimals.png" />
			</a><br />
			<?php
				$con = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
				$sql = "SELECT * FROM type WHERE userID = ':userID';"
				
				$stmt= $con->prepare($sql);
				$stmt->bindValue("userID", $this->userID, PDO::PARAM_STR);
				$stmt->execute();
				
				$icons = $stmt->fetchColumn();
				$num = 0;
				$div = $doc->createElement('div');
				$dbody = $doc->createElement('dbody');
				while($icon = mysql_fetch_array($icons)){
					$_SESSION['typeID'] = $icon['typeID'];
					$typeID = $icon['typeID'];
					$typeIcon = $icon['pic'];
					
					$div->setAttribute('class', 'icons');
					
					$link = $doc->createElement('a');
					$link->setAttribute('href', 'tracked.php?id='.$typeID);
					$pic = $doc->createElement('img');
					$pic->setAttribute('src', $typeIcon);
					$link->appendChild($pic);
					$dbody->appendChild($link);
					if($num == 8){
						$br = $doc->createElement('br');
						$dbody->appendChild($br);
					}
					$num++;
					
				}
				$div->appendChild($dbody);
				$dom->appendChild($div);
				
			?>
		</p>
	</body>
</html>