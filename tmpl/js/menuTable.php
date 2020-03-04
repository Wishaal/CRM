<script type="text/javascript">
    $(document).ready(function () {
        $('#menuTable tr').click(function (event) {

            $(this).addClass('active').siblings().removeClass('active');

            $('.inputUpdate').prop("disabled", false); // Element(s) are now enabled.
            $('.inputUpdate').attr('href', "<?php echo $inputUpdate;?>?action=update&id=" + $(this).attr('id'));

            $('.inputDelete').prop("disabled", false); // Element(s) are now enabled.
            $('.inputDelete').attr('href', "<?php echo $inputDelete;?>?action=delete&id=" + $(this).attr('id'));

            $('#wijzigVerwijder').empty();
            $('#wijzigVerwijder').append('U heeft "'+ $(this).attr('naam') + '"geselecteerd, u kunt nu wijzigen of verwijderen!');
            $("#showinfo").show();

        });
        $('#menuTable').on('click', '.clickable-row', function (event) {

            $(this).addClass('active').siblings().removeClass('active');
        });
    });
</script>
