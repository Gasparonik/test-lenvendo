$(document).ready(function () {
    var table = $('#bookmarks-list').DataTable({
        lengthChange: false,
        buttons: {
            extended: 'collection',
            text: 'Экспорт',
            buttons: ['excel', 'pdf', 'print'],
        },
    });
    table.buttons().container().prependTo('#bookmarks-list_wrapper .col-md-6:eq(0)');
});