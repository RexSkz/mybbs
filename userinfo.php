<?php
	require "./sessionstart.php";
	if($user=="")die("<meta http-equiv=\"refresh\" content=\"0; url=login.php\">");
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<?php require "./logpageheadlabel.php" ?>
<body>
<?php
	require "./connectdatabase.php";
	$privilege=mysql_query("SELECT * FROM users WHERE username='".$_SESSION['user']."'");
	$privilege=mysql_fetch_array($privilege);
	$privilege=$privilege['privilege'];
	switch($privilege){
		case 0:$job="User"; break;
		case 1:$job="Super Master"; break;
		case 2:$job="Administrator"; break;
	}
	$sesusr=decode($_SESSION['user']);
	echo $sesusr."<br /><span class='userprivilege'>".$job."</span><br />";
	echo '<input class="button" onclick="window.location.replace(\'./logout.php\')" type="button" value="Logout" />';
	if($privilege>0)echo '&nbsp;<input class="button" onclick="window.open(\'./adminpage.php\')" type="button" value="Privilege" />';
?>
</body>
</html>
