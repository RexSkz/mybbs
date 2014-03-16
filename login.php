<?php
	require "./sessionstart.php";
	if(isset($_SESSION['user']) && $_SESSION['user']!="")echo "<meta http-equiv=\"refresh\" content=\"0; url=userinfo.php\">";
	else{
		echo '<html xmlns="http://www.w3.org/1999/xhtml">';
		require "./logpageheadlabel.php";
		echo '<body>';
		echo '<div style="width:200px;margin-left:5px;">';
			echo '<form action="./login_check.php" method="post">';
				echo '<span style="display:inline-block;width:90px;">Username:</span><input class="text" name="usernm" type="text" /><br />';
				echo '<span style="display:inline-block;width:90px;">Password:</span><input class="text" name="passwd" type="password" /><br />';
				echo '<input class="button" value="Login now" type="submit" /> ';
				echo '<input type="button" onclick="window.open(\'./register.php\')" class="button" value="I\'m new!" />';
			echo '</form>';
		echo '</div>';
		echo '</body>';
		echo '</html>';
	}
?>
