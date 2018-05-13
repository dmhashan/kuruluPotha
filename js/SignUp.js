//jQuery time
var current_fs, next_fs, previous_fs; //fieldsets
var left, opacity, scale; //fieldset properties which we will animate
var animating; //flag to prevent quick multi-click glitches

$(".next").click(function () {
    if (animating)
        return false;
    animating = true;
    current_fs = $(this).parent();
    next_fs = $(this).parent().next();
    //activate next step on progressbar using the index of next_fs
    $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
    //show the next fieldset
    next_fs.show();
    //hide the current fieldset with style
    current_fs.animate({opacity: 0}, {
        step: function (now, mx) {
            //as the opacity of current_fs reduces to 0 - stored in "now"
            //1. scale current_fs down to 80%
            scale = 1 - (1 - now) * 0.2;
            //2. bring next_fs from the right(50%)
            left = (now * 50) + "%";
            //3. increase opacity of next_fs to 1 as it moves in
            opacity = 1 - now;
            current_fs.css({'transform': 'scale(' + scale + ')'});
            next_fs.css({'left': left, 'opacity': opacity});
        },
        duration: 800,
        complete: function () {
            current_fs.hide();
            animating = false;
        },
        //this comes from the custom easing plugin
        easing: 'easeInOutBack'
    });
});
$(".previous").click(function () {
    if (animating)
        return false;
    animating = true;
    current_fs = $(this).parent();
    previous_fs = $(this).parent().prev();
    //de-activate current step on progressbar
    $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
    //show the previous fieldset
    previous_fs.show();
    //hide the current fieldset with style
    current_fs.animate({opacity: 0}, {
        step: function (now, mx) {
            //as the opacity of current_fs reduces to 0 - stored in "now"
            //1. scale previous_fs from 80% to 100%
            scale = 0.8 + (1 - now) * 0.2;
            //2. take current_fs to the right(50%) - from 0%
            left = ((1 - now) * 50) + "%";
            //3. increase opacity of previous_fs to 1 as it moves in
            opacity = 1 - now;
            current_fs.css({'left': left});
            previous_fs.css({'transform': 'scale(' + scale + ')', 'opacity': opacity});
        },
        duration: 800,
        complete: function () {
            current_fs.hide();
            animating = false;
        },
        //this comes from the custom easing plugin
        easing: 'easeInOutBack'
    });
});
$(".submit").click(function () {
    return false;
});
/////////////HHD Coding/////////////////////


//////////gup url parameters//////////////
function gup(name)
{
    name = name.replace(/[\[]/, "\\\[").replace(/[\]]/, "\\\]");
    var regexS = "[\\?&]" + name + "=([^&#]*)";
    var regex = new RegExp(regexS);
    var results = regex.exec(window.location.href);
    if (results == null)
        return "";
    else
        return results[1];
}
/////////////////////////////////////////



//uploaded image show
$(document).ready(function () {
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#image_upload_preview').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#imageToUpload").change(function () {
        readURL(this);
        document.getElementById('proPicId').innerHTML = "Change Profile Picture";
    });
});
//date pickup
$(document).ready(function () {
    $("#datepicker").datepicker();
});
//onload selectindex change
function hhdPageLoad() {
    document.getElementById('accountSelect').selectedIndex = 0;
}


//StepOne validation
var fname = document.getElementById("fname");
var lname = document.getElementById("lname");
var password = document.getElementById("password");
var email = document.getElementById("email").value;
var username = document.getElementById("username").value;
var prePassword = gup("prePassword");
fname.addEventListener("focusout", fnameFunction);
lname.addEventListener("focusout", lnameFunction);
password.addEventListener("focusout", PasswordFunction);
var stateFname = false;
var stateLname = false;
var statePassword = false;
function setStepOneError(x, y) {
    document.getElementById("stepOneError").style.color = "#b20000";
    document.getElementById(x).style.border = "1px solid #b20000";
    document.getElementById("stepOneError").innerHTML = y;
    setTimeout(function () {
        document.getElementById("stepOneError").style.color = "";
        document.getElementById("stepOneError").innerHTML = 'Confirm your deatils';
    }, 3000);
}

