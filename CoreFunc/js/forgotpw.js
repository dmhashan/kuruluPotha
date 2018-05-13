var wrongunemail = document.getElementById("userdetails").innerHTML;
function checkunemail() {
    var unoremail = document.getElementById('unoremail').value;
    if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else {
        // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function () {
        document.getElementById("userdetails").innerHTML = this.responseText;
    };
    xmlhttp.open("GET", "php/unemailload.php?unoremail=" + unoremail, true);
    xmlhttp.send();
}

function subform() {
    var pw1 = document.getElementById('pw1').value;
    var pw2 = document.getElementById('pw2').value;
    if (pw1 !== "" && pw2 !== "" && pw1 === pw2) {
        document.getElementById('submitbttn').click();
    } else {
        document.getElementById('pw1').style.border = '1px solid red';
        document.getElementById('pw2').style.border = '1px solid red';
        document.getElementById('finalerror').style.color = 'red';
        document.getElementById('finalerror').innerHTML = "Configuration passwords are not match!"
    }

}