function hideall() {
    $('.cd-overlay').removeClass('is-visible');//green overlay only
    $('.cd-nav-trigger').removeClass('nav-is-visible');//other mobile components
    $('.cd-main-header').removeClass('nav-is-visible');
    $('.cd-primary-nav').removeClass('nav-is-visible');
    $('.has-children ul').addClass('is-hidden');
    $('.has-children a').removeClass('selected');
    $('.moves-out').removeClass('moves-out');
    $('.cd-main-content').removeClass('nav-is-visible').one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function () {
        $('body').removeClass('overflow-hidden');
    });
}

function validateSearchForm() {
    var checkCheckbox1 = document.getElementById("searchFiltereng").checked;
    var checkCheckbox2 = document.getElementById("searchFiltersci").checked;
    var checkCheckbox3 = document.getElementById("searchFiltersin").checked;
    if (checkCheckbox1 || checkCheckbox2 || checkCheckbox3) {
        //document.getElementById("filterP").style.border = "";
        return true;
    } else {
        /*document.getElementById("filterP").style.border = "2px solid #b20000";
         setTimeout(function () {
         document.getElementById("filterP").style.border = "";
         }, 1000);*/
        return false;
    }
}


function searchName() {
    var searchkey = document.getElementById("searchkey").value;
    if (searchkey !== "" && validateSearchForm()) {
        var checkCheckbox1 = document.getElementById("searchFiltereng").checked;
        var checkCheckbox2 = document.getElementById("searchFiltersci").checked;
        var checkCheckbox3 = document.getElementById("searchFiltersin").checked;
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("birdDispaly").innerHTML = this.responseText;
                //alert(searchkey +" "+ checkCheckbox1 +" "+ checkCheckbox2 +" "+ checkCheckbox3);
            }
        };
        xmlhttp.open("GET", "feature_submit.php?searchKey=" + searchkey + "&engCheck=" + checkCheckbox1 + "&sciCheck=" + checkCheckbox2 + "&sinCheck=" + checkCheckbox3, true);
        xmlhttp.send();
    }

}

function displayBirds() {
    if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else {
        // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("birdDispaly").innerHTML = this.responseText;
            //alert("fds");
        }
    };
    xmlhttp.open("GET", "feature_submit.php?fistLoad=1", true);
    xmlhttp.send();
    birdcolorobj = document.getElementById("colorPickModal").innerHTML;
    var slide = gup('slide');
    if (slide === '1') {
        //alert('nav_search');
        document.getElementById("nav_search").click();
    } else if (slide === '2') {
        //alert('nav_identify');
        document.getElementById("nav_identify").click();
    } else if (slide === '3') {
        //alert('nav_describe');
        document.getElementById("nav_describe").click();
    }
}

//// SELECTOR //////
function openBirdSize() {
    var w = window.innerWidth;
    if (w < 768) {
        var h = "360px";
    } else {
        var h = "450px";
    }
    document.getElementById("birdSize").style.height = h;
}
function openBirdShape() {
    var w = window.innerWidth;
    if (w < 768) {
        var h = "360px";
    } else {
        var h = "450px";
    }
    document.getElementById("birdShape").style.height = h;
}
function openBirdColor() {
    var w = window.innerWidth;
    if (w < 768) {
        var h = "360px";
    } else {
        var h = "450px";
    }
    document.getElementById("birdColor").style.height = h;
}
function openBirdLocation() {
    var w = window.innerWidth;
    if (w < 768) {
        var h = "360px";
    } else {
        var h = "450px";
    }
    document.getElementById("birdLocation").style.height = h;
}
function closeNav() {
    document.getElementById("birdSize").style.height = "0%";
    document.getElementById("birdShape").style.height = "0%";
    document.getElementById("birdColor").style.height = "0%";
    document.getElementById("birdLocation").style.height = "0%";
}

var sizeIndex = 0;
var shapeIndex = 0;
var colorIndex = "";
var locationIndex = 0;

