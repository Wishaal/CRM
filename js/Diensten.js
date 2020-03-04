function getDiensten(debiteur){
    $('#loadAlgemeen').html(loading('show'));
    $.ajax({
        type:'POST',
        url:'webservices/getCustomerServices.php',
        dataType: "json",
        data:{cust_num:debiteur},
        success:function(data){
            if(data.status == 'ok'){
                $('#diensten').html('');
                $('#diensten').append(
                    $.map(data.result.list.element, function (element, index) {
                        return '<tr><td>' + element.cust_num + '</td><td>' + element.cust_name + '</td><td>' + element.service_type + '</td><td>' + element.subscriber_num + '</td><td>' + element.service_desc + '</td><td>' + element.date_of_issue + '</td></tr>';
                    }).join());
                $('#loadAlgemeen').html(loading('hide'));
            }else{
                alert("User not found...");
            }
        }
    });
}