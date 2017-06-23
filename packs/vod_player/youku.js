function $Showhtml(){
	var ykurl = unescape(url);
	if(ykurl.substr(0,7).toLowerCase()=="http://"){
		var arr = ykurl.split("id_");
		var arr1 = arr[1].split(".");
		ykurl = arr1[0];
	}
    document.getElementById('playad').style.display = "none";
    var player = "<iframe height='"+height+"'' width='100%' src='http://player.youku.com/player.php/sid/"+ykurl+"/v.swf' frameborder=0 'allowfullscreen'></iframe>";
    document.getElementById('playlist').innerHTML = player;
}
if(parent.cs_adloadtime){
	setTimeout("$Showhtml();",parent.cs_adloadtime*1000);
}