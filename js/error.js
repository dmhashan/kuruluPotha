/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

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
if (gup('error') === "signupGet") {
    alert("Try again, Signup Data Transfer Error");
} else if (gup('error') === "emailExit") {
    alert("Try again, Email already exists");
} else if (gup('error') === "usernameExit") {
    alert("Try again, Username already exists");
} else if (gup('error') === "logagain") {
    alert("Invalid session, Log Again");
}else if (gup('error') === "invalidunpw") {
    alert("Invalid username & password");
}
if (gup('error') === "unknown") {
    //sweetAlert("Try again...", "Unknown error", "error");
    alert("Try again, Unknown error");
}