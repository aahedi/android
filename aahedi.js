$(document).ready(function() {
document.addEventListener('deviceready', buka, false);
var elem = document.createElement('div');
elem.innerHTML='<button onclick="buka()">Open</button>';
elem.style.cssText = 'text-align:center;position:absolute;top:50%;left:50%;margin-right:-50%;transform:translate(-50%,-50%);background-color:rgba(0,0,0,0.3);';
document.body.appendChild(elem);
});

function buka(){
var url = "http://192.168.100.3/auto/?u=";
var link = prompt("Alamat web:", "");
if (link != null) {
window.open(url+link,"_blank","location=no")}
}