function selectSizeIndex(x) {
    sizeIndex = x;
    if (x === 0) {
        document.getElementById("sizebutton").innerHTML = '<div id="tumbSize" class="tumbSize"></div><div class="dropbtn-cap">Size</div>- None -';
        document.getElementById("sizebutton").style.backgroundColor = "";
        document.getElementById("tumbSize").style.backgroundImage = "url('../img/birds/size/none.png')";
    } else if (x === 1) {
        document.getElementById("sizebutton").innerHTML = '<div id="tumbSize" class="tumbSize"></div><div class="dropbtn-cap">Size</div>Small';
        document.getElementById("sizebutton").style.backgroundColor = "#3e8e41";
        document.getElementById("tumbSize").style.backgroundImage = "none";
        document.getElementById("tumbSize").innerHTML = "S";
        //document.getElementById("tumbSize").style.fontSize = "xx-large";
    } else if (x === 2) {
        document.getElementById("sizebutton").innerHTML = '<div id="tumbSize" class="tumbSize"></div><div class="dropbtn-cap">Size</div>Medium';
        document.getElementById("sizebutton").style.backgroundColor = "#3e8e41";
        document.getElementById("tumbSize").style.backgroundImage = "none";
        document.getElementById("tumbSize").innerHTML = "M";
    } else if (x === 3) {
        document.getElementById("sizebutton").innerHTML = '<div id="tumbSize" class="tumbSize"></div><div class="dropbtn-cap">Size</div>Large';
        document.getElementById("sizebutton").style.backgroundColor = "#3e8e41";
        document.getElementById("tumbSize").style.backgroundImage = "none";
        document.getElementById("tumbSize").innerHTML = "L";
    } else {
        alert("Error! Reload your browser");
    }
    identifyBirdsAjax();
    closeNav();
}
function selectShapeIndex(x, y, z) {
    shapeIndex = x;
    if (x !== 0) {
        document.getElementById("shapebutton").innerHTML = "<div id='tumbShape' class='tumbShape'></div><div class='dropbtn-cap'>Shape</div>" + y;
        document.getElementById("tumbShape").style.backgroundImage = "url('../img/birds/shape/" + z + "')";
        document.getElementById("shapebutton").style.backgroundColor = "#3e8e41";
    } else {
        document.getElementById("shapebutton").innerHTML = "<div id='tumbShape' class='tumbShape'></div><div class='dropbtn-cap'>Shape</div>- None -";
        document.getElementById("tumbShape").style.backgroundImage = "";
        document.getElementById("shapebutton").style.backgroundColor = "";
    }
    identifyBirdsAjax();
    closeNav();
}

