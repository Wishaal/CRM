<?php require_once(TEMPLATE_PATH . 'core/header.php'); ?>
<?php require_once(TEMPLATE_PATH . 'core/header.menu.php'); ?>
<?php
$sql = "select count(ou_username) a, to_char(extend (ou_date, hour to hour),'%H') uur FROM telesur:ba_online_users
			group by 2";
$result = $dbh->query($sql);
//$rows = $result->fetch(PDO::FETCH_NUM);
$data = array();
// Parse returned data, and displays them
while($row = $result->fetch(PDO::FETCH_ASSOC)) {
    $data[] = $row;
}
?>

<div class="container">
    <?php require_once(TEMPLATE_PATH . 'core/content.header.php'); ?>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">

                    <div class="box-body">
                        <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Table -->
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <!-- tools box -->
                        <div class="pull-right box-tools">
                            <button class="btn btn-primary btn-sm pull-right" data-widget="collapse" data-toggle="tooltip" title="" style="margin-right: 5px;" data-original-title="Collapse"><i class="fa fa-minus"></i></button>
                        </div><!-- /. tools -->
                        <i class="fa fa-map-marker"></i>
                        <h3 class="box-title">
                            Users Online
                        </h3>
                    </div>
                    <div class="box-body table">
                        <div class="row">
                            <div class="col-xs-12">
                                <table class="table table-bordered table-striped dataTable" id="mainTable">
                                    <thead>
                                    <tr>
                                        <th>Username</th>
                                        <th>IP Adress</th>
                                        <th>Activity</th>
                                        <th>Last Seen at</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <!-- table data -->
                                    <?php
                                    $dataonlineusers = "SELECT * FROM ba_online_users";
                                    $result_onlineusers = $dbh->query($dataonlineusers);
                                    $rows = $result_onlineusers->fetchAll();
                                    foreach($rows as $r) {
                                        echo ' <tr>
															  <td>'.$r['OU_USERNAME'].'</td>
															  <td>'.$r['LU_IP_ADDRESS'].'</td>
															  <td>'.$r['OU_ACTIVITY'].'</td>
															  <td>'.$r['OU_DATE'].'</td>
															</tr>';
                                        //$i++;
                                    }
                                    ?>
                                    </tbody>
                                </table>
                                <!-- Modal -->
                                <div class="modal fade" id="remoteModal" tabindex="-1" role="dialog" aria-labelledby="remoteModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content"></div>
                                    </div>
                                </div>
                            </div><!-- /.box-body-->
                        </div>
                    </div>
                </div><!-- /.box -->
            </div>
        </div>
    </section><!-- /.content -->
</div>


<?php require_once(TEMPLATE_PATH . 'core/footer.begin.php'); ?>
<script type="text/javascript">
    var x_labels = [<?php foreach($data as $item){	echo $item['UUR'].","; 	} ?>]
    $(function () {
        $('#container').highcharts({
            chart: {
                type: 'spline'

            },
            title: {
                text: 'Users online per hour'
            },
            xAxis: {
                title: {
                    text: 'DATUM <?php echo date("Y-m-d");  ?>'
                },
                labels: {
                    formatter: function() {
                        return x_labels[this.value];
                    }
                },
                showLastLabel: true,
            },credits: {
                enabled: false
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Totaal'
                }
            },
            tooltip: {
                crosshairs: true,
                shared: true
            },
            plotOptions: {
                spline: {
                    marker: {
                        radius: 4,
                        lineColor: '#666666',
                        lineWidth: 1
                    }
                }
            },
            series: [{
                marker: {
                    symbol: 'square'
                },
                name: 'Logins',
                //color: '#2C6700',
                data: [<?php foreach($data as $item){	echo $item['A'].","; 	} ?>]
            }]
        });
    });
</script>
<?php require_once(TEMPLATE_PATH . 'core/footer.end.php'); ?>
