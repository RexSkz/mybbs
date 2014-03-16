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
				$id=$_GET['id'];
				$time=date("Y-m-d H:i:s");
				mysql_query("UPDATE postlists SET time='".$time."',author='".$_SESSION['user']."' WHERE id='".$id."'");
				$result=mysql_query("SELECT * FROM posts WHERE belong=".$id);
				$maxfloor=0;
				while($row=mysql_fetch_array($result)){
					if($row['floor']>$maxfloor)$maxfloor=$row['floor'];
				}
				$maxfloor+=1;
				$content=$_POST['content'];
				$content=str_replace("\\", "\\\\", $content);
				$content=str_replace("'", "\'", $content);
				mysql_query("INSERT INTO posts VALUES('".$content."','".$_SESSION['user']."','".$time."','".$id."','".$maxfloor."')");
				$page=($maxfloor-$maxfloor%10)/10;
				if($maxfloor%10==0)$page-=1;
				echo "Reply successful.<br />";
				echo "Now we're going back in 2 seconds.";
				echo "<meta http-equiv=\"refresh\" content=\"2; url=view.php?id=".$id."&page=".$page."\">";
			}else{
				echo "<a href='javascript:window.history.back();'><input class='button' type='button' value='Back' /></a>&nbsp;Login first, please?";
			}
		?>
		</div>
		<?php require "./footer.php"; ?>
	</div>
</body>
</html>
