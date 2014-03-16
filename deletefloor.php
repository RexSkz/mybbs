<?php require "./sessionstart.php" ?>
<html xmlns="http://www.w3.org/1999/xhtml">
<?php require "./headlabel.php" ?>
<body>
	<div id="whole">
		<?php require "./headerandbanner.php"; ?>
		<div id="main" style="text-align:center;">
		<?php
			require "./connectdatabase.php";
			$id=$_GET['id'];
			$floor=$_GET['floor'];
			$author=mysql_query("SELECT * FROM posts WHERE belong='".$id."' AND floor='".$floor."'");
			$author=mysql_fetch_array($author);
			$page=($floor-$floor%10)/10;
			if($floor%10==0)$page-=1;
			$back_button="<a href='javascript:window.history.back();'><input class='button' type='button' value='Back' /></a>";
			if(!$author)echo $back_button."&nbsp;Wrong post id or floor!";
			else if(isset($_SESSION['user'])){
				$author=$author['author'];
				$privilege=mysql_query("SELECT * FROM users WHERE username='".$_SESSION['user']."'");
				$privilege=mysql_fetch_array($privilege);
				$privilege=$privilege['privilege'];
				$hisprivilege=mysql_query("SELECT * FROM users WHERE username='".$author."'");
				$hisprivilege=mysql_fetch_array($hisprivilege);
				$hisprivilege=$hisprivilege['privilege'];
				if($author==$_SESSION['user'] || $privilege>$hisprivilege){
					mysql_query("DELETE FROM posts WHERE belong=".$id." AND floor=".$floor);
					if($_GET['floor']==1){
						mysql_query("DELETE FROM posts WHERE belong=".$id);
						mysql_query("DELETE FROM postlists WHERE id=".$id);
					}
					echo "Delete successful.<br />";
					echo "Now we're going back in 2 seconds.";
					$floor-=1;
					$page=($floor-$floor%10)/10;
					if($floor%10==0)$page-=1;
					if($_GET['floor']==1)echo "<meta http-equiv=\"refresh\" content=\"2; url=forum.php\">";
					else echo "<meta http-equiv=\"refresh\" content=\"2; url=view.php?id=".$id."&page=".$page."\">";
				}else echo $back_button."&nbsp;You are lack of permission.";
			}else echo $back_button."&nbsp;Login first, please?.";
		?>
		</div>
		<?php require "./footer.php"; ?>
	</div>
</body>
</html>
