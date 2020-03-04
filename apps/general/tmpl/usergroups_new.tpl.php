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
                    <h3 class="box-title">New User Group</h3>
                </div>
                <div class="box-body">
                        <form action="usergroups.php?action=new" method="post">
                            <div class="form-group">
								<label for="name">Name</label>
								<input type="text" id="name" class="form-control" name="name" value="">
							</div>
                            
                            <div class="form-group">
								<label for="description">Description</label>
								<textarea name="description" class="form-control" id="description"></textarea>
							</div>
                            

                            <div class="form-group">
								<label>&nbsp;</label>
								<button class="btn btn-success" type="submit">Submit</button>
								  <a class="btn btn-danger" href="usergroups.php">Cancel</a>
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