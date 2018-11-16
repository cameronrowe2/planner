$( document ).ready(function() {

    $('body').append('<div id="logout">Logout</div>');

    $('body').on('click', '#logout', function(){
        window.location.href = "logout.php"
    })
});