/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/*
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
 if (gup('success') === "pwchange") {
 //sweetAlert("Try again...", "Unknown error", "error");
 alert("Password change has been done successfully!");
 }
 if (gup('error') === "signupGet") {
 alert("Try again, Signup Data Transfer Error");
 } else if (gup('error') === "emailExit") {
 alert("Try again, Email already exists");
 } else if (gup('error') === "usernameExit") {
 alert("Try again, Username already exists");
 } else if (gup('error') === "logagain") {
 alert("Invalid session, Log Again");
 } else if (gup('error') === "invalidunpw") {
 alert("Invalid username & password");
 } else if (gup('error') === "unknown") {
 alert("Try again, Unknown error");
 
 } else if (gup('error') === "expired") {
 //alert("Link has been expired");
 showNotification('success', 'Success!', 'Your request was completed successfully.');
 }
 
 if (gup('check') === "mail") {
 //sweetAlert("Try again...", "Unknown error", "error");
 alert("Reset information will be send into your email, check it");
 }
 
 
 */

function msgclose() {
    document.getElementById('msgoverlay').style.display = "none";
}

function countLoad() {
    var countdownElement = document.getElementById('countdiv'),
            seconds = 10,
            second = 0,
            interval;

    interval = setInterval(function () {
        countdownElement.firstChild.data = 'Message will be close in ' + (seconds - second) + ' seconds';
        if (second >= seconds) {
            msgclose();
            clearInterval(interval);
        }

        second++;
    }, 1000);
}