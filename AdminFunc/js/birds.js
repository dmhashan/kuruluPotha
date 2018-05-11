function firstLoad() {
    if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else {
        // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById('birdNames').innerHTML = this.responseText;
        }
    };
    xmlhttp.open("GET", "php/birdSearch.php?searchkey= ", true);
    xmlhttp.send();
}

function birdSearch() {
    var searchkey = document.getElementById('bird_search_key').value;
    if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else {
        // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById('birdNames').innerHTML = this.responseText;
        }
    };
    xmlhttp.open("GET", "php/birdSearch.php?searchkey=" + searchkey, true);
    xmlhttp.send();
}

function showbird(x){
    if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else {
        // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById('birdNames').innerHTML = this.responseText;
        }
    };
    xmlhttp.open("GET", "php/showBird.php?birdid=" + x, true);
    xmlhttp.send();
}

function editbird(x){
    if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else {
        // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById('birdNames').innerHTML = this.responseText;
        }
    };
    xmlhttp.open("GET", "php/editBird.php?birdid=" + x, true);
    xmlhttp.send();
}

function deletebird(x){
    if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else {
        // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById('birdNames').innerHTML = this.responseText;
        }
    };
    xmlhttp.open("GET", "php/deleteBird.php?birdid=" + x, true);
    xmlhttp.send();
}

function addBird(){
    if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else {
        // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById('birdNames').innerHTML = this.responseText;
        }
    };
    xmlhttp.open("GET", "php/addBird.php", true);
    xmlhttp.send();
}