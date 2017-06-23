function $Showhtml(){
    document.getElementById('playad').style.display = "none";
    player = '<object type="application/x-shockwave-flash" class="player" data="http://static.hdslb.com/play.swf" width="100%" height="'+height+'" id="player_placeholder" style="visibility: visible;"><param name="bgcolor" value="#ffffff"><param name="allowfullscreeninteractive" value="true"><param name="allowfullscreen" value="true"><param name="quality" value="high"><param name="allowscriptaccess" value="always"><param name="wmode" value="direct"><param name="flashvars" value="cid='+unescape(url)+'"></object>';	
    document.getElementById('playlist').innerHTML = player;
}
if(parent.cs_adloadtime){
	setTimeout("$Showhtml();",parent.cs_adloadtime*1000);
}


