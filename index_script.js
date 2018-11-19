$( document ).ready(function() {

    $('body').on('click', '#login', function(){
        $('#login_popup').show();
        $('#mask').show();

        $('#login_email').val("");
        $('#login_password').val("");
    })

    $('body').on('click', '#mask', function(){
        $('#login_popup').hide();
        $('#create_account_popup').hide();
        $('#mask').hide();
    })

    $('body').on('touchend', '#mask', function(){

        if(documentClick) {

            $('#login_popup').hide();
            $('#create_account_popup').hide();
            $('#mask').hide();

        }
    })

    $('body').on('click', '#create_account', function(){
        $('#create_account_popup').show();
        $('#mask').show();

        $('#create_account_email').val("");
        $('#create_account_password').val("");
        $('#create_account_password2').val("");
    })

    $('#login_password').keyup(function(e){
        if(e.keyCode == 13)
        {
            login()
        }
    });

    $('#submit_login').click(function(){
        login()
    })

    function login(){
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
    }

    $('#create_account_password2').keyup(function(e){
        if(e.keyCode == 13)
        {
            create_account()
        }
    });

    $('#submit_create_account').click(function(){
        create_account()
    })

    function create_account(){
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
            if(data.success) {
                $('#create_account_popup').hide();
                $('#mask').hide();
            }
        });
    }
});