//label small and goes bellow focus//
$('.form').find('input, textarea').on('keyup blur focus', function (e) {

    var $this = $(this),
            label = $this.prev('label');
    if (e.type === 'keyup') {
        if ($this.val() === '') {
            label.removeClass('active highlight');
        } else {
            label.addClass('active highlight');
        }
    } else if (e.type === 'blur') {
        if ($this.val() === '') {
            label.removeClass('active highlight');
        } else {
            label.removeClass('highlight');
        }
    } else if (e.type === 'focus') {

        if ($this.val() === '') {
            label.removeClass('highlight');
        } else if ($this.val() !== '') {
            label.addClass('highlight');
        }
    }

});
//login and sigup swap//
$('.tab a').on('click', function (e) {

    e.preventDefault();
    $(this).parent().addClass('active');
    $(this).parent().siblings().removeClass('active');
    target = $(this).attr('href');
    $('.tab-content > div').not(target).hide();
    $(target).fadeIn(600);
});


/////// HHD Coding //////////
var preFname = document.getElementById("preFname");
var preLname = document.getElementById("preLname");
var preEmail = document.getElementById("preEmail");
var preUsername = document.getElementById("preUsername");
var prePassword = document.getElementById("prePassword");
preFname.addEventListener("focusout", preFnameFunction);
preLname.addEventListener("focusout", preLnameFunction);
preEmail.addEventListener("focusout", preEmailFunction);
preUsername.addEventListener("focusout", preUsernameFunction);
prePassword.addEventListener("focusout", prePasswordFunction);
var stateFname = false;
var stateLname = false;
var stateEmail = false;
var stateUsername = false;
var statePassword = false;

function setH1(x, y) {
    document.getElementById("error").style.color = "#b20000";
    document.getElementById(x).style.border = "1px solid #b20000";
    document.getElementById("error").innerHTML = y;
    setTimeout(function () {
        document.getElementById("error").style.color = "";
        document.getElementById("error").innerHTML = 'Sign Up for Free';
    }, 3000);
}
function preFnameFunction() {
    var regexName = /^[a-z A-Z]+$/;
    if (!preFname.value.match(regexName) || preFname.value === "") {
        setH1('preFname', 'Enter valid First Name');
        stateFname = false;
        return true;
    } else if (preFname.value === preLname.value) {
        setH1('preFname', "You can't use same first and last name");
        stateFname = false;
        return true;
    } else {
        document.getElementById('preFname').style.border = "";
        stateFname = true;
        return false;
    }
}
function preLnameFunction() {
    var regexName = /^[a-z A-Z]+$/;
    if (!preLname.value.match(regexName) || preLname.value === "") {
        setH1('preLname', 'Enter valid Last Name');
        stateLname = false;
        return true;
    } else if (preFname.value === preLname.value) {
        setH1('preLname', "You can't use same first and last name");
        stateLname = false;
        return true;
    } else {
        document.getElementById('preLname').style.border = "";
        stateLname = true;
        return false;
    }
}


function preEmailFunction()
{
    var regexName = /^([a-zA-Z0-9]{1})+([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if (!preEmail.value.match(regexName) || preEmail.value === "") {
        setH1('preEmail', 'Enter valid Email Address');
        stateEmail = false;
        return true;
    } else {
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function () {
            document.getElementById("email_status").innerHTML = this.responseText;
            var emailStatus = document.getElementById("email_status").innerHTML;
            if (emailStatus === "YESEMAIL") {
                setH1('preEmail', 'Email already exists');
                stateEmail = false;
                return true;
            } else {
                document.getElementById('preEmail').style.border = "";
                stateEmail = true;
                return false;
            }
        };
        xmlhttp.open("GET", "CoreFunc/loginEmailUnCheck.php?preEmail=" + preEmail.value, true);
        xmlhttp.send();
    }
}

function preUsernameFunction()
{
    var regexUN = /^([a-zA-Z0-9]{1})+([a-zA-Z0-9_\.\-]{5,20})+$/;
    if (!preUsername.value.match(regexUN) || preUsername.value === "") {
        setH1('preUsername', 'Enter valid Username');
        stateUsername = false;
        return true;
    } else {
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function () {
            document.getElementById("un_status").innerHTML = this.responseText;
            var un_status = document.getElementById("un_status").innerHTML;
            if (un_status === "YESUN") {
                setH1('preUsername', 'Username already exists');
                stateUsername = false;
                return true;
            } else {
                document.getElementById('preUsername').style.border = "";
                stateUsername = true;
                return false;
            }
        };
        xmlhttp.open("GET", "CoreFunc/loginEmailUnCheck.php?preUsername=" + preUsername.value, true);
        xmlhttp.send();
    }
}

function prePasswordFunction()
{
    var regexpw = /^([A-Za-z0-9~!@#$%^&*()_+]{6,20})+$/;
    if (!prePassword.value.match(regexpw) || prePassword.value === "") {
        setH1('prePassword', 'Enter valid password');
        statePassword = false;
        return true;
    } else {
        document.getElementById('prePassword').style.border = "";
        statePassword = true;
        return false;
    }
}

function preSubmit() {
    preFnameFunction();
    preLnameFunction();
    preEmailFunction();
    preUsernameFunction();
    prePasswordFunction();
    
    if (stateFname && stateLname && stateEmail && stateUsername && statePassword) {
        document.getElementById("preSignUp").action = "CoreFunc/singup.php";
        document.getElementById("preSignUp").submit();
    } else {
        document.getElementById("error").style.color = "#b20000";
        document.getElementById("error").innerHTML = 'Check the red color text box';
    }
}
