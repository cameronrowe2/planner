var edit_id = null;
var edit_date = null;

$( document ).ready(function() {
    console.log( "ready!" );

    $('body').on('click', '.add', function(){
        edit_date = $(this).attr('id').substring(1);
        $('#dairy_popup').show();
        $('#mask').show();

        $('#save_edit').hide();
        $('#submit').hide();
        $('#delete').hide();
        $('#submit').show();
    })

    $('body').on('touchend', '.add', function(){
        edit_date = $(this).attr('id').substring(1);
        $('#dairy_popup').show();
        $('#mask').show();

        $('#save_edit').hide();
        $('#submit').hide();
        $('#delete').hide();
        $('#submit').show();
    })

    $('body').on('click', '#mask', function(){
        $('#dairy_popup').hide();
        $('#mask').hide();
    })

    $('body').on('touchend', '#mask', function(){
        $('#dairy_popup').hide();
        $('#mask').hide();
    })

    $('#submit').click(function(){
        var title = $('#title').val();
        var description = $('#description').val();
        var time = $('#time').val();

        $.ajax({
            url: "dairy_create.php",
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
            $('#dairy_popup').hide();
            $('#mask').hide();
            display_dairys()
        });
    })

    function display_dairys(callback) {
        $.ajax({
            url: "dairys_get.php",
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

    display_dairys()

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

    // a23
    function grid_layout(data){
        var today = new Date()

        var tomorrow = new Date(today)
        tomorrow.setDate( tomorrow.getDate() + 1)

        var olddate = new Date()
        // olddate.setDate( olddate.getDate() - 2)
        olddate.setMonth( olddate.getMonth() - 1 )

        // find oldest date
        // if date is not older than a month - latest day is a month ago
        data.forEach(function(v){
            if(v.date < get_date(olddate)) {
                olddate = new Date(v.date)
            }
        })
        
        var html = ""

        var d = new Date(today)

        while(get_date(d) > get_date(olddate)){

            // start month
            html += "<h3>" + str_month(d.getMonth()) + " " + d.getFullYear() + "</h3>"

            html += "<div class='table_parent'><table class='data table' ><tr><th>Sun</th><th>Mon</th><th>Tue</th><th>Wed</th><th>Thu</th><th>Fri</th><th>Sat</th></tr>"

            // start
            html += "<tr>"

            var d2 = new Date(d)
            d2.setDate(1)

            if(get_date(d2) < get_date(olddate)) {
                console.log('here2')
                d2 = new Date(olddate)
            }

            console.log(d2)

            // first date OR first day of month
            var day = d2.getDay();

            for(var i = 0; i < day; i++){
                html += "<td></td>"
                // d2.setDate( d2.getDate() + 1 )
            }
            
            
            do {
                if(d2.getDay() == 0) {
                    html += "<tr>"
                }

                var exists = false;

                data.forEach(function(v){
                    console.log(v.ID)
                    if(v.date == get_date(d2)) {
                        exists = true;
                        html += "<td class='edit' id='c" + v.ID + "'>" + get_date(d2).substring(8) + "</td>"
                    }
                })

                if(!exists) {
                    html += "<td class='add' id='d" + get_date(d2) + "'>" + get_date(d2).substring(8) + "</td>"
                }

                if(d2.getDay() == 6) {
                    html += "</tr>"
                }

                d2.setDate( d2.getDate() + 1 )
            }
            while ( d2.getDate() != 1 && get_date(d2) != get_date( tomorrow ) );


            var day = d2.getDay();

            for(var i = day; i < 7; i++){
                html += "<td></td>"
            }
            
            html += "</tr>"

            // end month
            html += "</table></div>"

            
            d.setDate(1)
            d.setDate( d.getDate() - 1 )
        }

        

        // d.setDate( d.getDate() - 1 )

        // while(get_date(d) != get_date(olddate)) {
            // console.log(get_date(d))


            





            // var day = d.getDay();

            // console.log(day)

            // html += "<table>"
            // html += "<tr>"

            // html_row = ""

            // if(get_date(d) == get_date(today)) {
            //     for(var i = day + 1; i < 7; i++) {
            //         html_row = "<td></td>" + html_row
            //     }
            // }

            // // render row
            // for(var i = day; i >= 0; i--){
            //     html_row = "<td>" + get_date(d) + "</td>" + html_row
            //     d.setDate( d.getDate() - 1 )
            // }

            // html += html_row
            // html += "</tr>"
            // html += "</table>"

            // // first date OR first day of month
            // if(get_date(d) == get_date(today) /* || d.getDate() == 1 */) {

            //     var day = d.getDay();

            //     html += "<h3>" + str_month(d.getMonth()) + " " + d.getFullYear() + "</h3>"

            //     html += "<table border='1' class='data' ><tr><th>Sun</th><th>Mon</th><th>Tue</th><th>Wed</th><th>Thu</th><th>Fri</th><th>Sat</th></tr>"

            //     html += "<tr>"

            //     for(var i = 0; i < day; i++){
            //         html += "<td></td>"
            //     }
            // } else if(d.getDate() != 1 && d.getDay() == 0) {
            //     html += "<tr>"
            // }

            // // add box
            // html += "<td id='d" + get_date(d) + "' class='add'>" + get_date(d)

            // // add any calendars
            // data.forEach(function(v){
            //     if(v.date == get_date(d)) {
            //         console.log('in')
            //         html += "<div class='edit' id='c" + v.ID + "'>" + v.title + "</div>"
            //     }
            // })
            
            // // end box
            // html += "</td>"

            // // check if next date is new month - if so end month
            // var d2 = new Date(d)
            // d2.setDate( d2.getDate() + 1 )
            // if(d2.getDate() == 1){
            //     var day = d.getDay();

            //     for(var i = day + 1; i < 7; i++){
            //         html += "<td></td>"
            //     }

            //     html += "</tr></table>"
            // }

            // // if day is 6 reset row
            // if(d.getDay() === 6) {
            //     html += "</tr>"
            // }
        // }

        $('#data').html(html);
    }

    // function tablehtml(v){
    //     return '<tr><td>'+v.ID+'</td><td>'+v.name+'</td><td>'+v.email+'</td><td>'+v.mobile+'</td><td style="background-color: green" class="edit">EDIT</td><td style="background-color: red" class="delete">DELETE</td></tr>';
    // }

    $('body').on('click', '.edit', function(){

        edit_id = $(this).attr('id').substring(1)
        console.log(edit_id)

        getDairy();
    })

    $('body').on('touchend', '.edit', function(){
        
        edit_id = $(this).attr('id').substring(1)
        console.log(edit_id)

        getDairy();
    })

    function getDairy() {
        $.ajax({
            url: "dairy_get.php",
            type: 'get',
            dataType: 'json',
            data: {
                id: edit_id
            }
          })
        .done(function( data ) {
            console.log(data)

            $('#dairy_popup').show();
            $('#mask').show();

            $('#save_edit').hide();
            $('#submit').hide();
            $('#delete').hide();
            $('#save_edit').show();
            $('#delete').show();

            edit_date = data.date
            $('#title').val(data.title)
            $('#description').val(data.description)
        });
    }

    $('body').on('click', '#delete', function(){

        $.ajax({
            url: "dairy_delete.php",
            type: 'get',
            dataType: 'json',
            data: {
                id: edit_id
            }
          })
        .done(function( data ) {
            display_dairys()
            $('#dairy_popup').hide();
            $('#mask').hide();
        });
    })

    $('#save_edit').click(function(){

        var title = $('#title').val();
        var description = $('#description').val();

        $.ajax({
            url: "dairy_edit.php",
            type: 'get',
            dataType: 'json',
            data: {
                id: edit_id,
                date: edit_date,
                title: title,
                description: description
            }
          })
        .done(function( data ) {
            $('#dairy_popup').hide();
            $('#mask').hide();
            display_dairys()
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