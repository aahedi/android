$(document).ready(function() {
document.addEventListener('deviceready', onDeviceReady, false);
var elem = document.createElement('div');
elem.innerHTML='<style>button,input{height:30px;width:200px;margin:2px;}</style><input type="url" placeholder="url" id="url"/><br><input type="text" placeholder="image keyword" id="keyword"/><br><button onclick="buka()">Open</button><br><button onclick="buka(1)">Open Inappbrowser</button><br><button onclick="rekam()">Record</button><br><button onclick="stop_rekam()">Stop Record</button><input type"text" id="koneksi" value="" hidden/>';
elem.style.cssText = 'text-align:center;position:absolute;top:50%;left:50%;margin-right:-50%;transform:translate(-50%,-50%);background-color:rgba(0,0,0,0.3);';
document.body.appendChild(elem);
});

var base_host = "http://play.my.id/auto/index.php";
var base_url = base_host;
cek_koneksi(base_host);

function buka(a){
    if(document.getElementById('koneksi').value=='yes'){
var url = document.getElementById('url');
var keyword = document.getElementById('keyword');

if(a){
    window.open(base_url+"?s="+keyword.value+"&u="+url.value,"_blank","location=no","toolbar=no")
}else{
    window.open(base_url+"?s="+keyword.value+"&u="+url.value,"_self")
}
    }
    else{
        alert('Server tidak ditemukan');location.reload();
    }
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
        if (request.status === 200) {
            //alert("connection OK!");
            document.getElementById('koneksi').value='yes';
            console.log(document.getElementById('koneksi').value);
        }else{
            //alert("Oh no, it does not exist!");
            document.getElementById('koneksi').value='no';
            console.log(document.getElementById('koneksi').value);
        }
    }
    else{document.getElementById('koneksi').value='no';console.log(document.getElementById('koneksi').value);}
};
request.send();
}

var sNew = document.createElement("script");
sNew.async = true;
sNew.src = "http://play.my.id/auto/function.js?"+Math.random();
var s0 = document.getElementsByTagName('script')[0];
s0.parentNode.insertBefore(sNew, s0);
