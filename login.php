<?php 
session_start(); 
include "db_conn.php";

if (isset($_POST['uname']) && isset($_POST['password'])) {

	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}

	$uname = validate($_POST['uname']);
	$pass = validate($_POST['password']);

	if (empty($uname)) {
		header("Location: index.php?error=Username is required");
	    exit();
	}else if(empty($pass)){
        header("Location: index.php?error=Password is required");
	    exit();
	}else{
		$sql = "SELECT * FROM users WHERE id='$uname' AND password='$pass'";

		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) === 1) {
			$row = mysqli_fetch_assoc($result);
            if ($row['id'] === $uname && $row['password'] === $pass) {
            	$_SESSION['id'] = $row['id'];
            	$_SESSION['name'] = $row['name'];
            	header("Location: home.php");
		        exit();
            }else{
				header("Location: index.php?error=Incorect Username or password");
		        exit();
			}
		}else{
			header("Location: index.php?error=Incorect Username or password");
	        exit();
		}
	}
	
}else{
	header("Location: index.php");
	exit();
}