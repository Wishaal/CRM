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
					<a  href="usergroupstvg.php?action=new">
						<button class="btn btn-default btn-sm" >New</button>
					</a>
					<a class="inputUpdate" href="">
						<button disabled class="btn btn-warning btn-sm inputUpdate">Wijzigen</button>
					</a>
					<a class="inputDelete" href="">
						<button disabled class="btn btn-danger btn-sm inputDelete">DELETE</button>
					</a>

					<p>
				</div>
			</div>
			<div class="box box-default">
				<div class="box-header with-border">
					<h3 class="box-title">User Groups</h3>
				</div>
				<div class="box-body">
                        						
						<table id="noDataTable"class="table table-bordered table-striped">
							<thead> 
								<tr> 
									<th>Id</th> 
									<th>Usergroup</th>
									<th>Vergz Code</th>
									<th>Taaknaam</th>
								</tr>
							</thead> 
							<tbody> 
								<?php
									foreach($data as $item){
										$usergroups = querySelectPDO($dbh, 'SELECT * FROM usergroups where usergroups_id="'. $item['USERGROUPS_ID']. '"');
									
									echo '<tr class="clickable-row" id="'. $item['UGTID'] .'" naam="'.$item['USERGROUPS_ID'].'"> 
											<td>' . $item['UGTID'] . '</td> 
											<td>' . $item['USERGROUPS_ID'] . ' - ' . $usergroups[USERGROUPS_NAME]. '</td> 
											<td>' . $item['VERGZ_CODE'] . '</td>
											<td>' . $item['TAAKNAAM'] . '</td>
										</tr>';
										
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
$inputUpdate = 'usergroupstvg.php';
$inputDelete = 'usergroupstvg.php';
require_once(TEMPLATE_PATH . 'js/noDataTable.php'); ?>
<?php require_once(TEMPLATE_PATH . 'core/footer.end.php'); ?>
