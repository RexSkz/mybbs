<?php
	$_SESSION['user']="";
	$_SESSION['color']="";
	session_start();
	if(isset($_SESSION['user']))$user=$_SESSION['user'];
	else $user="";
	require "./connectdatabase.php";
	if($user=="")$_SESSION['color']="black";
	else{
		$color=mysql_query("SELECT * FROM users WHERE username='".$user."'");
		$color=mysql_fetch_array($color);
		$_SESSION['color']=$color['color'];
	}
	function anti_inject($str){
		$str=str_replace("\\", "\\\\", $str);
		$str=str_replace("'", "\'", $str);
		$str=str_replace("<", "&lt;", $str);
		$str=str_replace(">", "&gt;", $str);
		return $str;
	}
	function decode($str){
		$str=str_replace("\\\\", "\\", $str);
		$str=str_replace("\'", "'", $str);
		return $str;
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
