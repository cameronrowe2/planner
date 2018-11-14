var edit_id = null;

$( document ).ready(function() {
    console.log( "ready!" );

    $('body').on('click', '.add', function(){
        $('#calendar_popup').show();
        $('#mask').show();

        $('#save_edit').hide();
        $('#submit').hide();
        $('#submit').show();
    })

    $('body').on('click', '#mask', function(){
        $('#calendar_popup').hide();
        $('#mask').hide();
    })

    $('#submit').click(function(){
        var title = $('#title').val();
        var description = $('#description').val();
        var time = $('#time').val();

        $.ajax({
            url: "calendar_create.php",
            type: 'get',
            dataType: 'json',
            data: {
                title: title,
                description: description,
                time: time
            }
          })
        .done(function( data ) {
            console.log(data)
            $('#calendar_popup').hide();
            $('#mask').hide();
            display_calendars()
        });
    })

    function display_calendars(callback) {
        $.ajax({
            url: "calendars_get.php",
            type: 'get',
            dataType: 'json'
          })
        .done(function( data ) {
            
            // completely different a23

            // var html = '<tr><th>ID</th><th>Name</th><th>Email</th><th>Mobile</th><th></th><th></th></tr>'

            // data.forEach(function(v, i, a){
            //     html += tablehtml(v)
            // })
    
            // $('#data').html(html);

            if(callback != null){
                callback();
            }
        });
    }

    display_calendars()

    // function tablehtml(v){
    //     return '<tr><td>'+v.ID+'</td><td>'+v.name+'</td><td>'+v.email+'</td><td>'+v.mobile+'</td><td style="background-color: green" class="edit">EDIT</td><td style="background-color: red" class="delete">DELETE</td></tr>';
    // }

    $('body').on('click', '#data .edit', function(){
        // alert("BAM")
        // a23
        // console.log($(this).parent().find('td').eq(0).text())

        // edit_id = $(this).parent().find('td').eq(0).text()

        $.ajax({
            url: "calendar_get.php",
            type: 'get',
            dataType: 'json',
            data: {
                id: edit_id
            }
          })
        .done(function( data ) {
            console.log(data)

            $('#calendar_popup').show();
            $('#mask').show();

            $('#save_edit').hide();
            $('#submit').hide();
            $('#save_edit').show();

            $('#title').val(data.title)
            $('#description').val(data.description)
            $('#time').val(data.time)
        });
    })

    // a23
    // $('body').on('click', '#data .delete', function(){
    //     // alert("BAM")
    //     console.log($(this).parent().find('td').eq(0).text())

    //     var id = $(this).parent().find('td').eq(0).text()

    //     $.ajax({
    //         url: "contact_delete.php",
    //         type: 'get',
    //         dataType: 'json',
    //         data: {
    //             id: id
    //         }
    //       })
    //     .done(function( data ) {
    //         display_contacts()
    //     });
    // })

    $('#save_edit').click(function(){

        var title = $('#title').val();
        var description = $('#description').val();
        var time = $('#time').val();

        $.ajax({
            url: "calendar_edit.php",
            type: 'get',
            dataType: 'json',
            data: {
                id: edit_id,
                title: title,
                description: description,
                time: time
            }
          })
        .done(function( data ) {
            $('#calendar_popup').hide();
            $('#mask').hide();
            display_calendars()
        });
    })

    // a23
    // $('#search').keyup(function(){
    //     var val = $('#search').val();
    //     val = val.toLowerCase()

    //     // console.log($('#data tr'))

    //     $('#data tr').css('display', 'table-row')

    //     $.each($('#data tr'), function(i, v){
    //         if(i != 0) {
    //             var name = $(v).children().eq(1).text()
    //             var email = $(v).children().eq(2).text()
    //             var phone = $(v).children().eq(3).text()

    //             if(name.toLowerCase().indexOf(val) == -1 && email.toLowerCase().indexOf(val) == -1 && phone.toLowerCase().indexOf(val) == -1) {
    //                 $(v).css('display', 'none')
    //             }
    //         }
    //     })
    // })
});