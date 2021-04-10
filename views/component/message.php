<?php if(App\App\Session::get('success')){ ?>
    <div class="alert alert-success">
        <?php echo App\App\Session::get('success')?>
        <?php App\App\Session::remove('success')?>
    </div>
<?php } ?>
<?php if(App\App\Session::get('warning')){ ?>
    <div class="alert alert-warning">
        <?php echo App\App\Session::get('warning')?>
        <?php App\App\Session::remove('warning')?>
    </div>
<?php } ?>
<?php if(App\App\Session::get('error')){ ?>
    <div class="alert alert-danger">
        <?php echo App\App\Session::get('error')?>
        <?php App\App\Session::remove('error')?>
    </div>
<?php } ?>