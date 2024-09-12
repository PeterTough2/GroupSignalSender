// JavaScript Document

function getCookie(cname) {
var read_cookies = document.cookie;
var split_read_cookie = read_cookies.split(";");

for (i=0; i<split_read_cookie.length; i++){
    var CookieValue = split_read_cookie[i];
    var pair = CookieValue.split("=");
	var name = pair[0].trim();
	var value = pair[1];
	if(name == cname){
        return value;
    }
}
}

var seconds = new Date().getTime();
seconds = seconds.toFixed(0);
document.cookie = "CASLastActivity="+seconds+"; path =/";

var aminute = 60000;//60 seconds * 1
var timeout = aminute * 60 * 24; // 3600 corresponding with the server settings [1 hour]
//window.setTimeout('timeout_trigger()', aminute);

function timeout_trigger() {
	var LastActivity = getCookie('CASLastActivity');
	var curtime = new Date().getTime();
	curtime = curtime.toFixed(0);
	var timediff = curtime - LastActivity;
	if (timediff >= timeout) {
		//redirect to logout script
		if(self==top){
			window.location.href = 'logout.php';//main page
		}
		else {
			window.parent.location.href = 'logout.php';//popup iframe
		}
		alert('Session has expired');
	}
	
	else {
		//window.setTimeout('timeout_trigger()', aminute);
	}
}

setInterval(function(){
 timeout_trigger();
},60000);