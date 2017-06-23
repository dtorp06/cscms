function $Showhtml(){
    document.getElementById('playad').style.display = "none";
    player = '<embed type="application/x-shockwave-flash" src="http://i1.hunantv.com/ui/swf/player/v0701/main.swf?video_id='+unescape(url)+'&root_id=2&purview=0" id="movie_player" name="movie_player" type="application/x-shockwave-flash" menu="false" wmode="transparent" allowFullScreen="true" allowScriptAccess="never" allowNetworking="internal" pluginspage="http://www.macromedia.com/go/getflashplayer" width="100%" height="'+height+'"></embed>';
    document.getElementById('playlist').innerHTML = player;
}
if(parent.cs_adloadtime){
	setTimeout("$Showhtml();",parent.cs_adloadtime*1000);
}


