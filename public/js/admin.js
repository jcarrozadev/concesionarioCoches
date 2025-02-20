document.addEventListener('DOMContentLoaded', function () {
    console.log('admin.js cargado...');

    const tables = document.querySelectorAll('.datatable');

    tables.forEach(table => {
        if (!table) {
            console.error('No se encontró la tabla.');
            return;
        }

        let tableDataTable = new DataTable(table, {
            language: {
                url: "https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json"
            },
            paging: true,
            searching: true,
            ordering: true,
            autoFill: true
        });

        const filterInputs = table.querySelectorAll('thead tr:nth-child(2) th input');

        filterInputs.forEach((input, index) => {
            input.addEventListener('input', function () {
                tableDataTable.column(index).search(this.value).draw();
            });
        });
    });

});
