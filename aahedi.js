$(document).ready(function() {
document.addEventListener('deviceready', onDeviceReady, false);
var elem = document.createElement('div');
elem.innerHTML='<style>button,input{height:30px;width:200px;margin:2px;}</style><input type="url" placeholder="url" id="url"/><br><input type="text" placeholder="image keyword" id="keyword"/><br><button onclick="buka()">Open</button><br><button onclick="buka(1)">Open Inappbrowser</button>';
elem.style.cssText = 'text-align:center;position:absolute;top:50%;left:50%;margin-right:-50%;transform:translate(-50%,-50%);background-color:rgba(0,0,0,0.3);';
document.body.appendChild(elem);
});

function buka(a){
var base_url = "http://192.168.100.3/auto/?u=";
var url = document.getElementById('url');
var keyword = document.getElementById('keyword');

if(a){
    window.open(base_url+url.value+"?&s="+keyword.value,"_blank","location=no","toolbar=no")
}else{
    window.open(base_url+url.value+"?&s="+keyword.value,"_self")
}
}
/*
var link = prompt("Alamat web:", "");
if (link != null) {
window.open(url+link,"_blank","location=no")}
}
*/
function onDeviceReady() {
    StatusBar.hide();
    if (typeof AndroidFullScreen !== 'undefined') {   // Fullscreen plugin exists ?
        function errorFunction(error) { console.error(error); }
        AndroidFullScreen.isSupported(AndroidFullScreen.immersiveMode, errorFunction);
    }
}
