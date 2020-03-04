<div class="row">
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Debiteuren</h3>
            </div>
            <div class="box-body">

                <table class="table table-bordered table-striped">
                    <thead>
                    <th>No</th>
                    <th>Klantnaam</th>
                    <th>Adres</th>
                    </thead>
                    <tbody id="debiteuren">
                    </tbody>
                </table>
                <div id="loadDebiteuren"></div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Debiteur gegevens</h3>
            </div>
            <div class="box-body">
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>Debiteur #</th>
                        <th>Accountmanager DA</th>
                        <th>Accountmanager AMCS</th>
                    </tr>
                    <tr>
                        <td id="Debiteur"></td>
                        <td id="AccountmanagerDA"></td>
                        <td id="AccountmanagerAMCS"></td>
                    </tr>
                    <tr>
                        <th>Adres</th>
                        <th>Soort Debiteur</th>
                        <th>Aktief</th>
                    </tr>
                    <tr>
                        <td id="Adres2"></td>
                        <td id="SoortDebiteur"></td>
                        <td id="Aktief"></td>
                    </tr>
                    <tr>
                        <th>Postadres</th>
                        <th>Zwarte lijst</th>
                        <th>Afsluitbaar</th>
                    </tr>
                    <tr>
                        <td id="Postadres"></td>
                        <td id="ZwarteLijst"></td>
                        <td id="Afsluitbaar"></td>
                    </tr>
                    <tr>
                        <th>Emailadres</th>
                        <th>ID</th>
                        <th>Wijze van incasso</th>
                    </tr>
                    <tr>
                        <td id="Emailadres"></td>
                        <td id="ID"></td>
                        <td id="Incasso"></td>
                    </tr>
                </table>
                <div id="loadDebiteurGegevens"></div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Actiepunten</h3>
            </div>
            <div class="box-body">
                <table id= "mainTable" class="table table-bordered table-striped">
                    <thead>
                    <th>Actiepunt</th>
                    <th>Status</th>
                    <th>Medewerker</th>
                    <th>Datum</th>
                    </thead>
                    <tbody>
                    <tr>
                    </tr>
                    </tbody>
                </table>
                <div id="loadActiepunten"></div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Offertes</h3>
            </div>
            <div  class="box-body">
                <table id= "mainTable" class="table table-bordered table-striped">
                    <thead>
                    <th>Offerte</th>
                    <th>Datum</th>
                    </thead>
                    <tbody>
                    <tr>
                    </tr>
                    </tbody>
                </table>
                <div id="loadOffertes"></div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div  id= "mainTable" class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Storingen</h3>
            </div>
            <div class="box-body">
                <table class="table table-bordered table-striped">
                    <thead>
                    <th>Storing</th>
                    <th>Van</th>
                    <th>Tot</th>
                    </thead>
                    <tbody id="storingen">
                    <tr>
                    </tr>
                    </tbody>
                </table>
                <div id="loadStoringen"></div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Contracten</h3>
            </div>
            <div class="box-body">
                <table id= "mainTable" class="table table-bordered table-striped">
                    <thead>
                    <th>Contracten</th>
                    <th>Begin Datum</th>
                    <th>Eind Datum</th>
                    </thead>
                    <tbody id="contracten">
                    <tr>
                    </tr>
                    </tbody>
                </table>
                <div id="loadContracten"></div>
            </div>
        </div>
    </div>
</div>
<!-- /.box -->