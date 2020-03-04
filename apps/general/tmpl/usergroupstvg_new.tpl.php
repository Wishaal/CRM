<?php require_once(TEMPLATE_PATH . 'core/header.php'); ?>
<?php require_once(TEMPLATE_PATH . 'core/header.menu.php'); ?>
<?php $usergroups = querySelectPDO($dbh, 'SELECT * FROM usergroups'); ?>
    <div class="container">
        <?php require_once(TEMPLATE_PATH . 'core/content.header.php'); ?>
        <section class="content">

            <div id="showinfo" class="alert alert-danger" style="display:none;">
                <i class="fa fa-ban"></i>
                <b>Alert!</b> <div id="wijzigVerwijder"></div>
            </div>
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">New User Group TVG</h3>
                </div>
                <div class="box-body">
                        <form action="usergroupstvg.php?action=new" method="post">
                            <div class="form-group">
                                <label for="usergroup">Usergroup</label>
                                <select name="usergroups_id" id="usergroups_id" required class="form-control">
                                    <?php
                                    foreach($usergroups as $group){
                                        echo '<option value=' . $group['USERGROUPS_ID'] . '>' . $group['USERGROUPS_NAME'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
								<label for="name">Vergz Code</label>
								<input type="text" id="vergz_code" class="form-control" name="vergz_code" value="">
							</div>
                            <div class="form-group">
                                <label for="name">Taaknaam</label>
                                <input type="text" id="taaknaam" class="form-control" name="taaknaam" value="">
                            </div>
                            

                            <div class="form-group">
								<label>&nbsp;</label>
								<button class="btn btn-success" type="submit">Submit</button>
								  <a class="btn btn-danger" href="usergroupstvg.php">Cancel</a>
							</div>
                            
                            
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