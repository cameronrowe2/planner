$( document ).ready(function() {

    $('#submit').click(function(){
        var email = $('#email').val();
        var password = $('#password').val();
        var password2 = $('#password2').val();

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
            // if(data.success) {
            //     window.location.href = "menu.php"
            // }
            
        });
    })
});