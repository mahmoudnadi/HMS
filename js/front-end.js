function hideScroll(){
	var temp = document.getElementById("lock").style;
	if(temp.overflow == "auto"){
		temp.overflow = "hidden";
	}else temp.overflow = "auto";
}