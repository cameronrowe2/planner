var edit_id = null;

$( document ).ready(function() {
    console.log( "ready!" );

    $('body').on('click', '#add', function(){
        $('#contact_popup').show();
        $('#mask').show();

        $('#save_edit').hide();
        $('#submit').hide();
        $('#submit').show();
    })

    $('body').on('click', '#mask', function(){
        $('#contact_popup').hide();
        $('#mask').hide();
    })

    $('#submit').click(function(){
        var name = $('#name').val();
        var email = $('#email').val();
        var mobile = $('#mobile').val();
        var phone = $('#phone').val();
        var reason = $('#reason').val();
        var website = $('#website').val();
        var address = $('#address').val();
        var comments = $('#comments').val();

        $.ajax({
            url: "contact_create.php",
            type: 'get',
            dataType: 'json',
            data: {
                name: name,
                email: email,
                mobile: mobile,
                phone: phone,
                reason: reason,
                website: website,
                address: address,
                comments: comments
            }
          })
        .done(function( data ) {
            console.log(data)
            $('#contact_popup').hide();
            $('#mask').hide();
            display_contacts()
        });
    })

    function display_contacts(callback) {
        $.ajax({
            url: "contacts_get.php",
            type: 'get',
            dataType: 'json'
          })
        .done(function( data ) {

            var html = '<tr><th>ID</th><th>Name</th><th>Email</th><th>Mobile</th><th></th><th></th></tr>'

            data.forEach(function(v, i, a){
                html += tablehtml(v)
            })
    
            $('#data').html(html);

            if(callback != null){
                callback();
            }
        });
    }

    display_contacts()

    function tablehtml(v){
        return '<tr><td>'+v.ID+'</td><td>'+v.name+'</td><td>'+v.email+'</td><td>'+v.mobile+'</td><td style="background-color: green" class="edit">EDIT</td><td style="background-color: red" class="delete">DELETE</td></tr>';
    }

    $('body').on('click', '#data .edit', function(){
        // alert("BAM")
        console.log($(this).parent().find('td').eq(0).text())

        edit_id = $(this).parent().find('td').eq(0).text()

        $.ajax({
            url: "contact_get.php",
            type: 'get',
            dataType: 'json',
            data: {
                id: edit_id
            }
          })
        .done(function( data ) {
            console.log(data)

            $('#contact_popup').show();
            $('#mask').show();

            $('#save_edit').hide();
            $('#submit').hide();
            $('#save_edit').show();

            $('#name').val(data.name)
            $('#email').val(data.email)
            $('#mobile').val(data.mobile)
            $('#phone').val(data.phone)
            $('#reason').val(data.reason)
            $('#website').val(data.website)
            $('#address').val(data.address)
            $('#comments').val(data.comments)
        });
    })

    $('body').on('click', '#data .delete', function(){
        // alert("BAM")
        console.log($(this).parent().find('td').eq(0).text())

        var id = $(this).parent().find('td').eq(0).text()

        $.ajax({
            url: "contact_delete.php",
            type: 'get',
            dataType: 'json',
            data: {
                id: id
            }
          })
        .done(function( data ) {
            display_contacts()
        });
    })

    $('#save_edit').click(function(){

        var name = $('#name').val();
        var email = $('#email').val();
        var mobile = $('#mobile').val();
        var phone = $('#phone').val();
        var reason = $('#reason').val();
        var website = $('#website').val();
        var address = $('#address').val();
        var comments = $('#comments').val();

        $.ajax({
            url: "contact_edit.php",
            type: 'get',
            dataType: 'json',
            data: {
                id: edit_id,
                name: name,
                email: email,
                mobile: mobile,
                phone: phone,
                reason: reason,
                website: website,
                address: address,
                comments: comments
            }
          })
        .done(function( data ) {
            $('#contact_popup').hide();
            $('#mask').hide();
            display_contacts()
        });
    })

    $('#search').keyup(function(){
        var val = $('#search').val();
        val = val.toLowerCase()

        // console.log($('#data tr'))

        $('#data tr').css('display', 'table-row')

        $.each($('#data tr'), function(i, v){
            if(i != 0) {
                var name = $(v).children().eq(1).text()
                var email = $(v).children().eq(2).text()
                var phone = $(v).children().eq(3).text()

                if(name.toLowerCase().indexOf(val) == -1 && email.toLowerCase().indexOf(val) == -1 && phone.toLowerCase().indexOf(val) == -1) {
                    $(v).css('display', 'none')
                }
            }
        })
    })
});