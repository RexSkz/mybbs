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
				$content=anti_inject($_POST['content']);
				$id=$_GET['id'];
				$floor=$_GET['floor'];
				$time=date("Y-m-d H:i:s");
				mysql_query("UPDATE postlists SET time='".$time."' WHERE id='".$id."'");
				mysql_query("UPDATE posts SET time='".$time."', content='".$content."' WHERE belong='".$id."' AND floor='".$floor."'");
				$page=($floor-$floor%10)/10;
				echo "Edit successful.<br />";
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
