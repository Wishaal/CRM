<script type="text/javascript">
    $(document).ready(function () {
        $('#plainTable2 tr').click(function (event) {

            $(this).addClass('active').siblings().removeClass('active');

            $('.inputUpdate2').prop("disabled", false); // Element(s) are now enabled.
            $('.inputUpdate2').attr('href', "<?php echo $inputUpdate;?>?action=update&id=" + $(this).attr('id'));

            $('.inputDelete2').prop("disabled", false); // Element(s) are now enabled.
            $('.inputDelete2').attr('href', "<?php echo $inputDelete;?>?action=delete&id=" + $(this).attr('id'));

            $('#wijzigVerwijder2').empty();
            $('#wijzigVerwijder2').append('U heeft "'+ $(this).attr('naam') + '"geselecteerd, u kunt nu wijzigen of verwijderen!');
            $("#showinfo").show();

        });
        $('#plainTable2').on('click', '.clickable-row', function (event) {

            $(this).addClass('active').siblings().removeClass('active');
        });
    });
</script>
