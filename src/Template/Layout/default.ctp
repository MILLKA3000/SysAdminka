<?php
$cakeDescription = $site_name;
?>
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
    <?= $this->Html->css('sysadmin.css') ?>
    <?= $this->Html->css('sb-admin.css') ?>
    <?= $this->Html->css('animation.css') ?>
    <?= $this->Html->css('dataTables.bootstrap.css') ?>
    <?= $this->Html->css('../font-awesome/css/font-awesome.min.css') ?>
    <?= $this->Html->script('jquery.js') ?>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
<div id="wrapper">


    <?= $this->element('navbar/header');?>

    <div id="page-wrapper">

        <div class="container-fluid">
            <?= $this->Flash->render() ?>

            <div class="row">
                <?= $this->fetch('content') ?>
            </div>
        </div>
        <footer>
        </footer>
    </div>
</div>
    <!-- jQuery -->

    <?= $this->Html->script('angular/angular.min.js') ?>
    <?= $this->Html->script('bootstrap.min.js') ?>
    <?= $this->Html->script('lightbox/lightbox.js') ?>
    <?= $this->Html->script('jquery.dataTables.min.js') ?>
    <?= $this->Html->script('dataTables.bootstrap.js') ?>
    <?= $this->Html->script('datatables-helper.js') ?>
    <script>
        $('.ui-datatable').dataTableHelper();
    </script>
</body>
</html>
