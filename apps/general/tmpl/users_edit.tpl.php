<?php require_once(TEMPLATE_PATH . 'core/header.php'); ?>
<?php require_once(TEMPLATE_PATH . 'core/header.menu.php'); ?>
	<div class="container">
		<?php require_once(TEMPLATE_PATH . 'core/content.header.php'); ?>
		<section class="content">
			<div id="showinfo" class="alert alert-danger" style="display:none;">
				<i class="fa fa-ban"></i>
				<b>Alert!</b> <div id="wijzigVerwijder"></div>
			</div>
			<div class="box box-default">
				<div class="box-header with-border">
					<h3 class="box-title">Edit User</h3>
				</div>
				<div class="box-body">
						 <form  action="unix-users.php?action=update&id=<?php echo $_GET['id']; ?>" onsubmit="return validateForm()" method="post">
						 <!-- ## Panel Content  -->
						<div class="row">
                        <div class="col-xs-12">
							<div class="row">   
							<div class="col-md-6">
                            <div class="box box-danger">
                                <div class="box-body">   
										<div class="form-group">
											<label for="username">Username</label>
											<input type="text" class="form-control" readonly id="name" name="name" value="<?php echo $data['SYSUSER']; ?>">
											<input type="hidden" class="form-control" id="username" name="username" value="<?php echo $data['SYSID']; ?>">
										</div>
								</div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
						
						<div class="col-md-6">
                            <div class="box box-danger">
                                <div class="box-body">
									<div class="form-group">
										<label for="usergroup">Usergroup</label>
										<select name="usergroup[]" id="usergroup" required class="form-control" multiple="multiple" size="5">
										<?php
										foreach($usergroups as $group){
											$sel = '';
											if(in_array($group['USERGROUPS_ID'], $selectedgroupsArr)){
												$sel = 'selected="selected"';
											}
											echo '<option ' . $sel . ' value=' . $group['USERGROUPS_ID'] . '>' . $group['USERGROUPS_NAME'] . '</option>';
										}
										?>
										</select>
									</div>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
						</div> 
						<div class="form-group">
							<label>&nbsp;</label>
							<button class="btn btn-success" type="submit">Submit</button>
							 <a class="btn btn-danger" href="unix-users.php">Cancel</a>
						</div>
						
                    </div>
					</div><!-- ./wrapper -->
						</form>
				</div>
				<!-- /.box-body -->
			</div>
			<!-- /.box -->
		</section>
	</div>
<?php require_once(TEMPLATE_PATH . 'core/footer.begin.php'); ?>
<?php require_once(TEMPLATE_PATH . 'core/footer.script.php'); ?>
<?php
$inputUpdate = 'usergroups.php';
$inputDelete = 'usergroups.php';
require_once(TEMPLATE_PATH . 'js/plainTable.php'); ?>
<?php require_once(TEMPLATE_PATH . 'core/footer.end.php'); ?>