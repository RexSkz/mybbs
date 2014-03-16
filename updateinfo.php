<?php require "./sessionstart.php" ?>
<html xmlns="http://www.w3.org/1999/xhtml">
<?php require "./headlabel.php" ?>
<body>
	<div id="whole">
		<?php require "./headerandbanner.php"; ?>
		<div id="main" style="text-align:center;">
			<?php
			if(!isset($_SESSION['user']))echo '<span style="text-align:center;">Login first, please?</span>';
			else{
				echo '<h3>Update Your Info</h3>';
				echo '<form action="./update_check.php" method="post">';
					echo '<span style="text-align:left;display:inline-block;width:130px;height:auto;">Old Password:</span><input class="text" name="old" type="password" style="width:150px;" /><br />';
					echo '<span style="text-align:left;display:inline-block;width:130px;height:auto;">New Password:</span><input class="text" name="new" type="password" style="width:150px;" /><br />';
					echo '<span style="text-align:left;display:inline-block;width:130px;height:auto;">Repeat:</span><input class="text" name="rep" type="password" style="width:150px;" /><br />';
					echo '<input class="button" value="Submit" type="submit" />';
					echo '<input class="button" value="Reset" type="reset" />';
				echo '</form>';
			}
			?>
		</div>
		<?php require "./footer.php"; ?>
	</div>
</body>
</html>
