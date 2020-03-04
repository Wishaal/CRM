<script>
    $(function() {
        $("#plainTable").DataTable(
            {
                "paging": false
            }
        );

        $("#plainTable2").DataTable();
        $('#mainTable').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false
        });
    });
</script>