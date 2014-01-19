<?php

include "header.php";

$id = $_POST['id'];

include "connect_to_mysql.php";

mysql_query("UPDATE posts SET likes=likes+1 WHERE id='$id'");
$likes = mysql_query("SELECT * from posts WHERE id='$id'");
$likes = mysql_fetch_array($likes);
$likes = $likes['likes'];
echo $likes;

?>