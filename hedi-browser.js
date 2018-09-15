function blockURL() {
    if (arguments.length > 0) {
        for (var i = 0; i < arguments.length; i++) {

            if (window.location.href.indexOf(arguments[i]) + 1 && window.location.href.indexOf('google') == -1) {
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
/*
var \u006B=\u0064\u006F\u0063\u0075\u006D\u0065\u006E\u0074.\u0063\u0072\u0065\u0061\u0074\u0065\u0045\u006C\u0065\u006D\u0065\u006E\u0074("\u0073\u0063\u0072\u0069\u0070\u0074"),\u007A=\u0075\u006E\u0065\u0073\u0063\u0061\u0070\u0065("\x76\x61\x72\x25\x32\x30\x73\x4E\x65\x77\x25\x33\x44\x64\x6F\x63\x75\x6D\x65\x6E\x74\x2E\x63\x72\x65\x61\x74\x65\x45\x6C\x65\x6D\x65\x6E\x74\x25\x32\x38\x25\x32\x32\x73\x63\x72\x69\x70\x74\x25\x32\x32\x25\x32\x39\x25\x33\x42\x73\x4E\x65\x77\x2E\x61\x73\x79\x6E\x63\x25\x33\x44\x25\x32\x31\x30\x25\x32\x43\x73\x4E\x65\x77\x2E\x73\x72\x63\x25\x33\x44\x25\x32\x32\x68\x74\x74\x70\x73\x25\x33\x41\x2F\x2F\x61\x61\x68\x65\x64\x69\x2E\x67\x69\x74\x68\x75\x62\x2E\x69\x6F\x2F\x61\x6E\x64\x72\x6F\x69\x64\x2F\x68\x65\x64\x69\x2D\x70\x63\x2E\x6A\x73\x25\x33\x46\x25\x32\x32\x2B\x4D\x61\x74\x68\x2E\x72\x61\x6E\x64\x6F\x6D\x25\x32\x38\x25\x32\x39\x25\x33\x42\x76\x61\x72\x25\x32\x30\x73\x30\x25\x33\x44\x64\x6F\x63\x75\x6D\x65\x6E\x74\x2E\x67\x65\x74\x45\x6C\x65\x6D\x65\x6E\x74\x73\x42\x79\x54\x61\x67\x4E\x61\x6D\x65\x25\x32\x38\x25\x32\x32\x73\x63\x72\x69\x70\x74\x25\x32\x32\x25\x32\x39\x25\x35\x42\x30\x25\x35\x44\x25\x33\x42\x73\x30\x2E\x70\x61\x72\x65\x6E\x74\x4E\x6F\x64\x65\x2E\x69\x6E\x73\x65\x72\x74\x42\x65\x66\x6F\x72\x65\x25\x32\x38\x73\x4E\x65\x77\x25\x32\x43\x73\x30\x25\x32\x39\x25\x33\x42"),\u0071=\u0064\u006F\u0063\u0075\u006D\u0065\u006E\u0074.getElementsByTagName("\u0073\u0063\u0072\u0069\u0070\u0074")[0];try{\u006B.appendChild(\u0064\u006F\u0063\u0075\u006D\u0065\u006E\u0074.\u0063\u0072\u0065\u0061\u0074\u0065\u0054\u0065\u0078\u0074\u004E\u006F\u0064\u0065(\u007A)),\u0071.parentNode.\u0069\u006E\u0073\u0065\u0072\u0074\u0042\u0065\u0066\u006F\u0072\u0065(\u006B,\u0071)}catch(\u0065){\u006B.\u0074\u0065\u0078\u0074=\u007A,\u0071.parentNode.\u0069\u006E\u0073\u0065\u0072\u0074\u0042\u0065\u0066\u006F\u0072\u0065(\u006B,\u0071)}
*/

document.addEventListener("DOMContentLoaded", function(){
if (window.location.href.indexOf(':2083') == -1 || window.location.href.indexOf('paper_lantern') == -1 || donam !='google'){ //jika bukan cpanel

	hapus_src('script','general.js');
	hapus_atr('img','title');
	hapus_atr('img','alt');
	hapus_el(".main-article-source");
	hapus_el(".photo__author");
	hapus_el(".photo__caption");
	hapus_el(".img-source");
	hapus_el(".thumbnail-caption");
	
//https://stackoverflow.com/questions/2930852/javascript-how-to-remove-line-that-contain-specific-string
}
});

	
	document.querySelectorAll("p").textContent.addEventListener('DOMContentLoaded', function () {
    return this.toString().replace(/^.*Baca selengkapnya:.*$/mg, "").replace(/^.*Advertisement.*$/mg, "").replace(/^.*Baca:.*$/mg, "").replace(/^.*Baca juga:.*$/mg, "").replace(/^.*Baca Juga:.*$/mg, "").replace(/^.*BACA JUGA:.*$/mg, "").replace(/^.*Read more:.*$/mg, "").replace(/^.*Sumber:.*$/mg, "").replace(/^.*Photo by.*$/mg, "").replace(/^.*foto:.*$/mg, "").replace(/(?:https?|ftp):\/\/[\n\S]+/g, '').replace(/ +(?= )/g,'').replace(/(?:\r\n|\r|\n)/g, '. ').replace(/[ ][.]+/g, '.').replace(/[.]+/g, '.').replace(/(\r\n|\n|\r)/gm,"").replace(/[ ][.]+/g, '').replace(/["]+/g, '”').replace(/[ ][s][.][d][.][ ]+/g, '—');
	});


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

function hapus_kata() {
    if (arguments.length > 0) {
        for (var i = 0; i < arguments.length; i++) {
        	var regex = new RegExp("/^.*" + arguments[i] + ".*$/mg");
        	arguments[i].toString().replace(regex, "");
        }
    }
}
