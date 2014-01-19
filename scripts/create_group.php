<?php
include "header.php";

$group_name = $_POST['group_name'];
$group_code = $_POST['group_code'];

include "connect_to_mysql.php";
$data = mysql_query("SELECT * from groups WHERE group_code='$group_code'");
$data = mysql_num_rows($data);
if( $data != 0 )
{
	echo "error";
}
else
{
	mysql_query("INSERT INTO groups VALUES ('', '$group_name', '$group_code')");
	echo "success";
}
?>