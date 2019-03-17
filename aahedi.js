$(document).ready(function() {
var url = "http://192.168.8.102/auto/?u=";
document.addEventListener('deviceready', masuk, false);
function masuk(){
   buka();
}
function buka(){
var link = prompt("Alamat web:", "");
if (link != null) {
window.open(url+link,"_blank","location=no")
}
}
var elem = document.createElement('div');
elem.innerHTML='<button onclick="buka()">Open</button>';
elem.style.cssText = 'text-align:center;position:absolute;top:50%;left:50%;margin-right:-50%;transform:translate(-50%,-50%);background-color:rgba(0,0,0,0.3);';
document.body.appendChild(elem);
});
