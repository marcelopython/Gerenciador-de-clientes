<?php if(\Kabum\App\Session::get('success')){ ?>
    <div class="alert alert-success">
        <?php echo \Kabum\App\Session::get('success')?>
        <?php \Kabum\App\Session::remove('success')?>
    </div>
<?php } ?>
<?php if(\Kabum\App\Session::get('warning')){ ?>
    <div class="alert alert-warning">
        <?php echo \Kabum\App\Session::get('warning')?>
        <?php \Kabum\App\Session::remove('warning')?>
    </div>
<?php } ?>
<?php if(\Kabum\App\Session::get('error')){ ?>
    <div class="alert alert-danger">
        <?php echo \Kabum\App\Session::get('error')?>
        <?php \Kabum\App\Session::remove('error')?>
    </div>
<?php } ?>