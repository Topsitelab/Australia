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

    /*$("#aaaa").click(
        function(){
            //document.getElementById('aaaa').innerHTML = 'AAAAAAAAAAA';

            $("#popup-create").classList.remove("active");
            $("#popup-login").classList.add("active");
            return false;
        }
    );*/

});

// AJAX - Registration
function AjaxRegistration(ajax_form, url) {
    var username = document.getElementById('username').value;
    var email = document.getElementById('email').value;
    var password = document.getElementById('password').value;
    var password2 = document.getElementById('password2').value;
    var regSuccess = '<div class="regform-success">Thanks for registering,<br><br>and now please log in</div>';
    $.ajax({
        url: url,
        type: 'post',
        data: {username: username, email: email, password: password, password2: password2},
        dataType: 'json'
    }).done(function(data){
        if (data.status === 'OK') {
            //document.location.href = '/user/account';
            document.getElementById('regform-body').innerHTML = regSuccess;
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
    var token = document.getElementById('_csrf_token').value;
    $.ajax({
        url: url,
        type: 'post',
        data: {email: login, password: password, _csrf_token: token},
        dataType: 'json'
    }).done(function(data){
        if (data.status === 'OK') {
            document.location.href = '/user/account';
        }
        else {
            // Errors alert
            document.getElementById('loginHelpInline').innerHTML = data.error_message;
        }
    });

}