function getContracten(debiteur){
    $('#loadAlgemeen').html(loading('show'));
    $.ajax({
        type:'POST',
        url:'webservices/getCustomerContracts.php',
        dataType: "json",
        data:{cust_num:debiteur},
        success:function(data){
            if(data.status == 'ok'){
                $('#contractenScherm').html('');
                $('#contractenScherm').append(
                    $.map(data.result.list, function (element, index) {
                        return '<tr>' +
                            '<td>' + element.customer_nr + '</td>' +
                            '<td>' + element.customer_naam + '</td>' +
                            '<td>' + element.product_code + '</td>' +
                            '<td>' + element.phone_nr + '</td>' +
                            '<td>' + element.product_type + '</td>' +
                            '<td>' + element.product_name + '</td>' +
                            '<td>' + element.contract_begin + '</td>' +
                            '<td>' + element.contract_end + '</td>' +
                            '<td>' + element.contract_days + '</td>' +
                            '</tr>';
                    }).join());
                $('#loadAlgemeen').html(loading('hide'));
            }else{
                alert("User not found...");
            }
        }
    });
}