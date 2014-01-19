<?php
include "header.php";

$error = false;
$username = $_POST['username'];
$message = $_POST['message'];
$topic = $_POST['topic'];
$group = $_POST['group'];

if ($message=='' || $topic=='') {
	$error = true;
	$reason = "All fields are Compulsory!!";
}
else {
include "connect_to_mysql.php";
mysql_query("INSERT INTO posts VALUES ('', '$message', '$topic', '$group', '$username', '0')");
echo "success";
}
if($error == true) {
	echo $reason;
}
?>