<?php require_once(TEMPLATE_PATH . 'core/header.php'); ?>
<?php require_once(TEMPLATE_PATH . 'core/header.menu.php'); ?>

	<div class="container">
		<?php require_once(TEMPLATE_PATH . 'core/content.header.php'); ?>
		<section class="content">

			<div id="showinfo" class="alert alert-danger" style="display:none;">
				<i class="fa fa-ban"></i>
				<b>Alert!</b> <div id="wijzigVerwijder"></div>
			</div>
			<div class="row">
				<div class="col-xs-12">
					<a class="inputUpdate" href="">
						<button disabled class="btn btn-warning btn-sm inputUpdate">Wijzigen</button>
					</a>
					<p>
				</div>
			</div>
			<div class="box box-default">
				<div class="box-header with-border">
					<h3 class="box-title">User logins</h3>
				</div>
				<div class="box-body">

					<table class="table table-bordered table-striped dataTable" id="plainTable">
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
						$dataonlineusers = "SELECT * FROM log_users order by lu_date";
						$result_onlineusers = $dbh->query($dataonlineusers);
						$rows = $result_onlineusers->fetchAll();
						foreach($rows as $r) {
							echo ' <tr>
															  <td>'.$r['LU_USERNAME'].'</td>
															  <td>'.$r['LU_IP_ADDRESS'].'</td>
															  <td>'.$r['LU_ACTIVITY'].'</td>
															  <td>'.$r['LU_DATE'].'</td>
															</tr>';
							//$i++;
						}
						?>
						</tbody>
					</table>


				</div>
				<!-- /.box-body -->
			</div>
			<!-- /.box -->
		</section>
	</div>

<?php require_once(TEMPLATE_PATH . 'core/footer.begin.php'); ?>
<?php require_once(TEMPLATE_PATH . 'core/footer.script.php'); ?>
<?php
$inputUpdate = 'permissies.php';
$inputDelete = 'permissies.php';
require_once(TEMPLATE_PATH . 'js/plainTable.php'); ?>
<?php require_once(TEMPLATE_PATH . 'core/footer.end.php'); ?>
