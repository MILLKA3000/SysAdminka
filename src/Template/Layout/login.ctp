<?php
    $cakeDescription = 'SysAdminka(TDMU)';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('bootstrap.css') ?>
    <?= $this->Html->css('bootstrap.min.css') ?>
    <?= $this->Html->css('sysadmin.css') ?>
    <?= $this->Html->css('../font-awesome/css/font-awesome.min.css') ?>
    <?= $this->Html->script('jquery.js') ?>
    <!-- Bootstrap Core JavaScript -->
    <?= $this->Html->script('bootstrap.min.js') ?>


    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
                <?= $this->fetch('content') ?>



</body>
</html>
