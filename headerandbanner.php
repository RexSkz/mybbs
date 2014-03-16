<div id="header">
	<div id="logo">
		<a href="./index.php"><h1>Mybbs</h1></a>
		<span>&nbsp;A place to post your idea.</span>
	</div>
	<div id="login"><iframe src="./login.php" frameborder=0 width="200px" height="100px" scrolling="no"></iframe></div>
</div>
<div id="banner">
<?php
	$index=$forum=$aboutme=$updateinfo=$theme="banner_button";
	if($_SERVER['PHP_SELF']=="/mybbs/index.php")$index.="_current";
	if($_SERVER['PHP_SELF']=="/mybbs/forum.php" ||
		$_SERVER['PHP_SELF']=="/mybbs/view.php" ||
		$_SERVER['PHP_SELF']=="/mybbs/newpost.php" ||
		$_SERVER['PHP_SELF']=="/mybbs/reply.php" ||
		$_SERVER['PHP_SELF']=="/mybbs/deletefloor.php")$forum.="_current";
	if($_SERVER['PHP_SELF']=="/mybbs/aboutme.php")$aboutme.="_current";
	if($_SERVER['PHP_SELF']=="/mybbs/updateinfo.php")$updateinfo.="_current";
	if($_SERVER['PHP_SELF']=="/mybbs/changetheme.php")$theme.="_current";
	echo '<a href="./index.php"><div class="'.$index.'">Index</div></a>';
	echo '<a href="./forum.php"><div class="'.$forum.'">Forum</div></a>';
	echo '<a href="./aboutme.php"><div class="'.$aboutme.'">About Me</div></a>';
	echo '<a href="./changetheme.php"><div class="'.$theme.'">Theme</div></a>';
	echo '<a href="./updateinfo.php"><div class="'.$updateinfo.'" style="width:180px;float:right;">Update Your Info</div></a>';
?>
</div>
