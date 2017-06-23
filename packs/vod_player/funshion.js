function $Showhtml(){
    document.getElementById('playad').style.display = "none";
    player = '<embed type="application/x-shockwave-flash" src="http://static.funshion.com/market/p2p/openplatform/master/2015-2-13/FunVodPlayer_1.0.1.2.swf" id="Player" bgcolor="#FFFFFF" quality="high" allowfullscreen="true" allowNetworking="internal" allowscriptaccess="never" wmode="transparent" menu="false" always="false" flashvars="pauseAp=&mediaAp=c_wb_1_lv&userSeek=1&type=movie&partner=69&funshionSetup=0&start=1&itemid='+unescape(url)+'&startAd=0&userMac=&poster=&stopUrl=" pluginspage="http://www.macromedia.com/go/getflashplayer" width="100%" height="'+height+'">';
    document.getElementById('playlist').innerHTML = player;
}
if(parent.cs_adloadtime){
	setTimeout("$Showhtml();",parent.cs_adloadtime*1000);
}


