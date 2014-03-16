<?php require "./sessionstart.php" ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php require "./headlabel.php" ?>
<body>
	<div id="whole">
		<?php require "./headerandbanner.php"; ?>
		<div id="article">
		<?php
			if($user!=""){
				require "./connectdatabase.php";
				$privilege=mysql_query("SELECT * FROM users WHERE username='".$user."'");
				$privilege=mysql_fetch_array($privilege);
				$privilege=$privilege['privilege'];
				if($privilege==0)echo "You are lack of permission.";
				else{
					echo '<form action="./deleteuser.php" method="post">';
						echo "<h4>User list:</h4>";
						$userlist=mysql_query("SELECT * FROM users WHERE privilege<'".$privilege."' ORDER BY privilege,username");
						echo '<input class="button" style="margin-bottom:10px;width:180px;" type="submit" value="Delete checked user" /><br />';
						while($row=mysql_fetch_array($userlist)){
							switch($row['privilege']){
								case 0:$job="User"; break;
								case 1:$job="Super Master"; break;
								case 2:$job="Administrator"; break;
							}
							echo '<div class="deleteuserlist">';
								echo '<input class="checkbox" type="checkbox" name="chk[]" value="'.$row['username'].'" />';
								echo '<span>'.$row['username'].'</span>';
								echo '<span style="width:200px;text-align:right;float:right;margin-right:5px;">'.$job."</span>";
							echo '</div>';
						}
						echo '<input style="display:none;" type="checkbox" name="chk[]" value="-" checked=1 />';
					echo '</form>';
				}
			}else echo "Login first, please?";
		?>
		</div>
		<?php require "./footer.php"; ?>
	</div>
</body>
</html>
