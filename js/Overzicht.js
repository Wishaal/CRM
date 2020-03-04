function getOverzichtData(debiteur){
    $('#loadDebiteuren').html(loading('show'));
    $.ajax({
        type:'POST',
        url:'webservices/getCustomer.php',
        dataType: "json",
        data:{cust_num:debiteur},
        success:function(data){
            if(data.status == 'ok'){
                $('#debiteuren').html('');
                $('#debiteuren').append(
                    $.map(data.result.list, function (element, index) {
                        return '<tr><td>' + element.child_cust_num + '</td><td>' + element.child_cust_name + '</td><td>' + element.child_address + '</td></tr>';
                    }).join());
                $('#loadDebiteuren').html(loading('hide'));
            }else{
                alert("User not found...");
            }
        }
    });

    $('#loadStoringen').html(loading('show'));
    $.ajax({
        type:'POST',
        url:'webservices/getCustomerFailures.php',
        dataType: "json",
        data:{cust_num:debiteur},
        success:function(data){
            if(data.status == 'ok'){
                $('#storingen').html('');
                $('#storingen').append(
                    $.map(data.result.list.element, function (element, index) {
                        return '<tr><td>' + element.complaint + '</td><td>' + element.failure_date_rec + '</td><td>' + element.failure_date_res + '</td></tr>';
                    }).join());
                $('#loadStoringen').html(loading('hide'));
            }else{
                alert("User not found...");
            }
        }
    });

    $('#loadContracten').html(loading('show'));
    $.ajax({
        type:'POST',
        url:'webservices/getCustomerContracts.php',
        dataType: "json",
        data:{cust_num:debiteur},
        success:function(data){
            if(data.status == 'ok'){
                $('#contracten').html('');
                $('#contracten').append(
                    $.map(data.result.list, function (element, index) {
                        return '<tr><td>' + element.product_name + '</td><td>' + element.contract_begin + '</td><td>' + element.contract_end + '</td></tr>';
                    }).join());
                $('#loadContracten').html(loading('hide'));
            }else{
                alert("User not found...");
            }
        }
    });

    $.ajax({
        type:'POST',
        url:'webservices/getCustomerDetail.php',
        dataType: "json",
        data:{cust_num:debiteur},
        success:function(data){
            if(data.status == 'ok'){
                $('#Debiteur').text();
                $('#Debiteur').text(data.result.list.element[0].cust_num);

                $('#AccountmanagerDA').text();
                $('#AccountmanagerDA').text(data.result.list.element[0].da_account);

                $('#AccountmanagerAMCS').text();
                $('#AccountmanagerAMCS').text(data.result.list.element[0].mkt_account);

                $('#Postadres').text();
                $('#Postadres').text(data.result.list.element[0].post_address);

                $('#ZwarteLijst').text();
                $('#ZwarteLijst').text(data.result.list.element[0].blacklist);

                $('#Afsluitbaar').text();
                $('#Afsluitbaar').text(data.result.list.element[0].suspendable);

                $('#Emailadres').text();

                $('#ID').text();
                $('#ID').text(data.result.list.element[0].id_number);

                $('#Incasso').text();
                $('#Incasso').text(data.result.list.element[0].wvi);

                $('#Aktief').text();
                $('#Aktief').text(data.result.list.element[0].stat_code);

                $('#Adres2').text();
                $('#Adres2').text(data.result.list.element[0].address);


                $('#SoortDebiteur').text();
                $('#SoortDebiteur').text(data.result.list.element[0].cust_type);


            }else{
                alert("User not found...");
            }
        }
    });
}

function loading(toggle){
    var display = "";
    if(toggle == "show"){
        display = "";
    }else{
        display = "display:none";
    }
    var value = '<div style="text-align: center;' + display + '"><img src="http://telsur62a/crm/loading.gif"/></div>'
    return value;
}