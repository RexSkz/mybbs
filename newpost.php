<?php require "./sessionstart.php" ?>
<html xmlns="http://www.w3.org/1999/xhtml">
<?php require "./headlabel.php" ?>
<body>
	<div id="whole">
		<?php require "./headerandbanner.php"; ?>
		<div id="main" style="text-align:center;">
		<?php
			require "./connectdatabase.php";
			if(isset($_SESSION['user'])){
				$postcount=mysql_query("SELECT * FROM users WHERE username='".$_SESSION['user']."'");
				$postcount=mysql_fetch_array($postcount);
				$postcount=$postcount['postcount']+1;
				mysql_query("UPDATE users SET postcount='".$postcount."' WHERE username='".$_SESSION['user']."'");
				$result=mysql_query("SELECT * FROM postlists");
				$time=date("Y-m-d H:i:s");
				$title=anti_inject($_POST['title']);
				mysql_query("INSERT INTO postlists VALUES('".$title."','".$_SESSION['user']."','".$time."',NULL)");
				$id=mysql_query("SELECT * FROM postlists WHERE content='".$title."'");
				$id=mysql_fetch_array($id);
				$id=$id['id'];
				$content=$_POST['content'];
				$content=str_replace("\\", "\\\\", $content);
				$content=str_replace("'", "\'", $content);
				mysql_query("INSERT INTO posts VALUES('".$content."','".$_SESSION['user']."','".$time."','".$id."',1)");
				echo "You have successfully posted your text.<br />";
				echo "Now we're going back.";
				echo "<meta http-equiv=\"refresh\" content=\"2; url=view.php?id=".$id."\">";
			}else{
				echo "<a href='javascript:window.history.back();'><input class='button' type='button' value='Back' /></a>&nbsp;Login first, please?";
			}
		?>
		</div>
		<?php require "./footer.php"; ?>
	</div>
</body>
</html>
