<?php require_once(TEMPLATE_PATH . 'core/header.php'); ?>
<?php require_once(TEMPLATE_PATH . 'core/header.menu.php'); ?>
	<div class="container">
		<?php require_once(TEMPLATE_PATH . 'core/content.header.php'); ?>
		<section class="content">
						<!-- ## Panel Content  -->
					<div class="row">
						<div class="col-xs-12">
							<div class="box">
								<div class="box-header">
									<h3 class="box-MENUTITLE">Opvragen</h3>
								</div>
								<!-- /.box-header -->
								<div class="box-body">
									<form class="form-horizontal" id="menus" name="permissionsform" action="permissies.php?action=update&amp;id=<?php echo $_GET['id']; ?>" method="post">
										<div class="form-group">
											<label for="nummer" class="col-sm-1 control-label">Menu</label>
											<div class="col-sm-6">
												<select class="form-control" name='menuid' id="menuid" onchange='this.form.submit()'>
													<?php
													foreach($menus as $group1){
														echo '<option ' . ( $group1['MENUITEMID'] == $_POST['menuid'] ? 'selected="selected"' : '' ) . ' value=' . $group1['MENUITEMID'] . '>' . $group1['MENUTITLE'] . '</option>';
													}
													?>
												</select>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
			<?php if($_SERVER['REQUEST_METHOD'] == 'POST'){ ?>
					<div class="row">
                        <div class="col-xs-12">
			<form id="permissionsform" name="permissionsform" action="permissies.php?action=update&amp;id=<?php echo $_GET['id']; ?>" method="post" style="padding: 0"/>
                    <button class="btn btn-success" type="submit">Submit</button>
                     <a class="btn btn-danger" href="permissies.php">Cancel</a>
                    <br /><br />
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-MENUTITLE">Permissies Edit</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body">

                        
						<?php
							$menudata = array();
							foreach($menuitemdata as $key => $item){
								$menudata[$item['MENUITEMID']] = $item;
							}
							
							//proces 1 adds all items to its parents
							foreach($menuitemdata as $key => $item){
								if($item['PARENTID'] != 0){
									$menudata[$item['PARENTID']]['sub'][] = $item;
									unset($data[$key]);		
								}
							}
							
							//proces 2 adds all parents to theirs parents
							foreach($menudata as $k => $item){
								if(is_array($item['sub'])){
									foreach($item['sub'] as $l => $i){
										$menudata[$k]['sub'][$l]['sub'] = $menudata[$i['MENUITEMID']]['sub'];
										unset($menudata[$i['MENUITEMID']]);
									}
								}
							}
						?>
                        			
						<table id="sample-table" class="table"> 
							<thead> 
								<tr> 
									<th>Id</th> 
									<th>Title</th> 
									<th>Select</th> 
                                    <th>Insert</th> 
                                    <th>Update</th> 
                                    <th>Delete</th>
                                    <th>Other</th>  
								</tr> 
							</thead> 
							<tbody> 
								<?php
									foreach($menudata as $item){
										
										if($item['MENUTITLE']){
										echo '<tr> 
												<td>' . $item['MENUITEMID'] . '<input type="hidden" name="permission[' . $item['MENUITEMID'] . '][check]" id="menuitem_' . $item['MENUITEMID'] . '" value="1"/></td> 
												<td>' . $item['MENUTITLE'] . '</td> 
												<td><input type="checkbox" ' . ( getPermission($permissiondata, $_GET['id'], $item['MENUITEMID'], 'SELECT') ? 'checked="checked"' : '' ) . ' value="1" name="permission[' . $item['MENUITEMID'] . '][select]" id="select_' . $item['MENUITEMID'] . '"/></td>
												<td><input type="checkbox" ' . ( getPermission($permissiondata, $_GET['id'], $item['MENUITEMID'], 'INSERT') ? 'checked="checked"' : '' ) . ' value="1" name="permission[' . $item['MENUITEMID'] . '][insert]" id="insert_' . $item['MENUITEMID'] . '"/></td>
												<td><input type="checkbox" ' . ( getPermission($permissiondata, $_GET['id'], $item['MENUITEMID'], 'UPDATE') ? 'checked="checked"' : '' ) . ' value="1" name="permission[' . $item['MENUITEMID'] . '][update]" id="update_' . $item['MENUITEMID'] . '"/></td>
												<td><input type="checkbox" ' . ( getPermission($permissiondata, $_GET['id'], $item['MENUITEMID'], 'DELETE') ? 'checked="checked"' : '' ) . ' value="1" name="permission[' . $item['MENUITEMID'] . '][delete]" id="delete_' . $item['MENUITEMID'] . '"/></td>
												<td><input type="checkbox" ' . ( getPermission($permissiondata, $_GET['id'], $item['MENUITEMID'], 'OTHER') ? 'checked="checked"' : '' ) . ' value="1" name="permission[' . $item['MENUITEMID'] . '][other]" id="other_' . $item['MENUITEMID'] . '"/></td>
											</tr>';
										}
										
										if(is_array($item['sub'])){
											foreach($item['sub'] as $item2){
												if($item2['MENUTITLE']){
													echo '<tr> 
														<td>' . $item2['MENUITEMID'] . '<input type="hidden" name="permission[' . $item2['MENUITEMID'] . '][check]" id="menuitem_' . $item2['MENUITEMID'] . '" value="1"/></td>
														<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $item2['MENUTITLE'] . '</td> 
														<td><input type="checkbox" ' . ( getPermission($permissiondata, $_GET['id'], $item2['MENUITEMID'], 'SELECT') ? 'checked="checked"' : '' ) . ' value="1" name="permission[' . $item2['MENUITEMID'] . '][select]" id="select_' . $item2['MENUITEMID'] . '"/></td>
														<td><input type="checkbox" ' . ( getPermission($permissiondata, $_GET['id'], $item2['MENUITEMID'], 'INSERT') ? 'checked="checked"' : '' ) . ' value="1" name="permission[' . $item2['MENUITEMID'] . '][insert]" id="insert_' . $item2['MENUITEMID'] . '"/></td>
														<td><input type="checkbox" ' . ( getPermission($permissiondata, $_GET['id'], $item2['MENUITEMID'], 'UPDATE') ? 'checked="checked"' : '' ) . ' value="1" name="permission[' . $item2['MENUITEMID'] . '][update]" id="update_' . $item2['MENUITEMID'] . '"/></td>
														<td><input type="checkbox" ' . ( getPermission($permissiondata, $_GET['id'], $item2['MENUITEMID'], 'DELETE') ? 'checked="checked"' : '' ) . ' value="1" name="permission[' . $item2['MENUITEMID'] . '][delete]" id="delete_' . $item2['MENUITEMID'] . '"/></td>
														<td><input type="checkbox" ' . ( getPermission($permissiondata, $_GET['id'], $item2['MENUITEMID'], 'OTHER') ? 'checked="checked"' : '' ) . ' value="1" name="permission[' . $item2['MENUITEMID'] . '][other]" id="other_' . $item2['MENUITEMID'] . '"/></td>
													</tr>';
												}
											
												if(is_array($item2['sub'])){
													foreach($item2['sub'] as $item3){
														if($item3['MENUTITLE']){
															echo '<tr> 
															<td>' . $item3['MENUITEMID'] . '<input type="hidden" name="permission[' . $item3['MENUITEMID'] . '][check]" id="menuitem_' . $item3['MENUITEMID'] . '" value="1"/></td>
															<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $item3['MENUTITLE'] . '</td> 
															<td><input type="checkbox" ' . ( getPermission($permissiondata, $_GET['id'], $item3['MENUITEMID'], 'SELECT') ? 'checked="checked"' : '' ) . ' value="1" name="permission[' . $item3['MENUITEMID'] . '][select]" id="select_' . $item3['MENUITEMID'] . '"/></td>
															<td><input type="checkbox" ' . ( getPermission($permissiondata, $_GET['id'], $item3['MENUITEMID'], 'INSERT') ? 'checked="checked"' : '' ) . ' value="1" name="permission[' . $item3['MENUITEMID'] . '][insert]" id="insert_' . $item3['MENUITEMID'] . '"/></td>
															<td><input type="checkbox" ' . ( getPermission($permissiondata, $_GET['id'], $item3['MENUITEMID'], 'UPDATE') ? 'checked="checked"' : '' ) . ' value="1" name="permission[' . $item3['MENUITEMID'] . '][update]" id="update_' . $item3['MENUITEMID'] . '"/></td>
															<td><input type="checkbox" ' . ( getPermission($permissiondata, $_GET['id'], $item3['MENUITEMID'], 'DELETE') ? 'checked="checked"' : '' ) . ' value="1" name="permission[' . $item3['MENUITEMID'] . '][delete]" id="delete_' . $item3['MENUITEMID'] . '"/></td>
															<td><input type="checkbox" ' . ( getPermission($permissiondata, $_GET['id'], $item3['MENUITEMID'], 'OTHER') ? 'checked="checked"' : '' ) . ' value="1" name="permission[' . $item3['MENUITEMID'] . '][other]" id="other_' . $item3['MENUITEMID'] . '"/></td>
														</tr>';
														}
													}
												}
											}
										}
										
									}
								?> 
							</tbody> 
						</table> 

						</form>

					</div><!-- /.box-body -->
                            </div><!-- /.box -->
	<?php } ?>
		</section>
	</div>
<?php require_once(TEMPLATE_PATH . 'core/footer.begin.php'); ?>
<?php require_once(TEMPLATE_PATH . 'core/footer.script.php'); ?>
<?php
$inputUpdate = 'usergroups.php';
$inputDelete = 'usergroups.php';
require_once(TEMPLATE_PATH . 'js/plainTable.php'); ?>
<?php require_once(TEMPLATE_PATH . 'core/footer.end.php'); ?>