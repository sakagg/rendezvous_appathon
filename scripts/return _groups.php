<?php
include "header.php";

$username = $_POST['username'];
$person = $_POST['person'];

include "connect_to_mysql.php";
echo "HAW";
$groups = mysql_query("SELECT * from $person WHERE username='$username' LIMIT 1");
$groups = mysql_fetch_array($groups);
$group_code = $groups['groups'];
$grouparray = explode(';', $group_code);
foreach ($grouparray as $group_code)
{
	$group_name = mysql_query("SELECT * FROM groups WHERE group_code='$group_code'");
	$group_name = mysql_fetch_array($group_name);
	$group_name = $group_name['group_name'];
	echo '<option value=' . $group_code . ' name=' . $group_code . ' > ' . $group_name . ' </option>';
}
?>