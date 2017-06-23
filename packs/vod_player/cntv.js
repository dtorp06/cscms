function $Showhtml(){
    document.getElementById('playad').style.display = "none";
    player = '<embed allowfullscreen="true" wmode="opaque" src="http://player.cntv.cn/standard/cntvplayer20150514.swf?v=0.171.5.8.9.6.3.5.0&videoCenterId='+unescape(url)+'&videoId=20110711" quality="high" bgcolor="#000" width="100%" height="'+height+'" name="player" id="playerr" align="middle" allowScriptAccess="always" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer"></embed>';
    document.getElementById('playlist').innerHTML = player;
}
if(parent.cs_adloadtime){
	setTimeout("$Showhtml();",parent.cs_adloadtime*1000);
}


