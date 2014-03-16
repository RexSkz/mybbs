<?php
	session_start();
	if(isset($_GET['code']) && strtoupper($_SESSION['code'])==strtoupper($_GET['code']))
		echo "right";
	else echo "wrong";
?>
