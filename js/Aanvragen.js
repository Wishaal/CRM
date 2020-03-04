function getAanvragen(debiteur){
    $('#loadAlgemeen').html(loading('show'));
    $.ajax({
        type:'POST',
        url:'webservices/getCustomerRequests.php',
        dataType: "json",
        data:{cust_num:debiteur},
        success:function(data){
            if(data.status == 'ok'){
                $('#aanvragen').html('');
                $('#aanvragen').append(
                    $.map(data.result.list.element, function (element, index) {
                        return '<tr>' +
                            '<td>' + element.request_num + '</td>' +
                            '<td>' + element.services_requested + '</td>' +
                            '<td>' + element.service + '</td>' +
                            '<td>' + element.service_type + '</td>' +
                            '<td>' + element.cust_name + '</td>' +
                            '<td>' + element.cust_address + '</td>' +
                            '<td>' + element.date_c + '</td>' +
                            '<td>' + element.s_omschr + '</td>' +
                            '</tr>';
                    }).join());
                $('#loadAlgemeen').html(loading('hide'));
            }else{
                alert("User not found...");
            }
        }
    });
}