function $Showhtml(){
    document.getElementById('playad').style.display = "none";
    player = "<embed src=\"http://www.yinyuetai.com/video/player/"+unescape(url)+"/a_0.swf\" wmode=\"opaque\" quality=\"high\" width=\"100%\" height=\""+height+"\" align=\"middle\"  allowScriptAccess=\"sameDomain\" type=\"application/x-shockwave-flash\"></embed>";
    document.getElementById('playlist').innerHTML = player;
}
if(parent.cs_adloadtime){
	setTimeout("$Showhtml();",parent.cs_adloadtime*1000);
}


