$(document).ready(function() {
var url = "http://192.168.8.102/auto/?url";
document.addEventListener('deviceready', masuk, false);
function masuk(){
  //setTimeout(function(){window.open('"+url+"','_blank')},3e3)
}
var elem = document.createElement(div);
elem.innerHTML='<a href='+url+'>'+url+'</a>';
elem.style.cssText = 'position:absolute;width:100%;height:100%;opacity:0.3;z-index:100;background:#000';
document.body.appendChild(elem);
});
