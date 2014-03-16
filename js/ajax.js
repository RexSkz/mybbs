function checkVerifyCode(code){
	var xmlHttp;
	try{
		xmlHttp=new XMLHttpRequest();
	}catch(e){
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
		}catch(e){
			alert("您的浏览器已经很旧了，请更换浏览器！");
			return false;
		}
	}
	xmlHttp.onreadystatechange=function(){
		if(xmlHttp.readyState==4)jQuery("#checkCode").css("background","url(./images/code"+xmlHttp.responseText+".png) no-repeat center center");
	}
	xmlHttp.open("GET","checkcode.php?code="+code+"&rnd="+Math.random(),true);
	xmlHttp.send(null);
}
function checkUsername(username){
	if(username==null||username==""){
		document.getElementById("usernamecheck").innerHTML="Please input username!";
		return false;
	}
	var xmlHttp;
	try{
		xmlHttp=new XMLHttpRequest();
	}catch(e){
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
		}catch(e){
			alert("您的浏览器已经很旧了，请更换浏览器！");
			return false;
		}
	}
	xmlHttp.onreadystatechange=function(){
		if(xmlHttp.readyState==4)document.getElementById("usernamecheck").innerHTML=xmlHttp.responseText;
	}
	xmlHttp.open("GET","checkusername.php?username="+username,true);
	xmlHttp.send(null);
}
function CharMode(iN){
	if(iN>=48&&iN<=57)return 1;
	if(iN>=65&&iN<=90)return 2;
	if(iN>=97&&iN<=122)return 4;
	else return 8;
}
function bitTotal(num){
	modes=0;
	for(i=0;i<4;i++){
		if(num&1)modes++;
		num>>>=1;
	}
	return modes;
}
function checkStrong(sPW){
	if(sPW.length<=4)return 0;
	Modes=0;
	for(i=0;i<sPW.length;i++)Modes|=CharMode(sPW.charCodeAt(i));
	return bitTotal(Modes);
}
function checkPassword(pwd){
	O_color="#444";
	L_color="#F00";
	M_color="#F90";
	H_color="#3C0";
	if(pwd==null||pwd=='')Lcolor=Mcolor=Hcolor=O_color;
	else{
		S_level=checkStrong(pwd);
		switch(S_level){
			case 0:
				Lcolor=Mcolor=Hcolor=O_color;
			case 1:
				Lcolor=L_color;
				Mcolor=Hcolor=O_color;
				break;
			case 2:
				Lcolor=Mcolor=M_color;
				Hcolor=O_color;
				break;
			default:
				Lcolor=Mcolor=Hcolor=H_color;
		}
	}
	jQuery("#pwd_L").css("background-color",Lcolor);
	jQuery("#pwd_M").css("background-color",Mcolor);
	jQuery("#pwd_H").css("background-color",Hcolor);
	return;
}
function checkRepeatPassword(repeatpassword){
	password=document.getElementById("passwd").value;
	if(password==repeatpassword)t="Repeat password is OK.";
	else t="The two passwords do not match!";
	document.getElementById("repeatpasswordcheck").innerHTML=t;
}
function updateVerifyCodeText(){
	var xmlHttp;
	try{
		xmlHttp=new XMLHttpRequest();
	}catch(e){
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
		}catch(e){
			alert("您的浏览器已经很旧了，请更换浏览器！");
			return false;
		}
	}
	xmlHttp.onreadystatechange=function(){
		if(xmlHttp.readyState==4)document.getElementById("vcode").innerHTML="Verification code is: "+xmlHttp.responseText;
	}
	xmlHttp.open("GET","getcode.php",true);
	xmlHttp.send(null);
}
