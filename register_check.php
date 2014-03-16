<?php require "./sessionstart.php" ?>
<html xmlns="http://www.w3.org/1999/xhtml">
<?php require "./headlabel.php" ?>
<body>
	<div id="whole">
		<?php require "./headerandbanner.php"; ?>
		<div id="main" style="text-align:center;">
		<?php
			$back_button="<input class='button' onclick='window.location=\"./register.php\"' type='button' value='Back' />";
			if(isset($_POST['code']) && isset($_SESSION['code']) && strtoupper($_POST['code'])==strtoupper($_SESSION['code'])){
				$_SESSION['code']=NULL;
				$usernm=anti_inject($_POST["usernm"]);
				$passwd=$_POST["passwd"];
				$repeat=$_POST["repeat"];
				if($usernm=="" || $passwd=="")echo $back_button."Username or password can't be empty!";
				else if($passwd!=$repeat)echo $back_button."Repeat password is incorrect!";
				else {
					require "./connectdatabase.php";
					$result=mysql_query("SELECT * FROM users WHERE username='".$usernm."'");
					$row=mysql_fetch_array($result);
					if($row["username"]==$usernm)echo $back_button."User ".$usernm." already exists.";
					else {
						$passwd=md5($passwd);
						mysql_query("INSERT INTO users VALUES('".$usernm."','".$passwd."','0','0','black')");
						echo "Welcome, new user ".decode($usernm).".<br />";
						echo "Now we're going back in 2 seconds.";
						echo "<meta http-equiv=\"refresh\" content=\"2; url=forum.php\">";
					}
				}
			}else echo $back_button."&nbsp;Verify code wrong!";
			$_SESSION['code']=NULL;
		?>
		</div>
		<?php require "./footer.php"; ?>
	</div>
</body>
</html>
