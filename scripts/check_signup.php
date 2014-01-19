<?php
include "header.php";
$error = false;
$person = $_POST['person'];
$name = $_POST['name'];
$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];
$verify_password = $_POST['verify_password'];

if($name == "" || $email == "" || $username == "" || $password == "" || $verify_password == "") {
	$error = true;
	$reason = "All fields are compulsory!!";
}
else if(filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
	$error = true;
	$reason = "Incorrect email format!!";
}
else if($password != $verify_password) {
	$error = true;
	$reason = "Passwords do not match!!";
}
if($error == false) {
	$person = preg_replace('#[^A-Za-z0-9]#i', '', $person);
	$name = preg_replace('#[^A-Za-z0-9 ]#i', '', $name);
	$email = preg_replace('#[^A-Za-z0-9@.]#i', '', $email);
	$username = preg_replace('#[^A-Za-z0-9]#i', '', $username);
	$password = preg_replace('#[^A-Za-z0-9]#i', '', $password);
	include "connect_to_mysql.php";
	$check_username_and_email_in_students = mysql_query("SELECT * FROM students WHERE username='$username' OR email='$email'");
	$exist_count = mysql_num_rows($check_username_and_email_in_students);
	$check_username_and_email_in_teachers = mysql_query("SELECT * FROM teachers WHERE username='$username' OR email='$email'");
	$exist_count = $exist_count + mysql_num_rows($check_username_and_email_in_teachers);
	if($exist_count != 0) {
		$error = true;
		$reason = "Account already exists!!";
	}
	else {
/*		//Mail Confirmation
		$md5sum = md5($email);
		mysql_query("INSERT INTO temporary_users VALUES ('$md5sum', '$name', '$email', '$country', '$username', '$password')");
		$to = $email;
		$subject = "CodeRating Registration";
		$message = "Your registration with CodeRating is successful! To start using your account, click on the link given http://" . $_SERVER['SERVER_ADDR'] . "/scripts/confirm_registration.php?code=" . $md5sum;
		$headers = "From: coderating3@gmail.com";
		mail($to, $subject, $message, $headers);
*/		mysql_query("INSERT INTO $person VALUES ('', '$name', '$email', '$username', '$password', '')");
		echo "success";		//Return "success" on success else error message
	}
}
if($error == true) {
	echo $reason;
}
?>