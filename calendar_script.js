var edit_id = null;
var edit_date = null;

$( document ).ready(function() {
    console.log( "ready!" );

    $('body').on('click', '.add', function(){
        edit_date = $(this).attr('id').substring(1);
        $('#calendar_popup').show();
        setTimeout(function(){
            $('#mask').show();
        }, 300)

        $('#title').val("")
        $('#description').val("")
        $('#time').val("")
    })

    $('body').on('touchend', '.add', function(){

        if(documentClick){
            
            edit_date = $(this).attr('id').substring(1);
            $('#calendar_popup').show();
            setTimeout(function(){
                $('#mask').show();
            }, 300)

            $('#title').val("")
            $('#description').val("")
            $('#time').val("")

        }
    })

    $('body').on('click', '#mask', function(){
        $('#calendar_popup').hide();
        $('#calendar_edit_popup').hide();
        $('#mask').hide();
    })

    $('body').on('touchend', '#mask', function(){
        if(documentClick){
            $('#calendar_popup').hide();
            $('#calendar_edit_popup').hide();
            $('#mask').hide();
        }
    })

    $('#title, #description, #time').keyup(function(e){
        if(e.keyCode == 13)
        {
            createCalendar()
        }
    });

    $('#submit').click(function(){
        createCalendar()
    })

    function createCalendar(){
        var title = $('#title').val();
        var description = $('#description').val();
        var time = $('#time').val();

        $.ajax({
            url: "calendar_create.php",
            type: 'get',
            dataType: 'json',
            data: {
                date: edit_date,
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
    }

    function display_calendars(callback) {
        $.ajax({
            url: "calendars_get.php",
            type: 'get',
            dataType: 'json'
          })
        .done(function( data ) {
            
            grid_layout(data);
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

    function get_date(date){
        var dd = date.getDate();
        var mm = date.getMonth()+1; //January is 0!
        var yyyy = date.getFullYear();

        if(dd<10) {
            dd = '0'+dd
        } 

        if(mm<10) {
            mm = '0'+mm
        } 

        date = yyyy + '-' + mm + '-' + dd;
        return date;
    }

    function str_month(n){
        var str = ''

        switch(n) {
            case 0:
                str = 'January'
                break;
            case 1:
                str = 'February'
                break;
            case 2:
                str = 'March'
                break;
            case 3:
                str = 'April'
                break;
            case 4:
                str = 'May'
                break;
            case 5:
                str = 'June'
                break;
            case 6:
                str = 'July'
                break;
            case 7:
                str = 'August'
                break;
            case 8:
                str = 'Spetember'
                break;
            case 9:
                str = 'October'
                break;
            case 10:
                str = 'November'
                break;
            case 11:
                str = 'December'
                break;
        }

        return str;
    }

    function grid_layout(data){
        var today = new Date()

        var d18m = new Date()
        d18m.setMonth( d18m.getMonth() + 6 )
        d18m.setFullYear( d18m.getFullYear() + 1 )
        
        var html = ""

        for(var d = new Date(today); get_date(d) != get_date(d18m); d.setDate( d.getDate() + 1 )) {
            // first date OR first day of month
            if(get_date(d) == get_date(today) || d.getDate() == 1) {

                var day = d.getDay();

                html += "<h3>" + str_month(d.getMonth()) + " " + d.getFullYear() + "</h3>"

                html += "<div class='table_parent'><table class='table' class='data' ><tr><th>Sun</th><th>Mon</th><th>Tue</th><th>Wed</th><th>Thu</th><th>Fri</th><th>Sat</th></tr>"

                html += "<tr>"

                for(var i = 0; i < day; i++){
                    html += "<td></td>"
                }
            } else if(d.getDate() != 1 && d.getDay() == 0) {
                html += "<tr>"
            }

            // add box
            html += "<td id='d" + get_date(d) + "' class='add'>" + get_date(d).substring(8)

            // add any calendars
            data.forEach(function(v){
                if(v.date == get_date(d)) {
                    console.log('in')

                    var date_title = v.title;
                    if(date_title.length > 20) {
                        date_title = date_title.substring(0, 20) + "..."
                    }

                    html += "<div class='edit' id='c" + v.ID + "'>" + date_title + "</div>"
                }
            })
            
            // end box
            html += "</td>"

            // check if next date is new month - if so end month
            var d2 = new Date(d)
            d2.setDate( d2.getDate() + 1 )
            if(d2.getDate() == 1){
                var day = d.getDay();

                for(var i = day + 1; i < 7; i++){
                    html += "<td></td>"
                }

                html += "</tr></table></div>"
            }

            // if day is 6 reset row
            if(d.getDay() === 6) {
                html += "</tr>"
            }
        }

        $('#data').html(html);
    }

    // function tablehtml(v){
    //     return '<tr><td>'+v.ID+'</td><td>'+v.name+'</td><td>'+v.email+'</td><td>'+v.mobile+'</td><td style="background-color: green" class="edit">EDIT</td><td style="background-color: red" class="delete">DELETE</td></tr>';
    // }

    $('body').on('click', '#data .edit', function(){
        edit_id = $(this).attr('id').substring(1)
        console.log(edit_id)

        getCalendarData()
    })

    $('body').on('touchend', '#data .edit', function(){
        if(documentClick){
            edit_id = $(this).attr('id').substring(1)
            console.log(edit_id)

            getCalendarData()
        }
    })

    function getCalendarData() {
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

            $('#calendar_edit_popup').show();
            $('#mask').show();

            edit_date = data.date
            $('#title_edit').val(data.title)
            $('#description_edit').val(data.description)
            $('#time_edit').val(data.time)
        });
    }

    $('body').on('click', '#delete', function(){

        $.ajax({
            url: "calendar_delete.php",
            type: 'get',
            dataType: 'json',
            data: {
                id: edit_id
            }
          })
        .done(function( data ) {
            display_calendars()
            $('#calendar_popup').hide();
            $('#calendar_edit_popup').hide();
            $('#mask').hide();
        });
    })

    $('#title_edit, #description_edit, #time_edit').keyup(function(e){
        if(e.keyCode == 13)
        {
            editCalendar()
        }
    });

    $('#save_edit').click(function(){
        editCalendar()
    })

    function editCalendar(){
        var title = $('#title_edit').val();
        var description = $('#description_edit').val();
        var time = $('#time_edit').val();

        $.ajax({
            url: "calendar_edit.php",
            type: 'get',
            dataType: 'json',
            data: {
                id: edit_id,
                date: edit_date,
                title: title,
                description: description,
                time: time
            }
          })
        .done(function( data ) {
            $('#calendar_popup').hide();
            $('#calendar_edit_popup').hide();
            $('#mask').hide();
            display_calendars()
        });
    }
});