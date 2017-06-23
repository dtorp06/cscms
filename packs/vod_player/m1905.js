function $Showhtml(){
    document.getElementById('playad').style.display = "none";
    player = '<embed type="application/x-shockwave-flash" src="http://static.m1905.com/v/20140716/v.swf" width="100%" height="'+height+'" style="" id="__M1905FlashPlayer__" name="__M1905FlashPlayer__" bgcolor="#00000" quality="high" allowscriptaccess="always" allownetworking="all" allowfullscreen="true" wmode="Opaque" flashvars="configUrl=http://static.m1905.com/profile/vod/9/0/'+unescape(url)+'_1.xml&amp;LoGo=false&amp;wide=false&amp;hd=true&amp;light=true&amp;playAd=false&amp;autoPlay=true&amp;cdn=false">';
    document.getElementById('playlist').innerHTML = player;
}
if(parent.cs_adloadtime){
	setTimeout("$Showhtml();",parent.cs_adloadtime*1000);
}


