$(document).ready(function() {
document.addEventListener('deviceready', onDeviceReady, false);
var elem = document.createElement('div');
elem.innerHTML='<style>button,input{height:30px;width:200px;margin:2px;}</style><input type="url" placeholder="url" id="url"/><br><input type="text" placeholder="image keyword" id="keyword"/><br><button onclick="buka()">Open</button><br><button onclick="buka(1)">Open Inappbrowser</button>';
elem.style.cssText = 'text-align:center;position:absolute;top:50%;left:50%;margin-right:-50%;transform:translate(-50%,-50%);background-color:rgba(0,0,0,0.3);';
document.body.appendChild(elem);
});

var base_host = "http://192.168.8.102/";
var base_url = base_host+"auto/?u=";

function buka(a){
    if(cek_koneksi(base_host)=="yes"){
var url = document.getElementById('url');
var keyword = document.getElementById('keyword');

if(a){
    window.open(base_url+url.value+"?&s="+keyword.value,"_blank","location=no","toolbar=no")
}else{
    window.open(base_url+url.value+"?&s="+keyword.value,"_self")
}
    }
    else{alert('Server tidak ditemukan')}
}
function onDeviceReady() {
    StatusBar.hide();
    if (typeof AndroidFullScreen !== 'undefined') {   // Fullscreen plugin exists ?
        function errorFunction(error) { console.error(error); }
        AndroidFullScreen.isSupported(AndroidFullScreen.immersiveMode, errorFunction);
    }
}
function cek_koneksi(id){
var request = new XMLHttpRequest();  
request.open('GET', id, true);
request.onreadystatechange = function(){
    if (request.readyState === 4){
        if (request.status === 404) {  
            //alert("Oh no, it does not exist!");
            return 'no';
        }else{
            //alert("connection OK!");
            return 'yes';
        }
    }
};
request.send();
}
