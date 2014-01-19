<?php
include "header.php";

$username = $_POST['username'];
$person = $_POST['person'];

include "connect_to_mysql.php";

$groups = mysql_query("SELECT groups from $person WHERE username='$username' LIMIT 1");
$groups = mysql_fetch_array($groups);
$group_code = $groups['groups'];
$grouparray = explode(';', $group_code);
foreach ($grouparray as $group_code) {
	$group_name = mysql_query("SELECT * from groups WHERE group_code='$group_code' LIMIT 1");
	$group_name = mysql_fetch_array($group_name);
	$group_name = $group_name['group_name'];
	$data = mysql_query("SELECT * from posts WHERE group_code='$group_code'");
	while($rows = mysql_fetch_array($data))
	{
		echo 	'<fieldset class="blogpost">
					<legend class="title" align="center"><span style="font-size:200%;color:grey;" id="topic">' . $rows['topic'] . '</span></legend><br>
					<span class="date" style="font-weight:bold;font-size:150%;color:grey;" id="username"> By - ' . $rows['sender'] . '</span>
					<div class="embed-container" style="padding-top: 0; padding-bottom: 0;">' .
						$rows['message'] .
					'</div>
					<button style="font-size:150%;" onclick="likeit(' . $rows['id'] . ')" class="voteup">Vote Up(<span class="likes" id="' . $rows['id'] . '">' . $rows['likes'] .'</span>)
					</button>
				</fieldset>';
	}
}
?>