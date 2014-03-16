<?php
	require "./sessionstart.php";
	if(!isset($_GET['username']))die("");
	$usernm=anti_inject($_GET['username']);
	require "./connectdatabase.php";
	$result=mysql_query("SELECT * FROM users WHERE username='".$usernm."'");
	$row=mysql_fetch_array($result);
	if($row["username"]==$usernm)die("User ".$usernm." already exists!");
	else die("Username ".decode($usernm)." is available.");
?>
