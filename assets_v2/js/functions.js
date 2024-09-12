// JavaScript Document
function superenginex()  {
$("#status").html('<center><img src="../assets/img/loader.gif" alt="Processing...." /></center>');
var oForm = document.forms[0];
var oBody = getRequestBody(oForm);
$.post("login_superuser.php", oBody, saveResultx);
//document.getElementById('captcha').src = '../includes/securimage/securimage_show.php?' + Math.random();
}
function superuser()  {
var oForm = document.forms[0];
var oBody = getRequestBody(oForm);
$.post("login_superuser.php", oBody, saveResultx);
}
function dojoin()  {
$("#status").html('<center><img src="../assets/img/loader.gif" alt="Processing...." /></center>');
var oForm = document.forms[0];
var oBody = getRequestBody(oForm);
$.post("create_customer.php", oBody, saveResulty);
$("html, body").animate({ scrollTop: 0 }, 1200);
//document.getElementById('captcha').src = '../includes/securimage/securimage_show.php?' + Math.random();
}
function do_create_account(){
$('button.create_account').fadeOut(2000);
}
function superenginex2()  {
$("div#status").html('<center><img src="../assets/img/double_ring.gif" class="loader_icon"></center>');
var oForm = document.forms[0];
var oBody = getRequestBody(oForm);
$.post("pname2.php", oBody, saveResult);   
}
function superenginex234()  {
$("div#status").html('<center><img src="../assets/img/double_ring.gif" class="loader_icon"></center>');
var oForm = document.forms[0];
var oBody = getRequestBody(oForm);
$.post("pphone2.php", oBody, saveResult);   
}
function superenginex3()  {
$("div#status").html('<center><img src="../assets/img/double_ring.gif" class="loader_icon"></center>');
var oForm = document.forms[0];
var oBody = getRequestBody(oForm);
$.post("ppassword2.php", oBody, saveResult);
$('input#prodname').val('');  
}
function superenginex4()  {
$("div#status").html('<center><img src="../assets/img/double_ring.gif" class="loader_icon"></center>');
var oForm = document.forms[0];
var oBody = getRequestBody(oForm);
$.post("pemail2.php", oBody, saveResult_x);
$('button.dnt').fadeOut(1000);
}
function superenginex5()  {
$("div#status").html('<center><img src="../assets/img/double_ring.gif" class="loader_icon"></center>');
var oForm = document.forms[0];
var oBody = getRequestBody(oForm);
$.post("add_user2.php", oBody, saveResult);
// empty the name field to avoid multiple submission
$('input.mtgox').val('');
}
function superenginex7()  {
var oForm = document.forms[0];
var oBody = getRequestBody(oForm);
$.post("recover_superuser.php", oBody, saveResult);
//document.getElementById('captcha').src = '../includes/securimage/securimage_show.php?' + Math.random();
}
function super_superenginex7() {
var oForm = document.forms[0];
var oBody = getRequestBody(oForm);
$.post("recover_superuser.php", oBody, saveResult);
}
function superenginex12()  {
var oForm = document.forms[0];
var oBody = getRequestBody(oForm);
$.post("confirm_2fa.php", oBody, saveResultx);
}
function password()  {
$("div#status").html('<center><img src="../assets/img/double_ring.gif" class="loader_icon"></center>');
var oForm = document.forms[0];
var oBody = getRequestBody(oForm);
$.post("password2.php", oBody, saveResult);   
}


function getRequestBody(oForm) {
var oParams = {};

for (var i=0 ; i < oForm.elements.length; i++) {            
var oField = oForm.elements[i];                
switch (oField.type) {

case "button":
case "submit":
case "reset":
break;

case "checkbox":
case "radio": 
if (!oField.checked) {
break;
}

case "text":
case "hidden":
case "password":
oParams[oField.name] = oField.value;
break;

default:

switch(oField.tagName.toLowerCase()) {
case "select":
//oParams[oField.name] = oField.options[oField.selectedIndex].value;
oParams[oField.name] = oField.value;
break;
default:	
oParams[oField.name] = oField.value;
}
}							

}

return oParams;
}

