<?php
echo "happy";
include "header.php";

$id = $_POST['id'];

include "connect_to_mysql.php";

sql_query("UPDATE posts SET likes=5 WHERE id='$id'");
$likes = sql_query("SELECT likes from posts WHERE id='$id'");
$likes = sql_fetch_array($likes);
$likes = $likes['likes'];
echo $likes;

?>