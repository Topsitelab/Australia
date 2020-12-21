$( document ).ready(function() {

    // Button SIGN IN click
    $("#reg_submit").click(
        function(){
            AjaxRegistration('ajax_reg_form', "/registration");
            return false;
        }
    );

    // Button LOGIN click
    $("#auth_submit").click(
        function(){
            AjaxLogin('ajax_auth_form', "/login");
            return false;
        }
    );

});

// AJAX - Registration
function AjaxRegistration(ajax_form, url) {
    var username = document.getElementById('username').value;
    var email = document.getElementById('email').value;
    var password = document.getElementById('password').value;
    var password2 = document.getElementById('password2').value;
    $.ajax({
        url: url,
        type: 'post',
        data: {username: username, email: email, password: password, password2: password2},
        dataType: 'json'
    }).done(function(data){
        if (data.status === 'OK') {
            document.location.href = '/en/userpage';
        }
        else {
            // Errors alert
            document.getElementById('usernameHelpInline').innerHTML = data.error_username;
            document.getElementById('emailHelpInline').innerHTML = data.error_email;
            document.getElementById('passwordHelpInline').innerHTML = data.error_password;
            document.getElementById('password2HelpInline').innerHTML = data.error_password2;
        }
    });

}

// AJAX - Login
function AjaxLogin(ajax_form, url) {
    var login = document.getElementById('login').value;
    var password = document.getElementById('pass').value;
    $.ajax({
        url: url,
        type: 'post',
        data: {login: login, password: password},
        dataType: 'json'
    }).done(function(data){
        if (data.status === 'OK') {
            document.location.href = '/en/userpage';
            //document.getElementById('form_result').innerHTML = data.status;
        }
        else {
            // Errors alert
            document.getElementById('loginHelpInline').innerHTML = data.error_login;
            document.getElementById('passHelpInline').innerHTML = data.error_password;
        }
    });

}