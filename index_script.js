$( document ).ready(function() {

    $('body').on('click', '#login', function(){
        $('#login_popup').show();
        $('#mask').show();
    })

    $('body').on('click', '#mask', function(){
        $('#login_popup').hide();
        $('#create_account_popup').hide();
        $('#mask').hide();
    })

    $('body').on('click', '#create_account', function(){
        $('#create_account_popup').show();
        $('#mask').show();
    })

    $('#submit_login').click(function(){
        var email = $('#login_email').val();
        var password = $('#login_password').val();

        $.ajax({
            url: "login_call.php",
            type: 'get',
            dataType: 'json',
            data: {
                email: email,
                password: password
            }
          })
        .done(function( data ) {
            console.log(data)
            if(data.success) {
                window.location.href = "calendar.php"
            }
            
        });
    })

    $('#submit_create_account').click(function(){
        var email = $('#create_account_email').val();
        var password = $('#create_account_password').val();
        var password2 = $('#create_account_password2').val();

        $.ajax({
            url: "create_account_call.php",
            type: 'get',
            dataType: 'json',
            data: {
                email: email,
                password: password,
                password2: password2
            }
          })
        .done(function( data ) {
            console.log(data)
            $('#create_account_popup').hide();
            $('#mask').hide();
        });
    })
});