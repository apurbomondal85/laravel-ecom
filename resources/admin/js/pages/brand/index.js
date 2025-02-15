
let columns = [
    {data: 'id'},
    {data: 'attachment'},
    {data: 'name'},
    {data: 'slug'},
    {data: 'status'},
    {data: 'action'}
];

let column_defs = [
    {"className": "text-center", "targets": [0, 1, 4, 5]}
];

let table = $('#dataTable').DataTable({
    order: false,
    processing: true,
    serverSide: true,
    responsive: true,
    autoWidth: false,
    ajax: {
        url: BASE_URL + "/brands",
    },
    aLengthMenu: [
        [10, 50, 100, 200, -1],
        [10, 50, 100, 200, "All"]
    ],
    columns: columns,
    dom: 'Bfrtip',
    buttons: [
        'pageLength',
        {
            text : '<i class="fas fa-download"></i> Export',
            extend: 'collection',
            className: 'custom-html-collection pull-right',
            buttons: [
                'pdf',
                'csv',
                'excel',
            ]
        },
        // { html: colVisibility('#dataTable', column_defs) },
        { html: '<a class="dt-button buttons-collection" href="'+ BASE_URL +'/brands/create"><i class="fas fa-plus"></i> Add New</a>' }
    ],
    columnDefs: column_defs,
    language: {
        searchPlaceholder: "Search records",
        search: "",
        buttons: {
            pageLength: {
                _: "%d Rows",
            }
        }
    }
});

executeColVisibility(table);

window.changeStatus = function (e, route)
{
    e.preventDefault();
    confirmFormModal(route, 'Confirmation', 'Are you sure Update Status. ');
    table.ajax.reload();
}
