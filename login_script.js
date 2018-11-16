$( document ).ready(function() {

    $('#submit').click(function(){
        var email = $('#email').val();
        var password = $('#password').val();

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
                window.location.href = "menu.php"
            }
            
        });
    })
});