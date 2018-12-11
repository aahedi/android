function blockURL() {
    if (arguments.length > 0) {
        for (var i = 0; i < arguments.length; i++) {
        	var url = window.location.href;
            if (url.indexOf(arguments[i]) + 1 && url.indexOf('google') == -1) {
                location.replace('https://www.w3schools.com');
                return false;
            }
        }
    }
}
    blockURL('tv','live','streaming','game');

//menonaktifkan semua proteksi seperti disable klik kanan dll.
document.oncontextmenu = function(){}
document.ondragstart = function(){}
document.onselectstart = function(){}
document.onmousedown = function(){}
document.onmouseup = function(){}

function disableSelection(target){
if (typeof target.onselectstart!="undefined") //IE route
	target.onselectstart=function(){}
else if (typeof target.style.MozUserSelect!="undefined") //Firefox route
	target.style.MozUserSelect="auto"
else //All other route (ie: Opera)
	target.onmousedown=function(){}
target.style.cursor = "default"
}
disableSelection(document.body)

//membuat semua link buka di tab baru
var donam = window.location.hostname.split('.')[1];

var links = document.getElementsByTagName("a"); 

for (var i = 0; i < links.length; i++) {
	
     if(donam =='github'){
     links[i].target = "_blank";
     }
     
     if(donam =='tribunnews' || donam =='grid' || donam =='bolasport' || donam =='indosport'){
     links[i].target = "_blank";
     links[i].href = links[i].href.split('?')[0];
     links[i].href = links[i].href+"?page=all";
     hapus_el('.twitter-tweet');
     hapus_el('.instagram-media');
     hapus_el('.baca-juga');
     hapus_el("span");
     }
     if(donam =='rmol'){
     document.getElementsByClassName('newsAds')[0].innerHTML='';
     }
     if(donam =='tribunislam'){
     document.getElementById('adsense-content').innerHTML='';
     }
     if(donam =='idntimes'){
     document.getElementsByClassName('editors-pick')[0].innerHTML='';
     }
     if(donam =='cosmopolitan'){
     document.getElementsByClassName('dable_placeholder')[0].innerHTML='';
     document.getElementById('dablewidget_goPBWelQ').innerHTML='';
     
     (function(d,a,b,l,e,_) {})

     }
}

//supaya WHM button buka di Tab baru
function clickableSafeRedirect(clickEvent, target, newWindow) {
    var eventSource = clickEvent.target.tagName.toLowerCase();
    var eventParent = clickEvent.target.parentNode.tagName.toLowerCase();
    var eventTable = clickEvent.target.parentNode.parentNode.parentNode;
    if (jQuery(eventTable).hasClass('collapsed')) {
        // This is a mobile device sized display, and datatables has triggered folding
        return false;
    }
    if(eventSource != 'button' && eventSource != 'a') {
        if(eventParent != 'button' && eventParent != 'a') {
            if (newWindow) {
                window.open(target,'_blank');
            } else {
                window.open(target,'_blank');
            }
        }
    }
}

//menonaktifkan inject telkom
if (self==top) {
function netbro_cache_analytics(fn, callback) {}
function sync(fn) {}
function requestCfs(){}
}

document.addEventListener("DOMContentLoaded", function(){
var cpanel = window.location.href.indexOf(':2083') > -1 || window.location.href.indexOf('paper_lantern') > -1 || donam =='google';
if (!cpanel){ //jika bukan cpanel

	hapus_src('script','general.js');
	hapus_src('iframe','www.youtube.com/embed');
	hapus_atr('img','title');
	hapus_atr('img','alt');
	hapus_el(".main-article-source");
	hapus_el(".photo__author");
	hapus_el(".photo__caption");
	hapus_el(".img-source");
	hapus_el(".thumbnail-caption");
	hapus_el('.baca-juga');
	hapus_el('.new_bacajuga');
	hapus_el('.lihat-juga');
	hapus_el('figcaption');
	
//https://stackoverflow.com/questions/2930852/javascript-how-to-remove-line-that-contain-specific-string

hapus_kata('p','Baca selengkapnya:','Advertisement','Baca:','Baca juga:','Baca Juga:','BACA JUGA:','Baca Juga :','Read more:','Sumber:','Photo by','foto:','via twitter.com');
hapus_kata('strong','INDOSPORT')

document.addEventListener('copy', function(e) {
    e.preventDefault();
    var oldText = window.getSelection();
    if (e.clipboardData) {
        e.clipboardData.setData('text/plain', oldText);
        e.clipboardData.setData('text/html', oldText);
    } else if (window.clipboardData) {
        window.clipboardData.setData('Text', oldText);
    } else {
        console.log("Don't work");
    }
})
}
});

	/*
	document.querySelectorAll("p").textContent.addEventListener('DOMContentLoaded', function () {
    return this.toString().replace(/^.*Baca selengkapnya:.*$/mg, "").replace(/^.*Advertisement.*$/mg, "").replace(/^.*Baca:.*$/mg, "").replace(/^.*Baca juga:.*$/mg, "").replace(/^.*Baca Juga:.*$/mg, "").replace(/^.*BACA JUGA:.*$/mg, "").replace(/^.*Read more:.*$/mg, "").replace(/^.*Sumber:.*$/mg, "").replace(/^.*Photo by.*$/mg, "").replace(/^.*foto:.*$/mg, "").replace(/(?:https?|ftp):\/\/[\n\S]+/g, '').replace(/ +(?= )/g,'').replace(/(?:\r\n|\r|\n)/g, '. ').replace(/[ ][.]+/g, '.').replace(/[.]+/g, '.').replace(/(\r\n|\n|\r)/gm,"").replace(/[ ][.]+/g, '').replace(/["]+/g, '”').replace(/[ ][s][.][d][.][ ]+/g, '—');
	});
*/

function hapus_el(elem) {
	var els = document.querySelectorAll(elem);
  for (var i = 0; i < els.length; i++) {
    els[i].remove()
  }
}
function hapus_atr(elem,att) {
	var els = document.querySelectorAll(elem);
  for (var i = 0; i < els.length; i++) {
    els[i].removeAttribute(att);
  }
}

function hapus_src(elem,str) {
	var els = document.querySelectorAll(elem);
  for (var i = 0; i < els.length; i++) {
  	if (els[i].src.indexOf(str) + 1 ){
    els[i].remove()
  	}
  }
}

function hapus_kate() {
    if (arguments.length > 0) {
        for (var i = 0; i < arguments.length; i++) {
        	var regex = new RegExp("/^.*" + arguments[i] + ".*$/mg");
        	arguments[i].toString().replace(regex, "");
        }
    }
}

function hapus_tag(elem,str) {
	var els = document.querySelectorAll(elem);
  for (var i = 0; i < els.length; i++) {
  	if (els[i].textContent.indexOf(str) + 1 ){
    els[i].remove()
  	}
  }
}

function hapus_kata(tag) {
    if (arguments.length > 0) {
        for (var i = 1; i < arguments.length; i++) {

hapus_tag(tag,arguments[i]);

        }
    }
}

$("input").on('keyup', function(e) {
  var arr = $(this).val().split(' ');
  var result = '';
  for (var x = 0; x < arr.length; x++)
    result += arr[x].substring(0, 1).toUpperCase() + arr[x].substring(1) + ' ';
  $(this).val(result.substring(0, result.length - 1));
});
