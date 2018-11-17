$( document ).ready(function() {
    console.log( "ready!" );

    appendHeader()

    function appendHeader() {
        $('#header').append(
            '<nav class="navbar navbar-expand-lg navbar-light bg-light">' +
                '<a class="navbar-brand" href="#">Planner</a>' +
                '<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">' +
                    '<span class="navbar-toggler-icon"></span>' +
                '</button>' +
                '<div class="collapse navbar-collapse" id="navbarNav">' +
                    '<ul class="navbar-nav">' +
                        '<li class="nav-item active">' +
                            '<a class="nav-link" href="menu.php">Home <!--<span class="sr-only">(current)</span>--></a>' +
                        '</li>' +
                        '<li class="nav-item">' +
                            '<a class="nav-link" href="contacts.php">Contacts</a>' +
                        '</li>' +
                        '<li class="nav-item">' +
                            '<a class="nav-link" href="notes.php">Notes</a>' +
                        '</li>' +
                        '<li class="nav-item">' +
                            '<a class="nav-link disabled" href="dairy.php">Dairy</a>' +
                        '</li>' +
                        '<li class="nav-item">' +
                            '<a class="nav-link disabled" href="calendar.php">Calendar</a>' +
                        '</li>' +
                        '<li class="nav-item">' +
                            '<a class="nav-link disabled" href="logout.php">Logout</a>' +
                        '</li>' +
                    '</ul>' +
                '</div>' +
            '</nav>')
    }
});