function saveResult(sMessage, sStatus) {
if (sMessage == 'SESSIONEXPIRED') {
window.location.href = 'logout.php';
}
if (sStatus == 414) {
$("div#status").html(sMessage);
}
if (sStatus == "success") {
$("div#status").html(sMessage);
} else {
$("div#status").html("An error occurred.");
}
}

function saveResult_st(sMessage, sStatus) {
if (sMessage == 'SESSIONEXPIRED') {
window.location.href = 'logout.php';
}
if (sStatus == 414) {
$("div#status").html(sMessage);
}
if (sStatus == "success") {
$("div#status").html(sMessage);
window.location.reload(true);//reloads content from server not cache.
} else {
$("div#status").html("An error occurred.");
}
}

function saveResult_x(sMessage, sStatus) {
if (sMessage == 'SESSIONEXPIRED') {
window.location.href = 'logout.php';
}
if (sStatus == 414) {
$("div#status").html(sMessage);
}
if (sStatus == "success") {
$("div#status").html(sMessage);
} else {
$("div#status").html("An error occurred.");
}
window.location.href = window.location.href;
}

function saveResultapi(sMessage, sStatus) {
if (sMessage == 'SESSIONEXPIRED') {
window.location.href = 'logout.php';
}
if (sStatus == 414) {
$("div#status").html(sMessage);
}
if (sStatus == "success") {
$("div#status").html(sMessage);
} else {
$("div#status").html("An error occurred.");
}
$("html, body").animate({ scrollTop: 0 }, 1200);
}
function saveResultx(sMessage, sStatus) {
if (sStatus == "success") {
$("div#status").html(sMessage);
//$("div#status div").delay(2000).fadeOut(1000);
} else {
$("div#status").html("An error occurred.");
//$("div#status div").delay(2000).fadeOut(1000);
}
}

function saveResulty(sMessage, sStatus) {
if (sStatus == "success") {
$("div#status").html(sMessage);
} else {
$("div#status").html("An error occurred.");
$("div#status div").delay(2000).fadeOut(1000);
}
$("html, body").animate({ scrollTop: 0 }, 1200);
}

function saveResultz(sMessage, sStatus) {
if (sStatus == "success") {
$("div#status").html(sMessage);
} else {
$("div#status").html("An error occurred, reload page.");
}
setTimeout(function () {
window.location.href = window.location.href;
}, 1500);
}

$(document).ready(function() {
$('.delbtn').click(function(event) {
event.preventDefault();
if(confirm('Sure you want to delete this?')) {
var linker = $(this).attr('href');
window.location.href = linker;
}
});
});
$(document).on('click', '.pushleft', function(event){
$(this).parent('div').remove();
});
function redirect(loca) {
window.location.href = loca;
}
function resend(){
$.get('resend_code.php',  function(data) {
$("div#status").html(data);
}).fail(function(jqXHR) {
redirect('index.php');
});
}
//make first letter an Uppercase
String.prototype.ucfirst = function() {
    return this.charAt(0).toUpperCase() + this.substr(1);
}
String.prototype.ucwords = function() {
  str = this.toLowerCase();
  return str.replace(/(^([a-zA-Z\p{M}]))|([ -][a-zA-Z\p{M}])/g,
  	function(s){
  	  return s.toUpperCase();
	});
};

/*
//if working with words with accented
var str = "bjôrm пô~р да₧иƒоªич üder12 ñƒque αλφ¢";
str = str.toLowerCase().replace(/^[\u00C0-\u1FFF\u2C00-\uD7FF\w]|\s[\u00C0-\u1FFF\u2C00-\uD7FF\w]/g, function(letter) {
return letter.toUpperCase();
});
*/

//stop script for a given period of time
function sleep(milliseconds) {
  var start = new Date().getTime();
  for (var i = 0; i < 1e7; i++) {
    if ((new Date().getTime() - start) > milliseconds){
      break;
    }
  }
}