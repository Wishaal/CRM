<?php require_once(TEMPLATE_PATH . 'core/header.php'); ?>
<?php require_once(TEMPLATE_PATH . 'core/header.menu.php'); ?>

<div class="container">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            General
            <small>New Menu Item</small>
        </h1>
        <?php require_once(TEMPLATE_PATH . 'core/breadcrumb.tpl.php'); ?>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- ## Panel Content  -->
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Menu's</h3>
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
                        <form action="menu-items.php?action=new&amp;id=<?php echo $_GET['id']; ?>" method="post">

                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" id="MENUTITLE" class="form-control" name="MENUTITLE" value="">
                            </div>

                            <div class="form-group">
                                <label for="link">Link</label>
                                <input type="text" id="MENULINK" class="form-control" name="MENULINK" value="">
                            </div>

                            <div class="form-group">
                                <label for="parent">Parent</label>
                                <div>
                                    <select class="form-control" id="PARENTID" name="PARENTID">
                                        <option value="0">Root</option>
                                        <?php
                                        foreach($menudata as $item){

                                            if($item['MENUTITLE']){
                                                echo '<option value="' . $item['MENUITEMID'] . '">----' . $item['MENUTITLE'] . '</option>';
                                            }

                                            if(is_array($item['sub'])){
                                                foreach($item['sub'] as $item2){
                                                    if($item2['MENUTITLE']){
                                                        echo '<option value="' . $item2['MENUITEMID'] . '">--------' . $item2['MENUTITLE'] . '</option>';
                                                    }
                                                }
                                            }

                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="active">Active</label>
                                <div>
                                    <select class="form-control" id="MENUACTIVE" name="MENUACTIVE">
                                        <option value="1">Ja</option>
                                        <option value="0">Nee</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>&nbsp;</label>
                                <button class="btn btn-success" type="submit">Submit</button>
                                <a class="btn btn-danger" href="menu-items.php">Cancel</a>
                            </div>


                        </form>

                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div>
        </div>
    </section><!-- /.content -->
</div>


<?php require_once(TEMPLATE_PATH . 'core/footer.script.php'); ?>
