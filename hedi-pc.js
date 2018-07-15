var donam = window.location.hostname.split('.')[1];

     //if(donam =='detik'){

var kata = "youtube";
var kata_arr = kata.split(',');
var halaman = document.documentElement.innerText;
var halaman_arr = getWordsByNonWhiteSpace(halaman);
var url_halaman = getWordsByNonWhiteSpace(window.location.href);

function cleanString(str) {
    return decodeURI(str).replace(/[^\w\s]|_/gi, ' ')
        .replace(/\s+/g, ' ')
        .toLowerCase();
}

function extractSubstr(str, regexp) {
    return cleanString(str).match(regexp) || [];
}

function getWordsByNonWhiteSpace(str) {
    return extractSubstr(str, /\S+/g);
}

function getWordsByWordBoundaries(str) {
    return extractSubstr(str, /\b[a-z\d]+\b/g);
}

function cari_kata(str,database){
if (database.some(function(v) { return str.indexOf(v) >= 0; })) {
alert('ada');
}
else{
alert('kosong');
}
}

//cari_kata(halaman_arr,kata_arr);

function containsAny(str, substrings) {
    for (var i = 0; i != substrings.length; i++) {
       var substring = substrings[i];
       if (str.toString().indexOf(substring) != - 1) {
         return substring;
       }
    }
    return null; 
}

var result = containsAny(url_halaman,kata_arr);
if (result !=null){
//alert("Ditemukan: " + result);
     setTimeout("window.close()", 500);
}
else{
     //alert('tidak ditemukan');
}
          
//}
