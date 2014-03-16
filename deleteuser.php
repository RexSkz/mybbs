<?php require "./sessionstart.php" ?>
<html xmlns="http://www.w3.org/1999/xhtml">
<?php require "./headlabel.php" ?>
<body>
	<div id="whole">
		<?php require "./headerandbanner.php"; ?>
		<div id="article">
		<?php
			$backbutton="<a href='javascript:window.history.back();'><input class='button' type='button' value='Back' /></a>";
			if(isset($_SESSION['user'])){
				$chk=$_POST['chk'];
				array_pop($chk);
				if($chk==NULL)echo $backbutton."You didn't select any user!";
				else{
					require "./connectdatabase.php";
					$deletedusers="";
					foreach($chk as $e){
						$e=anti_inject($e);
						mysql_query("DELETE FROM users WHERE username='".$e."'");
						$deletedusers=$deletedusers."&nbsp;".$e;
					}
					echo "User".decode($deletedusers)." deleted.<br />Now we're going back in 2 seconds.";
					echo "<meta http-equiv=\"refresh\" content=\"2; url=adminpage.php\">";
				}
			}else echo $backbutton."&nbsp;Login first, please?";
		?>
		</div>
		<?php require "./footer.php"; ?>
	</div>
</body>
</html>
