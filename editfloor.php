<?php require "./sessionstart.php" ?>
<html xmlns="http://www.w3.org/1999/xhtml">
<?php require "./headlabel.php" ?>
<body>
	<div id="whole">
		<?php require "./headerandbanner.php"; ?>
		<div id="main" style="text-align:center;">
		<?php
			$id=$_GET['id'];
			$floor=$_GET['floor'];
			$page=($floor-$floor%10)/10;
			if($floor%10==0)$page-=1;
			$back_button="<a href='./view.php?id=".$id."&page=".$page."'><input class='button' type='button' value='Back' /></a>";
			require "./connectdatabase.php";
			$content=mysql_query("SELECT * FROM posts WHERE belong='".$id."' AND floor='".$floor."'");
			$content=mysql_fetch_array($content);
			$author=$content['author'];
			$author=mysql_query("SELECT * FROM users WHERE username='".$author."'");
			$author=mysql_fetch_array($author);
			if(isset($_SESSION['user']))$user=$_SESSION['user'];
			else $user="";
			$user=mysql_query("SELECT * FROM users WHERE username='".$user."'");
			$user=mysql_fetch_array($user);
			if($content=="")echo "<span>".$back_button."The floor is empty.<br />Did you go to a wrong place?</span>";
			else if($author['username']==$user['username'] || $user['privilege']>$author['privilege']){
				echo '<div id="reply">';
					echo '<h3>Edit (id='.$id.' floor='.$floor.') :</h3>';
					echo '<form action="edit.php?id='.$id.'&floor='.$floor.'" method="post">';
						echo '<textarea id="editor" class="dopostcontent" type="text" name="content">';
						echo $content['content'];
						echo '</textarea>';
						echo '<input class="button" type="submit" value="Apply" />';
						echo '<input class="button" type="reset" value="Reset" />';
						echo $back_button;
					echo '</form>';
				echo '</div>';
				echo '<script charset="utf-8" src="./editor/kindeditor.js"></script>';
				echo '<script charset="utf-8" src="./editor/lang/zh_CN.js"></script>';
				echo '<script>KindEditor.ready(function(K){window.editor=K.create(\'#editor\');});</script>';
			}else echo "<span>".$back_button."You have no permission to edit this post.</span>";
		?>
		</div>
		<?php require "./footer.php"; ?>
	</div>
</body>
</html>
