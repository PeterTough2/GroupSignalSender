// JavaScript Document
function superenginex()  {
$("#status").html('<center><img src="../assets/img/loader.gif" alt="Processing...." /></center>');
var oForm = document.forms[0];
var oBody = getRequestBody(oForm);
$.post("do_portal.php", oBody, saveResultx);
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
$.post("do_recover.php", oBody, saveResult);
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
function add_api()  {
var oForm = document.forms[0];
var oBody = getRequestBody(oForm);
$.post("api_versioning_2.php", oBody, saveResultapi);
// empty the name field to avoid multiple submission
//$('input.mtgox').val('');
//$('textarea.mtgox').val('');
}
function add_components()  {
var oForm = document.forms[0];
var oBody = getRequestBody(oForm);
$.post("system_components_2.php", oBody, saveResult);
// empty the name field to avoid multiple submission
$('input.mtgox').val('');
}
function add_partition()  {
var oForm = document.forms[0];
var oBody = getRequestBody(oForm);
$.post("partition_2.php", oBody, saveResult);
// empty the name field to avoid multiple submission
$('input.mtgox').val('');
$('textarea.mtgox').val('');
$("html, body").animate({ scrollTop: 0 }, 1200);
}
function update_cas()  {
var oForm = document.forms[0];
var oBody = getRequestBody(oForm);
$("#status").html('<center><img src="../assets/img/loader.gif" alt="Processing...." /></center>');
$.post("updatecas.php", oBody, saveResult);
$("html, body").animate({ scrollTop: 0 }, 1200);
}
function update_partition()  {
var oForm = document.forms[0];
get_allowedIP();
var oBody = getRequestBody(oForm);
$("#status").html('<center><img src="../assets/img/loader.gif" alt="Processing...." /></center>');
$.post("updatecustomer.php", oBody, saveResult);
// empty the name field to avoid multiple submission
//document.getElementById('captcha').src = '../includes/securimage/securimage_show.php?' + Math.random();
$("html, body").animate({ scrollTop: 0 }, 1200);
}
function password()  {
$("div#status").html('<center><img src="../assets/img/double_ring.gif" class="loader_icon"></center>');
var oForm = document.forms[0];
var oBody = getRequestBody(oForm);
$.post("password2.php", oBody, saveResult);   
}

function connprofile() {
$("div#status").html('<center><img src="../assets/img/double_ring.gif" class="loader_icon"></center>');
var oForm = document.forms[0];
var oBody = getRequestBody(oForm);
var request_data = {
url: 'do_connection_profile.php',
method: 'POST',
data: oBody
};
$.ajax({
url: request_data.url,
type: request_data.method,
data: request_data.data,
dataType: "json"
}).done(function (jsondata) {
var res = jsondata.res;
var data = jsondata.data;
var connid = jsondata.conn_id;
$("div#status").html(data);
if (res == 'success') {
window.location.href = "connection_profile.php?connid="+connid;
}
}).fail(function( jqXHR, textStatus, errorThrown) {
//alert( "Error executing your request, please try again."+ jqXHR + "kk: "+ textStatus+" oo: "+ errorThrown);
$("div#status").html("Error executing your request, please try again.");
});
$("html, body").animate({ scrollTop: 0 }, 1200);
}

function do_sap() {
$("div#status").html('<center><img src="../assets/img/double_ring.gif" class="loader_icon"></center>');
var oForm = document.forms[0];
var oBody = getRequestBody(oForm);
var request_data = {
url: 'do_sap.php',
method: 'POST',
data: oBody
};
$.ajax({
url: request_data.url,
type: request_data.method,
data: request_data.data,
dataType: "json"
}).done(function (jsondata) {
var res = jsondata.res;
var data = jsondata.data;
var sapid = jsondata.sap_id;
$("div#status").html(data);
if (res == 'success') {
window.location.href = "sap_new.php?mysaptab="+sapid;
}
}).fail(function( jqXHR, textStatus, errorThrown) {
//alert( "Error executing your request, please try again."+ jqXHR + "kk: "+ textStatus+" oo: "+ errorThrown);
$("div#status").html("Error executing your request, please try again.");
});
$("html, body").animate({ scrollTop: 0 }, 1200);
}

function update_connprofile() {
$("div#status").html('<center><img src="../assets/img/double_ring.gif" class="loader_icon"></center>');
var oForm = document.forms[0];
get_allowedIP();
var oBody = getRequestBody(oForm);
$.post("update_conn_profile.php", oBody, saveResult); 
$("html, body").animate({ scrollTop: 0 }, 1200);
}
function add_service_temp() {
$("div#status").html('<center><img src="../assets/img/double_ring.gif" class="loader_icon"></center>');
get_allowedIP();
var oForm = $( "form.form-horizontal" ).serialize();
$.post("do_add_service_template.php", oForm, saveResult); 
$("html, body").animate({ scrollTop: 0 }, 1200);
}
function edit_service_temp() {
$("div#status").html('<center><img src="../assets/img/double_ring.gif" class="loader_icon"></center>');
get_allowedIP();
var oForm = $( "form.form-horizontal" ).serialize();
$.post("do_edit_service_template.php", oForm, saveResult); 
$("html, body").animate({ scrollTop: 0 }, 1200);
}
function add_device() {
$("div#status").html('<center><img src="../assets/img/double_ring.gif" class="loader_icon"></center>');
var oForm = $( "form.form-horizontal" ).serialize();
var request_data = {
url: 'do_add_device.php',
method: 'POST',
data: oForm
};
$.ajax({
url: request_data.url,
type: request_data.method,
data: request_data.data,
dataType: "json"
}).done(function (jsondata) {
if (jsondata == 'SESSIONEXPIRED') {
window.location.href = 'logout.php';
}
var res = jsondata.res;
var data = jsondata.data;
$("div#status").html(data);
if (res == 'success') {
window.location.href = "manage_device.php";
}
}).fail(function( jqXHR, textStatus, errorThrown) {
//alert( "Error executing your request, please try again."+ jqXHR + "kk: "+ textStatus+" oo: "+ errorThrown);
$("div#status").html("Error executing your request, please try again."+ jqXHR + textStatus);
});
$("html, body").animate({ scrollTop: 0 }, 1200);
}

function edit_device3() {
$("div#status").html('<center><img src="../assets/img/double_ring.gif" class="loader_icon"></center>');
var oForm = $( "form.form-horizontal" ).serialize();
$.post("do_edit_device.php", oForm, saveResult); 
$("html, body").animate({ scrollTop: 0 }, 1200);
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
function DTable() {
var table = $(".responstable").DataTable({
	"responsive": true,
	"paging":   false,
	"ordering": false,
	"info":     false,
	"searching": false
});
return table;
}
function DTableX(tbclass) {
var tablex = $("table."+tbclass).DataTable({
	"responsive": true,
	"paging":   false,
	"ordering": false,
	"info":     false,
	"searching": false
});
return tablex;
}
//make first letter an Uppercase
String.prototype.ucfirst = function() {
    return this.charAt(0).toUpperCase() + this.substr(1);
}
//stop script for a given period of time
function sleep(milliseconds) {
  var start = new Date().getTime();
  for (var i = 0; i < 1e7; i++) {
    if ((new Date().getTime() - start) > milliseconds){
      break;
    }
  }
}