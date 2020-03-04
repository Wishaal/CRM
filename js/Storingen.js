function getStoringen(debiteur){
    $('#loadAlgemeen').html(loading('show'));
    $.ajax({
        type:'POST',
        url:'webservices/getCustomerFailures.php',
        dataType: "json",
        data:{cust_num:debiteur},
        success:function(data){
            if(data.status == 'ok'){
                $('#storingenScherm').html('');
                $('#storingenScherm').append(
                    $.map(data.result.list.element, function (element, index) {
                        return '<tr>' +
                            '<td>' + element.failure_nr + '</td>' +
                            '<td>' + element.customer_nr + '</td>' +
                            '<td>' + element.customer_name + '</td>' +
                            '<td>' + element.customer_address + '</td>' +
                            '<td>' + element.phone_nr + '</td>' +
                            '<td>' + element.extension_nr + '</td>' +
                            '<td>' + element.service_code + '</td>' +
                            '<td>' + element.complaint + '</td>' +
                            '<td>' + element.statusname_out + '</td>' +
                            '<td>' + element.failure_date_rec + '</td>' +
                            '<td>' + element.failure_date_res + '</td>' +
                            '</tr>';
                    }).join());
                $('#loadAlgemeen').html(loading('hide'));
            }else{
                alert("User not found...");
            }
        }
    });
}