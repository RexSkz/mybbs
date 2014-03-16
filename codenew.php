<?php
	session_start();
	header("Content-type: image/png");
	$str="A,B,C,D,E,F,G,H,I,J,K,L,M,N,O,P,Q,R,S,T,U,V,W,X,Y,Z";
	$list=explode(",",$str);
	$cmax=count($list)-1;
	$verifyCode='';
	for($i=0;$i<5;$i++){
		$randnum=mt_rand(0,$cmax);
		$verifyCode.=$list[$randnum];
	}
	$_SESSION['code']=$verifyCode;
	$im=imagecreate(53,21);
	$black=imagecolorallocate($im,0,0,0);
	$white=imagecolorallocate($im,255,255,255);
	$gray=imagecolorallocate($im,200,200,200);
	$red=imagecolorallocate($im,255,0,0);
	imagefill($im,0,0,$white);
	for($i=0;$i<50;$i++){
		imagesetpixel($im,mt_rand(0,53),mt_rand(0,21),$black);
		imagesetpixel($im,mt_rand(0,53),mt_rand(0,21),$red);
		imagesetpixel($im,mt_rand(0,53),mt_rand(0,21),$gray);
	}
	for($i=0;$i<5;$i++){
		imagearc($im,rand(0,53),rand(0,21),20,20,75,170,$gray);
		imageline($im,rand(0,53),rand(0,21),rand(0,53),rand(0,21),$red);
	}
	imagestring($im,8,4,2,$verifyCode,$black);
	imagepng($im);
	imagedestroy($im);
?>
