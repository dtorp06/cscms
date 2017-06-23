function $Showhtml(){
    document.getElementById('playad').style.display = "none";
    player = '<embed allowfullscreen="true" wmode="transparent" quality="high" src="http://video.kankan.com/dt/swf/v_sina.swf?id='+unescape(url)+'&vtype=1&mtype=teleplay" quality="high" bgcolor="#000" width="100%" height="'+height+'" name="player" id="playerr" align="middle" allowScriptAccess="always" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer"></embed>';
    document.getElementById('playlist').innerHTML = player;
    start(url);
}

if(parent.cs_adloadtime){
	setTimeout("$Showhtml();",parent.cs_adloadtime*1000);
}