function fnameFunction() {
    var regexName = /^[a-z A-Z]+$/;
    if (!fname.value.match(regexName) || fname.value === "") {
        setStepOneError('fname', 'Enter valid First Name');
        stateFname = false;
        return true;
    } else if (fname.value === lname.value) {
        setStepOneError('fname', "You can't use same first and last name");
        stateFname = false;
        return true;
    } else {
        document.getElementById('fname').style.border = "";
        stateFname = true;
        return false;
    }
}
function lnameFunction() {
    var regexName = /^[a-z A-Z]+$/;
    if (!lname.value.match(regexName) || lname.value === "") {
        setStepOneError('lname', 'Enter valid Last Name');
        stateLname = false;
        return true;
    } else if (lname.value === fname.value) {
        setStepOneError('lname', "You can't use same first and last name");
        stateLname = false;
        return true;
    } else {
        document.getElementById('lname').style.border = "";
        stateLname = true;
        return false;
    }
}
function PasswordFunction() {
    var regexpw = /^([A-Za-z0-9~!@#$%^&*()_+]{6,20})+$/;
    if (!password.value.match(regexpw) || password.value === "") {
        setStepOneError('password', 'Enter valid password');
        statePassword = false;
        return true;
    } else if (password.value !== prePassword) {
        setStepOneError('password', 'Password does not match');
        statePassword = false;
        return true;
    } else {
        document.getElementById('password').style.border = "";
        statePassword = true;
        return false;
    }
}

function stepOne() {
    fnameFunction();
    lnameFunction();
    PasswordFunction();
    if (!stateFname || !stateLname || !statePassword || email === "" || username === "") {
        document.getElementById("stepOneError").style.color = "#b20000";
        document.getElementById("stepOneError").innerHTML = 'Please check once again red colored textboxes';
        setTimeout(function () {
            document.getElementById("stepOneError").style.color = "";
            document.getElementById("stepOneError").innerHTML = 'Confirm your deatils';
        }, 3000);
    } else {
        document.getElementById("nextOne").click();
    }
}

//StepTwo validation
var nic = document.getElementById("nic");
var occupation = document.getElementById("occupation");
var number = document.getElementById("number");
var bday = document.getElementById("datepicker");
var fileToUpload = document.getElementById("fileToUpload");
var resid = document.getElementById("resid");
var resorg = document.getElementById("resorg");
var stateNic = false;
var stateOccupation = false;
var stateNumber = false;
var stateBday = false;
var stateFileToUpload = false;
var stateresorg = false;
var stateresid = false;
var reasearcherValidation = false;
var accountSelect = false;


//research selected
function clickNormal() {
    document.getElementById('normalUserDiv').style.display = 'block';
    document.getElementById('researcherDiv').style.display = 'none';
    nic.placeholder = "NIC No";
    occupation.placeholder = "Occupation";
    number.placeholder = "Contact Number";
    bday.placeholder = "Birthday";
    reasearcherValidation = false;
    accountSelect = true;
    document.getElementById('nic').style.border = "";
    document.getElementById('occupation').style.border = "";
    document.getElementById('number').style.border = "";
    document.getElementById('datepicker').style.border = "";
    document.getElementById('fileToUpload').style.border = "";
}
//normal user selected
function clickResearcher() {
    document.getElementById('researcherDiv').style.display = 'block';
    document.getElementById('normalUserDiv').style.display = 'block';
    nic.placeholder = "NIC No*";
    occupation.placeholder = "Occupation*";
    number.placeholder = "Contact Number*";
    bday.placeholder = "Birthday*";
    reasearcherValidation = true;
    accountSelect = true;
    nicFunction();
    occupationFunction();
    numberFunction();
    bdayFunction();
    residFunction();
    resorgFunction();
    fileToUploadFunction();
    if (!stateNic || !stateOccupation || !stateNumber || !stateBday || !stateFileToUpload) {
        document.getElementById("stepTwoError").style.color = "#b20000";
        document.getElementById("stepTwoError").innerHTML = 'These inputs are compulsory';
        setTimeout(function () {
            document.getElementById("stepTwoError").style.color = "";
            document.getElementById("stepTwoError").innerHTML = 'You can register as normal user and reasearcher';
        }, 3000);
    }

}

nic.addEventListener("focusout", nicFunction);
occupation.addEventListener("focusout", occupationFunction);
number.addEventListener("focusout", numberFunction);
bday.addEventListener("focusout", bdayFunction);
fileToUpload.addEventListener("focusout", fileToUploadFunction);
resid.addEventListener("focusout", residFunction);
resorg.addEventListener("focusout", resorgFunction);

function setStepTwoError(x, y) {
    document.getElementById("stepTwoError").style.color = "#b20000";
    document.getElementById(x).style.border = "1px solid #b20000";
    document.getElementById("stepTwoError").innerHTML = y;
    setTimeout(function () {
        document.getElementById("stepTwoError").style.color = "";
        document.getElementById("stepTwoError").innerHTML = 'You can register as normal user and reasearcher';
    }, 3000);
}

function nicFunction() {
    if (reasearcherValidation || nic.value !== "") {
        var regexnic = /^([0-9]{9})([vVxX]{1})+$/;
        if (!nic.value.match(regexnic) || nic.value === "") {
            setStepTwoError('nic', 'Enter valid NIC number');
            stateNic = false;
            return true;
        } else {
            document.getElementById('nic').style.border = "";
            stateNic = true;
            return false;
        }
    }
}
function occupationFunction() {
    if (reasearcherValidation || occupation.value !== "") {
        var regexoccupation = /^([a-zA-Z &])+$/;
        if (!occupation.value.match(regexoccupation) || occupation.value === "") {
            setStepTwoError('occupation', 'Enter valid occupation');
            stateOccupation = false;
            return true;
        } else {
            document.getElementById('occupation').style.border = "";
            stateOccupation = true;
            return false;
        }
    }
}
function numberFunction() {
    if (reasearcherValidation || number.value !== "") {
        var regexnumber = /^([0-9]{10})+$/;
        if (!number.value.match(regexnumber) || number.value === "") {
            setStepTwoError('number', 'Enter valid phone number');
            stateNumber = false;
            return true;
        } else {
            document.getElementById('number').style.border = "";
            stateNumber = true;
            return false;
        }
    }
}
function bdayFunction() {
    if (reasearcherValidation) {
        if (bday.value === "") {
            setStepTwoError('datepicker', 'Enter valid phone number');
            stateBday = false;
            return true;
        } else {
            document.getElementById('datepicker').style.border = "";
            stateBday = true;
            return false;
        }
    }
}

function fileToUploadFunction() {
    if (fileToUpload.files.length > 0) {
        document.getElementById('fileToUpload').style.border = "";
        stateFileToUpload = true;
        return false;
    } else {
        setStepTwoError('fileToUpload', 'Browse valid document');
        stateFileToUpload = false;
        return true;
    }
}

function residFunction() {
    if (reasearcherValidation) {
        if (resid.value === "") {
            setStepTwoError('resid', 'Enter valid researcher id');
            stateresid = false;
            return true;
        } else {
            document.getElementById('resid').style.border = "";
            stateresid = true;
            return false;
        }
    }
}

function resorgFunction() {
    if (reasearcherValidation) {
        if (resorg.value === "") {
            setStepTwoError('resorg', 'Enter valid researcher organization');
            stateresorg = false;
            return true;
        } else {
            document.getElementById('resorg').style.border = "";
            stateresorg = true;
            return false;
        }
    }
}

function stepTwo() {
    if (accountSelect) {
        if (reasearcherValidation) {
            nicFunction();
            occupationFunction();
            numberFunction();
            bdayFunction();
            fileToUploadFunction();
            residFunction();
            resorgFunction();
            if (stateNic || stateOccupation || stateNumber || stateBday || stateFileToUpload || stateresorg ||stateresid) {
                document.getElementById("nextTwo").click();
            } else {
                document.getElementById("stepTwoError").style.color = "#b20000";
                document.getElementById("stepTwoError").innerHTML = 'Please check once again red colored textboxes';
                setTimeout(function () {
                    document.getElementById("stepTwoError").style.color = "";
                    document.getElementById("stepTwoError").innerHTML = 'You can register as normal user and reasearcher';
                }, 3000);
            }
        } else {
            document.getElementById("nextTwo").click();
        }
    } else {
        document.getElementById("stepTwoError").style.color = "#b20000";
        document.getElementById("stepTwoError").innerHTML = 'Please select any account type';
        setTimeout(function () {
            document.getElementById("stepTwoError").style.color = "";
            document.getElementById("stepTwoError").innerHTML = 'You can register as normal user and reasearcher';
        }, 3000);
    }
}

///////step three/////////////

function imageUploadClick() {
    document.getElementById("imageToUpload").click();
}

function signUpSubmit() {
    document.getElementById("msform").submit();
}