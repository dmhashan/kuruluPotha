var bird_id;
function birddetailsjs(x, y, z) {
    bird_id = x;
    var aContainer1 = document.createElement('div');
    var aContainer2 = document.createElement('div');
    aContainer1.setAttribute('id', 'birddetailsoverlay');
    aContainer1.setAttribute('class', 'birddetailsoverlay');
    aContainer1.setAttribute('onclick', 'birddetailsclose()');
    aContainer2.setAttribute('id', 'birdDetailscontainer');
    aContainer2.setAttribute('class', 'birdDetailscontainer');
    aContainer2.innerHTML = '<center><div class="bdheader"><span class="bdclose" onclick="birddetailsclose()">&times;</span><h2 id="bdheader">Unknown Error</h2></div><div class="modal-body" id="modal-body"><img src="../img/index/error.png"></div><div class="bdfooter" id="bdfooter">Copyright © 2017 KuruluPotha, Sri Lanka. All rights reserved.</div></center>';
    document.body.appendChild(aContainer1);
    document.body.appendChild(aContainer2);

    document.getElementById('birddetailsoverlay').style.display = "block";
    document.getElementById('birdDetailscontainer').style.display = "block";
    document.getElementById('bdheader').innerHTML = y + ' ( ' + z + ' )';
    document.getElementById('modal-body').innerHTML = '<img src="../img/index/loading.gif" style="padding: 20px; height: auto; width:15% ;">';
//ajax
    ajaxBirdDetails();
}

function ajaxBirdDetails() {
    if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else {
        // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById('modal-body').innerHTML = this.responseText;
            mapLoader();
        }
    };
    xmlhttp.open("GET", "php/birddetails_load.php?birdid=" + bird_id, true);
    xmlhttp.send();
}

function addCheckList(userid, birdid) {
    document.getElementById('checkButton').disabled = true;
    if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else {
        // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            //alert(this.responseText);
            ajaxBirdDetails();
        }
    };
    xmlhttp.open("GET", "php/checkListAddRemove.php?checkType=add&userid=" + userid + "&birdid=" + birdid, true);
    xmlhttp.send();
}

function removeCheckList(userid, birdid) {
    document.getElementById('checkButton').disabled = true;
    if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else {
        // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            //alert(this.responseText);
            ajaxBirdDetails();
        }
    };
    xmlhttp.open("GET", "php/checkListAddRemove.php?checkType=remove&userid=" + userid + "&birdid=" + birdid, true);
    xmlhttp.send();
}

/*
 $(function () {// document.ready shorthand
 $('#bdclose,#birddetailsoverlay').click(function () {
 $('#birddetailsoverlay, #birdDetailscontainer').fadeOut('1000', function () {//use 3000 in place of 300m
 var child1 = $('birddetailsoverlay');
 var child2 = $('birdDetailscontainer');
 child1.remove();
 child2.remove();
 });
 return false;
 });
 });
 */


function birddetailsclose() {
    $('#birddetailsoverlay, #birdDetailscontainer').fadeOut('3000', function () {//use 3000 in place of 300m
        var child1 = $('#birddetailsoverlay');
        var child2 = $('#birdDetailscontainer');
        child1.remove();
        child2.remove();
    });
}

function mapLoader() {
    var st1 = document.getElementById('st1').value;
    var st2 = document.getElementById('st2').value;
    var st3 = document.getElementById('st3').value;

    if (st1 !== '0') {
        st1array = st1.split(",");
        for (i = 0; i < st1array.length; i++) {
            var local_reg = document.getElementById('dis-' + st1array[i]);
            local_reg.style.fill = "red";
        }
    }

    if (st2 !== '0') {
        st2array = st2.split(",");
        for (i = 0; i < st2array.length; i++) {
            var local_reg = document.getElementById('dis-' + st2array[i]);
            local_reg.style.fill = "blue";
        }
    }

    if (st3 !== '0') {
        st3array = st3.split(",");
        for (i = 0; i < st3array.length; i++) {
            var local_reg = document.getElementById('dis-' + st3array[i]);
            local_reg.style.fill = "green";
        }
    }
}