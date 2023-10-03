<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $pagtitle ?> | IP Manager</title>
    <link rel="shortcut icon" href="/img/logo.png" type="image/x-icon" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <?= $this->Html->css('Admin/adminlte.min.css?v='.date('Ymd')); ?>
    <?= $this->Html->css('Admin/font-awesome.all.min.css?v='.date('Ymd')); ?>
</head>

<body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
        <?= $this->element('navbar') ?>
        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <?= $this->Html->link(
                $this->Html->image('logo.png', ['class' => 'brand-image', 'style' => 'max-height: 16px;margin-top: 8px;']).'
                <span class="brand-text font-weight-light" style="font-size:1rem;">IP-Manager</span>'
                ,'/admin',['class' => 'brand-link', 'escape' => false]); 
            ?>
            <!-- Sidebar -->
            <?= $this->element('sidebar') ?>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <?= $this->fetch('content') ?>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
                <b>Version</b> 3.2.0
            </div>
            <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights
            reserved.
        </footer>
    </div>
    <!-- ./wrapper -->

    <?= $this->Html->script('Admin/jquery.min.js?v='.date('Ymd')) ?>
    <?= $this->Html->script('Admin/bootstrap.bundle.min.js?v='.date('Ymd')) ?>
    <?= $this->Html->script('Admin/adminlte.min.js?v='.date('Ymd')) ?>
</body>

</html>