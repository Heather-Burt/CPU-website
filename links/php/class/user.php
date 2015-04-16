<?php
	include('../php/config.php');
	
	session_start();
	
	class Users{
		public $username = null;
		public $password = null;
		public $fname = null;
		public $lname = null;
		public $email = null;
		public $tzone = null;
		public $speed = null;
		public $trackedObject = null;
		public $icon = null;
		
		public function __construct($data = array()){
			if(isset($data['username']))$this->username = stripslashes(strip_tags($data['username']));
			if(isset($data['password']))$this->password = stripslashes(strip_tags($data['password']));
			if(isset($data['fname']))$this->fname = stripslashes(strip_tags($data['fname']));
			if(isset($data['lname']))$this->lname = stripslashes(strip_tags($data['lname']));
			if(isset($data['email']))$this->email = stripslashes(strip_tags($data['email']));
			if(isset($data['tzone']))$this->tzone = stripslashes(strip_tags($data['tzone']));
			if(isset($data['speed']))$this->speed = stripslashes(strip_tags($data['speed']));
			if(isset($data['trackedObject']))$this->trackedObject = stripslashes(strip_tags($data['trackedObject']));
			if(isset($data['icon']))$this->icon = stripslasher(strip_tags($data['icon']));
			
		}
		
		public function storeFormValues($params){
			$this->__construct($params);
		}
		
		public function userLogin(){
			$sucess = false;
			try{
				$con = new PDO(DB_DSN, DB_USERNAME, BD_PASSWORD);
				$sql = "SELECT * FROM user WHERE userName = :username and password = :password LIMIT 1;";
				
				$stmt = $con->prepare($sql);
				$stmt->bindValue("username", $this->username, PDO::PARAM_STR);
				$stmt->bindValue("password", password_hash($this->password, PASSWORD_DEFAULT), PDO::PARAM_STR);
				$stmt->execute();
				
				$valid = $stmt->fetchColumn();
				
				if($valid){
					$_SESSION['username'] = $username;
					$_SESSION['userId'] = $valid['userID'];
					$_SESSION['firstName'] = $valid['firstName'];
					$success = true;
				}
				
				$con = null;
				return $success;
			}catch(PDOException $e){
				echo $e->getMessage();
				return $success;
			}
		}
		
		public function register(){
			$correct = false;
				try{
					$con = new PDO(DB_DSN, DB_USERNAME, PDO::ERRMODE_EXCEPTION);
					$sql = "INSERT INTO user(firstName, lastName, userName, password, email, temp_pass, email_active, time_zone) values(:fname, :lname, :username, :password, :email, null, 0, :tzone);";
					
					$stmt = $con->prepare($sql);
					$stmt->bindValue("username", $this->username, PDO::PARAM_STR);
					$stmt->bindValue("password", password_hash($this->password, PASSWORD_DEFAULT), PDO::PARAM_STR);
					$stmt->bindValue("fname", $this->fname, PDO::PARAM_STR);
					$stmt->bindValue("lname", $this->lname, PDO::PARAM_STR);
					$stmt->bindValue("email", $this->email, PDO::PARAM_STR);
					$stmt->bindValue("tzone", $this->tzone, PDO::PARAM_STR);
					$stmt->execute();
					
					$sql = "SELECT userID FROM user WHERE userName = :username and password = :password LIMIT 1;";
					
					$stmt = $con->prepare($sql);
					$stmt->bindValue("username", $this->username, PDO::PARAM_STR);
					$stmt->bindValue("password", password_hash($this->password, PASSWORD_DEFAULT), PDO::PARAM_STR);
					$stmt->execute();
					
					$id = $stmt->fetchColumn();
					foreach($type as $value)
					{
						$sql = "INSERT INTO type(userID, ul_Lat, ul_long, lr_Lat, lr_Long, speed, objectType, pic) values(:id, null, null, null, null, :speed, :objectType, :pic);";
						$stmt = $con->prepare($sql);
						$stmt->bindValue("id",$this->id, PDO::PARAM_STR);
						$stmt->bindValue("speed", $this->speed, PDO::PARAM_STR);
						$stmt->bindValue("objectType", $this->trackedObject, PDO::PARAM_STR);
						$stmt->bindValue("pic", $this->icon, PDO::PARAM_STR);
						$stmt->execute();	
					}
					return "Registration Successful <br /> <a href='../../../pages/index.php'>Login Now</a>";
						
				}catch(PDOException $e){
					return $e->getMessage();
				}
		}
	}
?>