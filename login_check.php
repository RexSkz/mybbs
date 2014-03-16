<?php require "./sessionstart.php" ?>
<html xmlns="http://www.w3.org/1999/xhtml">
<?php require "./logpageheadlabel.php" ?>
<body>
<?php
	if(isset($_POST['usernm']))$usernm=$_POST['usernm'];
	if(isset($_POST['passwd']))$passwd=$_POST['passwd'];
	$back_button="<br /><input class='button' onclick='window.location.replace(\"./login.php\")' type='button' value='Back' /></a>";
	if(!isset($usernm) || $usernm=="" || !isset($passwd) || $passwd=="")die("Username or password can't be empty!".$back_button);
	require "./connectdatabase.php";
	$usernm=anti_inject($usernm);
	$user=mysql_query("SELECT * FROM users WHERE username='".$usernm."'");
	$passwd=md5($passwd);
	$success=false;
	while($row=mysql_fetch_array($user))
		if($row['password']==$passwd){
			$success=true;
			break;
		}
	if($success){
		$_SESSION['user']=$usernm;
		echo "<script>window.top.location=window.top.location.href;</script>";
	}else die("Username or password wrong.".$back_button);
?>
</body>
</html>
