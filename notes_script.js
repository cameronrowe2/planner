var edit_id = null;

$( document ).ready(function() {
    console.log( "ready!" );

    $('body').on('click', '#add', function(){
        $('#note_popup').show();
        $('#mask').show();

        $('#save_edit').hide();
        $('#submit').hide();
        $('#submit').show();

        $('#title').val("");
        $('#description').val("");
    })

    $('body').on('click', '#mask', function(){
        $('#note_popup').hide();
        $('#mask').hide();
    })

    $('body').on('touchend', '#mask', function(){

        if(documentClick) {

            $('#note_popup').hide();
            $('#mask').hide();

        }
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

            var html = '<table class="table">'
            html += '<tr><th>Title</th><th>Description</th><th></th><th></th></tr>'

            data.forEach(function(v, i, a){
                html += tablehtml(v)
            })

            if(data.length == 0) {
                html += '<tr><td id="nothing_here" colspan="100%">Nothing Here</td></tr>'
            }
    
            html += '</table>'

            $('#data').html(html);

            if(callback != null){
                callback();
            }
        });
    }

    display_notes()

    function tablehtml(v){

        var description = v.description
        if(description.length > 40) {
            var description = description.substring(0, 40) + "..."
        }

        var title = v.title;
        if(title.length > 20) {
            title = title.substring(0, 20) + "..."
        }
        

        return '<tr><td>'+title+'</td><td>'+description+'</td><td class="edit" id="e'+v.ID+'">EDIT</td><td class="delete" id="d'+v.ID+'">DELETE</td></tr>';
    }

    $('body').on('click', '#data .edit', function(){

        console.log($(this).attr("id").substring(1))
        edit_id = $(this).attr("id").substring(1)

        getNote()
    })

    $('body').on('touchend', '#data .edit', function(){

        if(documentClick) {

            console.log($(this).attr("id").substring(1))
            edit_id = $(this).attr("id").substring(1)

            getNote()
        }
    })

    function getNote() {
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
    }

    $('body').on('click', '#data .delete', function(){

        console.log($(this).attr("id").substring(1))
        var id = $(this).attr("id").substring(1)

        deleteNote(id)
    })

    $('body').on('touchend', '#data .delete', function(){

        if(documentClick) {

            console.log($(this).attr("id").substring(1))
            var id = $(this).attr("id").substring(1)

            deleteNote(id)
        }
    })

    function deleteNote(id){
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
    }

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