var countColors = 0;
function colorCheck(x) {
    document.getElementById("color-" + x).innerHTML = "✅";
    document.getElementById("colorbox-" + x).style.borderBottom = "5px solid #4CAF50";
}
function colorUncheck(x) {
    document.getElementById("color-" + x).innerHTML = "";
    document.getElementById("colorbox-" + x).style.border = "";
}
function selectColorIndex(x, y) {
    if (x === 0) {
        colorIndex = "";
        colorCodestr = "";
        countColors = 0;
        document.getElementById("colorPickModal").innerHTML = birdcolorobj;
        closeNav();
    } else {
        if (countColors === 0) {
            colorIndex = x;
            colorCodestr = y;
            countColors++;
            colorCheck(x);
        } else if (countColors === 1) {
            if (colorIndex.toString() === x.toString()) {
                colorIndex = "";
                colorCodestr = "";
                countColors = 0;
                colorUncheck(x);
            } else {
                colorIndex = colorIndex + "," + x;
                colorCodestr = colorCodestr + "|" + y;
                countColors++;
                colorCheck(x);
            }
        } else if (countColors > 1) {
            selectedcolorsavailable = true;
            selectedcolors = colorIndex.split(',');
            slctColCode = colorCodestr.split('|');
            for (i = 0; i < selectedcolors.length; i++) {
                if (selectedcolors[i].toString() === x.toString()) {
                    selectedcolors.splice(i, 1);
                    slctColCode.splice(i, 1);
                    selectedcolorsavailable = true;
                    break;
                } else {
                    selectedcolorsavailable = false;
                }
            }

            if (selectedcolorsavailable) {
                colorIndex = "";
                colorCodestr = "";
                for (i = 0; i < selectedcolors.length; i++) {
                    if (i === 0) {
                        colorIndex = selectedcolors[i];
                        colorCodestr = slctColCode[i];
                    } else {
                        colorIndex = colorIndex + "," + selectedcolors[i];
                        colorCodestr = colorCodestr + "|" + slctColCode[i];
                    }
                }
                --countColors;
                colorUncheck(x);
            } else if (countColors < 4) {
                colorIndex = colorIndex + "," + x;
                colorCodestr = colorCodestr + "|" + y;
                countColors++;
                colorCheck(x);
            } else {
                alert('You can only select 4 colors');
            }

        }
    }
    /////for tumb change
    if (countColors === 0) {
        document.getElementById("tumbColor").style.backgroundImage = "";
        document.getElementById("colorbutton").innerHTML = '<div id="tumbColor" class="tumbColor"></div><div class="dropbtn-cap">Colors</div>- None -';
        document.getElementById("colorbutton").style.backgroundColor = "";
    } else {
        colorcirclehtml = '<div id="tumbColor" class="tumbColor"></div><div class="dropbtn-cap">Colors</div>';
        tempColorPick = colorCodestr.split('|');
        for (i = 0; i < tempColorPick.length; i++) {
            colorcirclehtml = colorcirclehtml + '<div class="tumbColorCircle" style="background: ' + tempColorPick[i] + '"></div>';
        }
        document.getElementById("colorbutton").innerHTML = colorcirclehtml;
        document.getElementById("colorbutton").style.backgroundColor = "#3e8e41";
        document.getElementById("tumbColor").style.backgroundImage = "url('../img/birds/color/filled.png')";
    }
    identifyBirdsAjax();

//closeNav();

}

function mapClick(x) {
    document.getElementById('loc-' + x).click();
}

/*function mapOver(x) {
    document.getElementById('loc-' + x).style.borderBottom = "5px solid #4CAF50";
    document.getElementById('loc-' + x).style.backgroundColor = "#161a1e"
}
*/
function selectLocationIndex(x, y) {
    locationIndex = x;
    if (x === 0) {
        document.getElementById('locationbutton').innerHTML = '<div id="tumbLocation" class="tumbLocation"></div><div class="dropbtn-cap">Location</div>- None -';
        document.getElementById('locationbutton').style.backgroundColor = "";
    } else {
        document.getElementById('locationbutton').innerHTML = '<div id="tumbLocation" class="tumbLocation"></div><div class="dropbtn-cap">Location</div>' + y;
        document.getElementById('locationbutton').style.backgroundColor = "#3e8e41"
        document.getElementById('tumbLocation').style.backgroundImage = "url('../img/birds/location/picked.png')";
    }
    identifyBirdsAjax();
    closeNav();
}

function identifyBirdsAjax() {
    if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else {
        // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("birdDispaly").innerHTML = this.responseText;
            //alert(searchkey +" "+ checkCheckbox1 +" "+ checkCheckbox2 +" "+ checkCheckbox3);
        }
    };
    xmlhttp.open("GET", "feature_submit.php?birdSize=" + sizeIndex + "&birdShape=" + shapeIndex + "&birdColor=" + colorIndex + "&birdLocation=" + locationIndex, true);
    xmlhttp.send();
}

function describeAjax() {
    var describeTextArea = document.getElementById("describeTextArea").value;
    if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else {
        // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("birdDispaly").innerHTML = this.responseText;

        }
    };
    xmlhttp.open("GET", "feature_submit.php?describeText=" + describeTextArea, true);
    xmlhttp.send();
}

