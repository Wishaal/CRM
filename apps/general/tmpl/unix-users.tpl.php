<?php require_once(TEMPLATE_PATH . 'core/header.php'); ?>
<?php require_once(TEMPLATE_PATH . 'core/header.menu.php'); ?>

<div class="container">
    <section class="content-header">
        <h1>
            Administratie
            <small>Informix Unix users</small>
        </h1>
        <?php require_once(TEMPLATE_PATH . 'core/breadcrumb.tpl.php'); ?>
    </section>
    <section class="content">
        <div id="showinfo" class="alert alert-danger" style="display:none;">
            <i class="fa fa-ban"></i>
            <b>Alert!</b> <div id="wijzigVerwijder"></div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <a  href="unix-users.php?action=new">
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
                <h3 class="box-title">User's</h3>
            </div>
            <div class="box-body">
                <table id="plainTable" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>Username</th>
                        <th>Sysyid</th>
                        <th>Usergroups</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach($data as $item){

                            echo '<tr class="clickable-row" id="'. $item['SYSID'] .'" naam="'.$item['SYSUSER'].'">
												<td>' . $item['SYSUSER'] . '</td>
												<td>' . $item['SYSID'] . '</td>
												<td>' . getUsergroups($item['SYSID']) . '</td>
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
$inputUpdate = 'unix-users.php';
$inputDelete = 'unix-users.php';
require_once(TEMPLATE_PATH . 'js/plainTable.php'); ?>
<?php require_once(TEMPLATE_PATH . 'core/footer.end.php'); ?>
