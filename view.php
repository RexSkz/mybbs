<?php require "./sessionstart.php" ?>
<html xmlns="http://www.w3.org/1999/xhtml">
<?php require "./headlabel.php" ?>
<body>
	<div id="whole">
		<?php require "./headerandbanner.php"; ?>
		<div id="main">
		<?php
			$id=$_GET['id'];
			if(isset($_GET['page']))$page=$_GET['page'];
			else $page=0;
			require "./connectdatabase.php";
			if($user!=""){
				$privilege=mysql_query("SELECT * FROM users WHERE username='".$user."'");
				$privilege=mysql_fetch_array($privilege);
				$privilege=$privilege['privilege'];
			}else $privilege=0;
			$result=mysql_query("SELECT * FROM postlists WHERE id='".$id."'");
			echo "<div class='posttitle'>";
				echo "<input style='float:left;margin:auto 0;' type='button' class='button' onclick='window.location=\"./forum.php\"' value='Back to forum' />";
				$have_content=false;
				if($row=mysql_fetch_array($result)){
					$have_content=true;
					echo "<span style='font-size:18px;font-weight:bold;float:left;margin:auto 8px;'>".decode($row['content'])."</span>";
					echo "<div class='floors'>";
						$totalfloor=mysql_query("SELECT * FROM posts WHERE belong='".$id."' ORDER BY floor DESC");
						$totalfloor=mysql_fetch_array($totalfloor);
						$totalfloor=$totalfloor['floor'];
						$totalpage=($totalfloor-$totalfloor%10)/10;
						if($totalfloor%10==0)$totalpage-=1;
						echo "Page:";
						echo "<a href='./view.php?id=".$id."&page=0'><div class='floorssub'>First</div></a>";
						if($page>0)echo "<a href='./view.php?id=".$id."&page=".($page-1)."'><div class='floorssub'>&lt;</div></a>";
						if($totalpage<5){
							for($i=0; $i<=$totalpage; $i++){
								if($i==$page)echo "<div class='floorssubcurrentpage'>".($i+1)."</div>";
								else echo "<a href='./view.php?id=".$id."&page=".$i."'><div class='floorssub'>".($i+1)."</div></a>";
							}
						}else{
							if($page<=1){
								for($i=0; $i<=2; $i++){
									if($i==$page)echo "<div class='floorssubcurrentpage'>".($i+1)."</div>";
									else echo "<a href='./view.php?id=".$id."&page=".$i."'><div class='floorssub'>".($i+1)."</div></a>";
								}
								echo "<span style='margin-left:10px;font-size:14px;'>...</span>";
							}else if($page>=$totalpage-1){
								echo "<span style='margin-left:10px;font-size:14px;'>...</span>";
								for($i=$totalpage-2; $i<=$totalpage; $i++){
									if($i==$page)echo "<div class='floorssubcurrentpage'>".($i+1)."</div>";
									else echo "<a href='./view.php?id=".$id."&page=".$i."'><div class='floorssub'>".($i+1)."</div></a>";
								}
							}else{
								echo "<span style='margin-left:10px;font-size:14px;'>...</span>";
								echo "<a href='./view.php?id=".$id."&page=".($page-1)."'><div class='floorssub'>".$page."</div></a>";
								echo "<div class='floorssubcurrentpage'>".($page+1)."</div>";
								echo "<a href='./view.php?id=".$id."&page=".($page+1)."'><div class='floorssub'>".($page+2)."</div></a>";
								echo "<span style='margin-left:10px;font-size:14px;'>...</span>";
							}
						}
						if($page<$totalpage)echo "<a href='./view.php?id=".$id."&page=".($page+1)."'><div class='floorssub'>&gt;</div></a>";
						echo "<a href='./view.php?id=".$id."&page=".$totalpage."'><div class='floorssub'>Last</div></a>";
					echo "</div>";
				}else echo "Post not found, did you go to a wrong place?";
			echo "</div>";
			if($have_content){
				$page=$page*10+1;
				$next_page=$page+9;
				$result=mysql_query("SELECT * FROM posts WHERE belong='".$id."' AND floor BETWEEN '".$page."' AND '".$next_page."' ORDER BY floor");
				$theauthor="";
				while($row=mysql_fetch_array($result)){
					echo "<div class='post'>";
						echo "<div class='postauthor'>";
						echo $row['author']."<br />";
						$postcount=mysql_query("SELECT * FROM users WHERE username='".$row['author']."'");
						$postcount=mysql_fetch_array($postcount);
						$author_privilege=$postcount['privilege'];
						switch($author_privilege){
							case 0:$job="User"; break;
							case 1:$job="Super Master"; break;
							case 2:$job="Administrator"; break;
						}
						echo $job."<br />";
						echo "Posts: ".$postcount['postcount']."<br />";
						echo "</div>";
						if($theauthor=="")$theauthor=$row['author'];
						echo "<div class='postmain'>";
							echo "<div>";
								$deletestr="---";
								$editstr="---";
								if(isset($user) && ($user==$row['author'] || $theauthor==$user || $privilege>$author_privilege)){
									$deletestr="Delete";
									if($row['floor']==1)$deletestr="Delete All";
									$deletestr="<a href='./deletefloor.php?id=".$id."&floor=".$row['floor']."'>".$deletestr."</a>";
									$editstr="Edit";
									$editstr="<a href='./editfloor.php?id=".$id."&floor=".$row['floor']."'>".$editstr."</a>";
								}
								echo "<div class='controls'>".$deletestr."</div>";
								echo "<span style='font-size:14px;margin:-2px 5px;float:left;'>|</span>";
								echo "<div class='controls'>".$editstr."</div>";
								echo "<div class='posttime'>At ".$row['time']." on floor #".$row['floor']."</div>";
							echo "</div>";
							$content=decode($row['content']);
							$content=str_replace("<script","<null",$content);
							$content=str_replace("</script","</null",$content);
							echo "<div class='postcontent'>".$content."</div>";
						echo "</div>";
					echo "</div>";
				}
			}
		?>
		</div>
		<?php
		if($have_content && $user!=""){
			echo '<div id="reply">';
				echo '<h3>Leave a reply:</h3>';
				echo '<form action="reply.php?id='.$id.'" method="post">';
					echo '<textarea id="editor" class="dopostcontent" type="text" name="content"></textarea>';
					echo '<input class="button" type="submit" value="Reply!" />';
					echo '<input class="button" type="reset" value="Reset" />';
				echo '</form>';
				echo '<script charset="utf-8" src="./editor/kindeditor.js"></script>';
				echo '<script charset="utf-8" src="./editor/lang/zh_CN.js"></script>';
				echo '<script>KindEditor.ready(function(K){window.editor=K.create(\'#editor\');});</script>';
			echo '</div>';
		}
		?>
		<?php require "./footer.php"; ?>
	</div>
</body>
</html>
