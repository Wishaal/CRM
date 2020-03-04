function getBetaalgedrag(debiteur){
    $('#loadAlgemeen').html(loading('show'));
    $.ajax({
        type:'POST',
        url:'webservices/getCustomerInvoices.php',
        dataType: "json",
        data:{cust_num:debiteur},
        success:function(data){
            if(data.status == 'ok'){
                $('#betaalgedragScherm').html('');
                $('#betaalgedragScherm').append(
                    $.map(data.result.list.element, function (element, index) {
                        return '<tr>' +
                            '<td>' + element.child_customer_num + '</td>' +
                            '<td>' + element.child_customer_name + '</td>' +
                            '<td>' + element.invoice_num + '</td>' +
                            '<td>' + element.invoice_period + '</td>' +
                            '<td>' + element.invoice_date + '</td>' +
                            '<td>' + element.payment_date + '</td>' +
                            '<td>' + element.payment_days + '</td>' +
                            '</tr>';
                    }).join());
                $('#loadAlgemeen').html(loading('hide'));
            }else{
                alert("User not found...");
            }
        }
    });
}