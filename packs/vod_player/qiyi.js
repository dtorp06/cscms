function $Showhtml(){
    document.getElementById('playad').style.display = "none";
    player = '<embed type="application/x-shockwave-flash" src="http://www.iqiyi.com/player/20131226101834/Player.swf?vid='+unescape(url)+'&autoplay=true" id="movie_player" name="movie_player" type="application/x-shockwave-flash" menu="false" wmode="transparent" allowFullScreen="true" allowScriptAccess="never" allowNetworking="internal" pluginspage="http://www.macromedia.com/go/getflashplayer" width="100%" height="'+height+'">';
    document.getElementById('playlist').innerHTML = player;
}
if(parent.cs_adloadtime){
	setTimeout("$Showhtml();",parent.cs_adloadtime*1000);
}

