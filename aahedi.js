$(document).ready(function() {
document.addEventListener('deviceready', siap, false);
var elem = document.createElement('div');
elem.innerHTML='<input type="url" placeholder="url" id="url"/><br><input type="text" placeholder="image keyword" id="keyword"/><br><button onclick="buka()" style="height:25px;">Open</button>';
elem.style.cssText = 'text-align:center;position:absolute;top:50%;left:50%;margin-right:-50%;transform:translate(-50%,-50%);background-color:rgba(0,0,0,0.3);';
document.body.appendChild(elem);
});

function buka(){
var base_url = "http://192.168.100.3/auto/?u=";
var url = document.getElementById('url');
var keyword = document.getElementById('keyword');

window.open(base_url+url.value+"?&s="+keyword.value,"_blank","location=no")}
/*
var link = prompt("Alamat web:", "");
if (link != null) {
window.open(url+link,"_blank","location=no")}
}
*/
function siap(){
}
