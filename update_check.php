<?php require "./sessionstart.php" ?>
<html xmlns="http://www.w3.org/1999/xhtml">
<?php require "./headlabel.php" ?>
<body>
	<div id="whole">
		<?php require "./headerandbanner.php"; ?>
		<div id="main" style="text-align:center;">
		<?php
			$old=$new=$rep="";
			if(isset($_POST['old']))$old=md5($_POST['old']);
			if(isset($_POST['new']))$new=md5($_POST['new']);
			if(isset($_POST['rep']))$rep=md5($_POST['rep']);
			$back_button="<input class='button' onclick='window.location=\"./updateinfo.php\"' type='button' value='Back' />";
			require "./connectdatabase.php";
			if(isset($_SESSION['user'])){
				$passwd=mysql_query("SELECT * FROM users WHERE username='".$_SESSION['user']."'");
				$passwd=mysql_fetch_array($passwd);
				$passwd=$passwd['password'];
				if($old!=$passwd)echo $back_button."Old password wrong!";
				else if($new!=$rep)echo $back_button."Repeat password is incorrect!";
				else{
					$result=mysql_query("SELECT * FROM users WHERE username='".$old."'");
					$row=mysql_fetch_array($result);
					mysql_query("UPDATE users SET password='".$new."' WHERE username='".$_SESSION['user']."'");
					echo "You have sucessfully changed your password.<br />Now we're going back in 2 seconds.";
					echo "<meta http-equiv=\"refresh\" content=\"2; url=updateinfo.php\">";
				}
			}else echo $back_button."&nbsp;Login first please?";
		?>
		</div>
		<?php require "./footer.php"; ?>
	</div>
</body>
</html>
