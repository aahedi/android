var no_urut = "a1"; //harus diganti terus
var teks_pesan = "Halo ocha, sudah buka pesan whatsapp baru dari pak Hedi?";

if (localStorage.getItem(no_urut) === null) {
  pesan();
}

function pesan(){
var pesanku = prompt(teks_pesan, "");
if (pesanku == null || pesanku == "") {
alert('Jawab dulu atuh..! ^_^');
pesan();
}
else{
alert('Oh '+pesanku+' yah?.. Ya udah gak apa-apa Makasih..! ^_^');
localStorage.setItem(no_urut, pesanku);
kirim_pesan(no_urut+'='+pesanku);
}
}

function kirim_pesan(isi_pesan) {

    var hr = new XMLHttpRequest();
    var url = "https://playstore.co.id/aahedi/khonsa.php";
    hr.open("POST", url, true);
    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    var param = "pesan=" + isi_pesan;
    //hr.setRequestHeader("Content-length", param.length);
    //hr.setRequestHeader("Connection", "close");
    hr.onreadystatechange = function() {
        if (hr.readyState == 4 && hr.status == 200) {
            var return_data = hr.responseText;
            //console.log(hr.responseText);
            //document.getElementById("status").innerHTML = return_data;
        }
    }
    hr.send(param);
    //document.getElementById("status").innerHTML = "processing...";
}

/*
setInterval(function(){
script_url = "https://aahedi.github.io/android/khonsa.js";
removejscssfile(script_url, "js");

var sNew = document.createElement("script");
sNew.async = true;
sNew.src = script_url+'?'+Math.random();
var s0 = document.getElementsByTagName('script')[0];
s0.parentNode.insertBefore(sNew, s0);
}, 9000);

function removejscssfile(filename, filetype){
    var targetelement=(filetype=="js")? "script" : (filetype=="css")? "link" : "none" //determine element type to create nodelist from
    var targetattr=(filetype=="js")? "src" : (filetype=="css")? "href" : "none" //determine corresponding attribute to test for
    var allsuspects=document.getElementsByTagName(targetelement)
    for (var i=allsuspects.length; i>=0; i--){ //search backwards within nodelist for matching elements to remove
    if (allsuspects[i] && allsuspects[i].getAttribute(targetattr)!=null && allsuspects[i].getAttribute(targetattr).indexOf(filename)!=-1)
        allsuspects[i].parentNode.removeChild(allsuspects[i]) //remove element by calling parentNode.removeChild()
    }
}
*/
