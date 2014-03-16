<?php require "./sessionstart.php" ?>
<html xmlns="http://www.w3.org/1999/xhtml">
<?php require "./headlabel.php" ?>
<body>
	<div id="whole">
		<?php require "./headerandbanner.php"; ?>
		<div id="main" style="text-align:center;">
			<?php
			if(isset($_GET['color'])){
				if($_GET['color']=="light")$color="white";
				else $color="black";
				require "./connectdatabase.php";
				mysql_query("UPDATE users SET color='".$color."' WHERE username='".$_SESSION['user']."'");
				echo "<script>window.location.replace('./index.php');</script>";
			}
			if(!isset($_SESSION['user']))echo '<span style="text-align:center;">Login first, please?</span>';
			else{
				echo '<h3>Select The Theme You Like</h3>';
				echo '<form>';
					echo '<a href="./changetheme.php?color=dark">';
					echo '<img style="margin:10px 10px;margin-top:0;width:325px;height:216px;" src="./images/dark.png" /></a>';
					echo '<a href="./changetheme.php?color=light">';
					echo '<img style="margin:10px 10px;margin-top:0;width:325px;height:216px;" src="./images/light.png" /></a><br />';
				echo '</form>';
			}
			?>
		</div>
		<?php require "./footer.php"; ?>
	</div>
</body>
</html>
