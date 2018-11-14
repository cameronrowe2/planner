var edit_id = null;

$( document ).ready(function() {
    console.log( "ready!" );

    $('body').on('click', '#add', function(){
        $('#note_popup').show();
        $('#mask').show();

        $('#save_edit').hide();
        $('#submit').hide();
        $('#submit').show();
    })

    $('body').on('click', '#mask', function(){
        $('#note_popup').hide();
        $('#mask').hide();
    })

    $('#submit').click(function(){
        var title = $('#title').val();
        var description = $('#description').val();

        $.ajax({
            url: "note_create.php",
            type: 'get',
            dataType: 'json',
            data: {
                title: title,
                description: description
            }
          })
        .done(function( data ) {
            console.log(data)
            $('#note_popup').hide();
            $('#mask').hide();
            display_notes()
        });
    })

    function display_notes(callback) {
        $.ajax({
            url: "notes_get.php",
            type: 'get',
            dataType: 'json'
          })
        .done(function( data ) {

            var html = '<tr><th>ID</th><th>Title</th><th>Description</th><th></th><th></th></tr>'

            data.forEach(function(v, i, a){
                html += tablehtml(v)
            })
    
            $('#data').html(html);

            if(callback != null){
                callback();
            }
        });
    }

    display_notes()

    function tablehtml(v){

        var description = v.description
        if(description.length > 20) {
            var description = description.substring(0, 20) + "..."
        }
        

        return '<tr><td>'+v.ID+'</td><td>'+v.title+'</td><td>'+description+'</td><td style="background-color: green" class="edit">EDIT</td><td style="background-color: red" class="delete">DELETE</td></tr>';
    }

    $('body').on('click', '#data .edit', function(){
        // alert("BAM")
        console.log($(this).parent().find('td').eq(0).text())

        edit_id = $(this).parent().find('td').eq(0).text()

        $.ajax({
            url: "note_get.php",
            type: 'get',
            dataType: 'json',
            data: {
                id: edit_id
            }
          })
        .done(function( data ) {
            console.log(data)

            $('#note_popup').show();
            $('#mask').show();

            $('#save_edit').hide();
            $('#submit').hide();
            $('#save_edit').show();

            $('#title').val(data.title)
            $('#description').val(data.description)
        });
    })

    $('body').on('click', '#data .delete', function(){
        // alert("BAM")
        console.log($(this).parent().find('td').eq(0).text())

        var id = $(this).parent().find('td').eq(0).text()

        $.ajax({
            url: "note_delete.php",
            type: 'get',
            dataType: 'json',
            data: {
                id: id
            }
          })
        .done(function( data ) {
            display_notes()
        });
    })

    $('#save_edit').click(function(){

        var title = $('#title').val();
        var description = $('#description').val();

        $.ajax({
            url: "note_edit.php",
            type: 'get',
            dataType: 'json',
            data: {
                id: edit_id,
                title: title,
                description: description
            }
          })
        .done(function( data ) {
            $('#note_popup').hide();
            $('#mask').hide();
            display_notes()
        });
    })

    $('#search').keyup(function(){
        var val = $('#search').val();
        val = val.toLowerCase()

        // console.log($('#data tr'))

        $('#data tr').css('display', 'table-row')

        $.each($('#data tr'), function(i, v){
            if(i != 0) {
                var title = $(v).children().eq(1).text()
                var description = $(v).children().eq(2).text()

                if(title.toLowerCase().indexOf(val) == -1 && description.toLowerCase().indexOf(val) == -1) {
                    $(v).css('display', 'none')
                }
            }
        })
    })
});