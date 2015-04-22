<?php
	include('../links/php/config.php');
	
	session_start();
	
	if(!isset($_SESSION['username'])){
		header('Location: index.php');
	}
	else{
		$userID = $_SESSION['userID'];
		$typeID = $_GET['id'];
	}
	
	$con = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
	
	$sql = "SELECT objectType FROM type Where typeID = ':typeID';";
	
	$stmt = $con->prepare($sql);
	$stmt->bindValue("typeID", $this->typeID, PDO::PARAM_STR);
	$stmt->execute();
	
	$title = $stmt->fetchColumn();
	
	$sql = "SELECT * FROM tracked WHERE typeID = ':typeID';";
	
?>
<?xml version = "1.0"  encoding = "utf-8" ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns = "http://www.w3.org/1999/xhtml">
	<head>
		<link rel="stylesheet" type="text/css" href="../links/styles/styles.css" />

		<title>
			<?php echo $title; ?>
		</title>
	</head>
	<body>
		<div class="main">
			<div class="head">
				<form id="search" method="post">
					<input type="text" id="search" name="search" />
					<input type="image" class="button" name="search" src="../pictures/buttons/search.jpg" onclick="location.href='tracked-individual.php" />
				</form>
			</div>
			<div class="body">
				<table id="tracked">
					<?php
						$con = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
						$sql = "SELECT * FROM tracked WHERE typeID = ':typtID';"
						
						$stmt= $con->prepare($sql);
						$stmt->bindVallue("typeID", $this->typeID, PDO::PARAM_STR);
						$stmt->execute();
						
						$info = $stmt->fetchColumn();
						
						while($row = mysql_fetch_array($info)){
							$tname = $row['trackName'];
							$lnum = $row['licenceNumber'];
							$make = $row['make'];
							$model = $row['model'];
							$pic = $row['pic'];
							$sex = $row['sex'];
							$tagnum = $row['tagNumber'];
							$trackId = $row['trackerID'];
							
							if($lnum == null)
							{
								echo "<tr>
										<td><a href='tracked-individual.php?trackId=$trackId'>$pic</a></td>
										<td><a href='tracked-individual.php?trackId=$trackId'>$tagnum <br />$tname</a></td>
									</tr>";
							}
							else
							{
								echo "<tr>
										<td><a href='tracked-individual.php?$trackedId'>$pic</a></td>
										<td><a href='tracked-individual.php?trackedId'>$tagnum<br />$lnum $make $model</a></td>
									</tr>";
							}
						}
					?>
				</table>
			</div>
		</div>
	</body>
</html>