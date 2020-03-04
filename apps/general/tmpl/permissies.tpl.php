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
					<h3 class="box-title">Permissies</h3>
				</div>
				<div class="box-body">
                        						
						<table id="noDataTable" class="table table-bordered table-striped">
							<thead> 
								<tr> 
									<th width="50">Id</th> 
									<th>Name</th>
									<th>Description</th>
								</tr>
							</thead> 
							<tbody> 
								<?php
									foreach($data as $item){
									
									echo '<tr class="clickable-row" id="'. $item['USERGROUPS_ID'] .'" naam="'.$item['USERGROUPS_NAME'].'"> 
											<td>' . $item['USERGROUPS_ID'] . '</td> 
											<td>' . $item['USERGROUPS_NAME'] . '</td> 
											<td>' . $item['USERGROUPS_DESCRIPTION'] . '</td>
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
$inputUpdate = 'permissies.php';
$inputDelete = 'permissies.php';
require_once(TEMPLATE_PATH . 'js/noDataTable.php'); ?>
<?php require_once(TEMPLATE_PATH . 'core/footer.end.php'); ?>
