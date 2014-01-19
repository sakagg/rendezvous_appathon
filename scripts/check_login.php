<?php
include "header.php";
$error = false;
$username = $_POST['username'];
$password = $_POST['password'];
if($username == "" || $password == "") {
	$error = true;
	$reason = "All fields are mandatory!!";
}
else {
	$username = preg_replace('#[^A-Za-z0-9_]#i', '', $username); 
	$password = preg_replace('#[^A-Za-z0-9]#i', '', $password);
	include "connect_to_mysql.php";
	$sql = mysql_query("SELECT * FROM students WHERE username='$username' AND password='$password' LIMIT 1");
	$existCount = mysql_num_rows($sql);
	if ($existCount == 0) {
		$sql = mysql_query("SELECT * FROM teachers WHERE username='$username' AND password='$password' LIMIT 1");
		$existCount = mysql_num_rows($sql);
		if($existCount == 0) {
			$reason = "Username and Password do not match!!";
			$error = true;
		}
		else
		{
			echo "teachers";
		}
	}
	else
	{
		echo "students";
	}
}
if ($error == true) {
	echo $reason;
}
?>