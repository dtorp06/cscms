function $Showhtml(){
    document.getElementById('playad').style.display = "none";
    player = '<embed type="application/x-shockwave-flash" src="http://static.video.qq.com/v1/res/QQPlayer.swf" id="Player" bgcolor="#FFFFFF" quality="high" allowfullscreen="true" allowNetworking="internal" allowscriptaccess="never" wmode="transparent" menu="false" always="false"  pluginspage="http://www.macromedia.com/go/getflashplayer" width="100%" height="'+height+'" flashvars="&skin=http://static.video.qq.com/v1/res/skins/QQPlayerSkin.swf&autoplay=1&vid='+unescape(url)+'">';
    document.getElementById('playlist').innerHTML = player;
}
if(parent.cs_adloadtime){
	setTimeout("$Showhtml();",parent.cs_adloadtime*1000);
}


