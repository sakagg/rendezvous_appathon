<?php
include "header.php";

$username = $_POST['username'];
$person = $_POST['person'];
$group_code = $_POST['group_code'];

include "connect_to_mysql.php";
$groups = mysql_query("SELECT groups from $person WHERE username='$username' LIMIT 1");
$groups = mysql_fetch_array($groups);
$groups = $groups['groups'];
$groups = $groups . $group_code . ";";
mysql_query("UPDATE $person SET groups='$groups' WHERE username='$username' LIMIT 1");
echo "success";
?>