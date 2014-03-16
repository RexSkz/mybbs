<?php require "./sessionstart.php" ?>
<html xmlns="http://www.w3.org/1999/xhtml">
<?php require "./headlabel.php" ?>
<body>
	<div id="whole">
		<?php require "./headerandbanner.php"; ?>
		<div id="main">
		<?php
			require "./connectdatabase.php";
			$result=mysql_query("SELECT * FROM postlists ORDER BY time DESC");
			$success=false;
			echo '<h3 style="margin-left:25px;">Current post</h3>';
			while($row=mysql_fetch_array($result)){
				$success=true;
				echo "<div class='postlist'>";
				echo "<div class='postlistcontent'>&nbsp;&gt;&nbsp;<a href='./view.php?id=".$row['id']."'>".$row['content']."</a></div>";
				echo "<div class='postlistauthor'>Latest reply from ".decode($row['author'])."</div>";
				echo "<div class='postlisttime'>".$row['time']."</div>";
				echo "</div>";
			}
			if(!$success)echo "<div class='postlist'>No postlist found.</div>";
		?>
		</div>
		<?php
		if(isset($_SESSION['user']) && $_SESSION['user']!=""){
			echo '<div id="newpost">';
				echo '<h3>New post:</h3>';
				echo '<form action="newpost.php" method="post">';
					echo '<span>Title:&nbsp;</span><input class="doposttitle" type="text" name="title" /><br />';
					echo '<textarea id="editor" class="dopostcontent" type="text" name="content"></textarea>';
					echo '<input class="button" type="submit" value="Submit!" />';
					echo '<input class="button" type="reset" value="Reset" />';
				echo '</form>';
			echo '</div>';
			echo '<script charset="utf-8" src="./editor/kindeditor.js"></script>';
			echo '<script charset="utf-8" src="./editor/lang/zh_CN.js"></script>';
			echo '<script>KindEditor.ready(function(K){window.editor=K.create(\'#editor\');});</script>';
		}
		?>
		<?php require "./footer.php"; ?>
	</div>
</body>
</html>
