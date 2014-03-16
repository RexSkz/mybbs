pos=0;
function moveleft(){
	if(pos==0)return false;
	pos-=1;
	jQuery("#indexswitcher").animate({left:'+=931px'});
}
function moveright(overflow){
	if(pos==2 && !overflow)return false;
	if(pos==2){
		jQuery("#indexswitcher").animate({left:'0px'});
		pos=0;
		return true;
	}
	pos+=1;
	jQuery("#indexswitcher").animate({left:'-=931px'});
}
jQuery(document).ready(function(){timecontrol=setInterval("moveright(true)",5000);});
