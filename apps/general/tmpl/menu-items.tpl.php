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
                <a  href="menu-items.php?action=new">
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
                <h3 class="box-title">Menu's</h3>
            </div>
            <div class="box-body">
                <?php
                $menudata = array();
                foreach($data as $key => $item){
                    $menudata[$item['MENUITEMID']] = $item;
                }

                //proces 1 adds all items to its parents
                foreach($data as $key => $item){
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
                <table id="menuTable" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Title</th>
                        <th>Link</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach($menudata as $item){

                        if($item['MENUTITLE']){
                            echo '<tr class="clickable-row" id="'. $item['MENUITEMID'] .'" naam="'.$item['MENUTITLE'].'">
												<td>' . $item['MENUITEMID'] . '</td>
												<td>' . $item['MENUTITLE'] . '</td>
												<td>' . $item['MENULINK'] . '</td>
												<td>' . ($item['MENUACTIVE'] == 1 ? 'Actief' : 'Niet actief') . '</td>

											</tr>';
                        }

                        if(is_array($item['sub'])){
                            foreach($item['sub'] as $item2){
                                if($item2['MENUTITLE']){
                                    echo '<tr class="clickable-row" id="'. $item2['MENUITEMID'] .'" naam="'.$item2['MENUTITLE'].'">
														<td>' . $item2['MENUITEMID'] . '</td>
														<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $item2['MENUTITLE'] . '</td>
														<td>' . $item2['MENULINK'] . '</td>
														<td>' . ($item2['MENUACTIVE'] == 1 ? 'Actief' : 'Niet actief') . '</td>

													</tr>';
                                }

                                if(is_array($item2['sub'])){
                                    foreach($item2['sub'] as $item3){
                                        if($item3['MENUTITLE']){
                                            echo '<tr class="clickable-row" id="'. $item3['MENUITEMID'] .'" naam="'.$item3['MENUTITLE'].'">
															<td>' . $item3['MENUITEMID'] . '</td>
															<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $item3['MENUTITLE'] . '</td>
															<td>' . $item3['MENULINK'] . '</td>
															<td>' . ($item3['MENUACTIVE'] == 1 ? 'Actief' : 'Niet actief') . '</td>

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
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </section>
</div>

<?php require_once(TEMPLATE_PATH . 'core/footer.begin.php'); ?>
<?php require_once(TEMPLATE_PATH . 'core/footer.script.php'); ?>
<?php
$inputUpdate = 'menu-items.php';
$inputDelete = 'menu-items.php';
require_once(TEMPLATE_PATH . 'js/menuTable.php'); ?>
<?php require_once(TEMPLATE_PATH . 'core/footer.end.php'); ?>
