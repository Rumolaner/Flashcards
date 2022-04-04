function ausgabe(ev)
{
    if(navigator.appName == "Netscape"){
        if(ev.which == 13){
		   document.getElementById("submit").click();
           return false;
        }
    }else if(navigator.appName == "Microsoft Internet Explorer"){
       if(window.event.keyCode == 13){
		   document.getElementById("submit").click();
           return false;  
       }
    }
}
 
document.onkeydown = ausgabe;