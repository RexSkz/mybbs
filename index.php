<?php require "./sessionstart.php" ?>
<html xmlns="http://www.w3.org/1999/xhtml">
<?php require "./headlabel.php" ?>
<body>
	<div id="whole">
		<?php require "./headerandbanner.php"; ?>
		<div id="article">
			<h3>Features:<br /></h3>
			<div id="indexswitchercontainer">
				<div id="indexswitcherarrowleft" onclick="moveleft();"></div>
				<div style="float:left;width:931px;height:250px;overflow:hidden;">
					<div id="indexswitcher">
						<img src="./images/features/1.png" /><img src="./images/features/2.png" /><img src="./images/features/3.png" />
					</div>
				</div>
				<div id="indexswitcherarrowright" onclick="moveright();"></div>
			</div>
		</div>
		<div id="article">
			<h3>Newly post:<br /></h3>
			<div class="newlypost">
			<?php
				require "./connectdatabase.php";
				$result=mysql_query("SELECT * FROM postlists ORDER BY time DESC LIMIT 5");
				$count=5;
				while($row=mysql_fetch_array($result)){
					$count-=1;
					$firstfloor=mysql_query("SELECT * FROM posts WHERE belong='".$row['id']."' ORDER BY floor LIMIT 1");
					$firstfloor=mysql_fetch_array($firstfloor);
					$firstfloor=strip_tags($firstfloor['content']);
					if(strlen($firstfloor)>200)$firstfloor=substr($firstfloor, 0, 200);
					echo "<div class='indexpostlist'>";
					echo "<a href='./view.php?id=".$row['id']."'><div class='indexpostlistcontent'>".$row['content']."</div></a>";
					echo "<br /><div class='indexpostlistauthor'>Latest reply from ".decode($row['author'])."</div><br />";
					echo "<div class='indexfirstfloor'>".$firstfloor."</div>";
					echo "</div>";
				}
				while($count--)echo "<div class='indexpostlist'>-</div>";
			?>
			</div>
		</div>
		<?php require "./footer.php"; ?>
	</div>
</body>
</html>
