<header class="main-header">
    <nav class="navbar navbar-static-top">
    </nav>
</header
<div class="container">
    <div class="login-box">
        <h1><p class="login-box-msg">Login</p></h1>
        <hr class="titlehr">
        <!-- /.login-logo -->
        <div class="login-box-body">


            <form action="index.php" method="post">
                <?php if(isset($error)) { echo $error['msg']; } else { echo 'Enter your credentials'; } ?>
                <div class="form-group has-feedback">
                    <input type="text" name="username" id="username" value="<?php echo $_POST['username']; ?>" required class="form-control" placeholder="Gebruikersnaam">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" id="password" name="password" class="form-control" placeholder="Wachtwoord">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row">
                    <div class="col-xs-6">

                    </div>
                    <!-- /.col -->
                    <div class="col-xs-6">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
        </div>
        <!-- /.login-box-body -->
    </div>
    <!-- /.login-box -->
</div>