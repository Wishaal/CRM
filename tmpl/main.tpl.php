<?php require_once(TEMPLATE_PATH . 'core/header.php'); ?>
<?php require_once(TEMPLATE_PATH . 'core/header.menu.php'); ?>

<div class="container">
    <?php require_once(TEMPLATE_PATH . 'core/content.header.php'); ?>
    <section class="content">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">CRM</a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="#">Overzicht <span class="sr-only">(current)</span></a></li>
                        <li id="Diensten"><a href="#">Diensten</a></li>
                        <li id="Aanvragen"><a href="#">Aanvragen</a></li>
                        <li id="Storingen"><a href="#">Storingen</a></li>
                        <li id="Offertes"><a href="#">Offertes</a></li>
                        <li id="AflopendeContracten"><a href="#">Aflopende Contracten</a></li>
                        <li id="Betaalgedrag"><a href="#">Betaalgedrag</a></li>
                        <li id="ContactPersoon"><a href="#">ContactPersoon</a></li>
                        <li id="ContactMoment"><a href="#">ContactMoment</a></li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
        <div class="row">
            <div class="col-md-2">DEBITEUR</div>
            <div class="col-md-6"><input class="form-control typeahead tt-query" type="text" name="zoekdebiteur" onClick="this.select();" id="zoekdebiteur" spellcheck="false" placeholder="Zoek debiteur..." autocomplete="off" /></div>
            <div class="col-md-4">Zoek op:
                <label class="radio-inline">
                    <input type="radio" id="optradio" name="optradio" checked value="1">Telefoonnummer
                </label>
                <label class="radio-inline">
                    <input type="radio" id="optradio" name="optradio" value="2">Debiteurnummer/Naam
                </label>
            </div>
        </div>
        <p></p>
        <div id="loadContent"></div>
    </section>
</div>

<?php require_once(TEMPLATE_PATH . 'core/footer.begin.php'); ?>
<script type="text/javascript" src="js/Overzicht.js"></script>
<script type="text/javascript" src="js/Diensten.js"></script>
<script type="text/javascript" src="js/Aanvragen.js"></script>
<script type="text/javascript" src="js/Storingen.js"></script>
<script type="text/javascript" src="js/Contracten.js"></script>
<script type="text/javascript" src="js/Betaalgedrag.js"></script>
<script type="text/javascript">
    var waarde;
    $("document").ready(function(){


        $(".nav li").on("click", function() {
            $(".nav li").removeClass("active");
            var menu = $(this).attr('id');
            switch (menu) {
                case 'Diensten':
                    $("#loadContent").load("content/Diensten.php", function(){
                        getDiensten(waarde[0]);
                    });

                    break;
                case 'Aanvragen':
                    $("#loadContent").load("content/Aanvragen.php", function(){
                        getAanvragen(waarde[0]);
                    });

                    break;
                case 'Storingen':
                    $("#loadContent").load("content/Storingen.php", function(){
                        getStoringen(waarde[0]);
                    });

                    break;
                case 'Offertes':
                    $("#loadContent").load("content/Offertes.php", function(){

                    });
                    break;
                case 'AflopendeContracten':
                    $("#loadContent").load("content/Contracten.php", function(){
                        getContracten(waarde[0]);
                    });

                    break;
                case 'Betaalgedrag':
                    $("#loadContent").load("content/Betaalgedrag.php", function(){
                        getBetaalgedrag(waarde[0]);
                    });

                    break;
                case 'ContactPersoon':
                    $("#loadContent").load("content/ContactPersoon.php", function(){

                    });
                    break;
                case 'ContactMoment':
                    $("#loadContent").load("content/ContactMoment.php", function(){

                    });
                    break;
                default:
                    $("#loadContent").load("content/Overzicht.php", function(){
                        getOverzichtData(waarde[0]);
                    });
            }
            $(this).addClass("active");
        });

        $("#loadContent").load("content/Overzicht.php");
    });


    $('#zoekdebiteur').typeahead({
        onSelect: function(item) {
            waarde = item.text.split("-");
            getOverzichtData(waarde[0]);
            getDiensten(waarde[0]);
            getAanvragen(waarde[0]);
            getStoringen(waarde[0]);
            getContracten(waarde[0]);
            getBetaalgedrag(waarde[0]);
        },
        ajax: {
            url: "webservices/getSearchCustomer.php",
            timeout: 500,
            triggerLength: 5,
            method: "get",
            loadingClass: null,
            preDispatch: function (query) {
                return {
                    query: query,
                    type: $("input[name='optradio']:checked").val()
                }
            },
            preProcess: null
    }
    });
</script>


<?php require_once(TEMPLATE_PATH . 'core/footer.script.php');
      require_once(TEMPLATE_PATH . 'core/footer.end.php'); ?>
