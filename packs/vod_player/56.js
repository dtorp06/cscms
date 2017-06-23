function $Showhtml(){
    document.getElementById('playad').style.display = "none";
    player = '<embed src="http://share.vrs.sohu.com/my/v.swf&topBar=1&id='+unescape(url)+'&autoplay=false&from=page" type="application/x-shockwave-flash" width="100%" height="'+height+'" allowfullscreen="true" allownetworking="all" allowscriptaccess="always"></embed>';
    document.getElementById('playlist').innerHTML = player;
}
if(parent.cs_adloadtime){
	setTimeout("$Showhtml();",parent.cs_adloadtime*1000);
}


