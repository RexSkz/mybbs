<?php require "./sessionstart.php" ?>
<html>
<?php require "./logpageheadlabel.php" ?>
<body>
<?php
	session_destroy();
	echo "<script>window.top.location.replace(window.top.location.href);</script>";
	echo "<script>window.location.replace('./login.php');</script>";
	die("");
?>
</body>
</html>
