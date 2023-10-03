<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | IP Manager</title>
    <link rel="shortcut icon" href="/img/favcon.png" type="image/x-icon" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <?= $this->Html->css('Admin/adminlte.min.css?v='.date('Ymd')); ?>
    <?= $this->Html->css('Admin/font-awesome.all.min.css?v='.date('Ymd')); ?>
</head>
<body class="hold-transition login-page">
    <div class="login-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="../../index2.html" class="h1"><b>Login</b> - IP Manager</a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Logue para iniciar sua sessão</p>
                <?= $this->Form->create(); ?>
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" name="email" placeholder="E-mail">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" name="password" placeholder="Senha">
                        <div class="input-group-append">
                            <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- /.col -->
                        <div class="offset-8 col-4">
                            <button type="submit" class="btn btn-primary btn-block">Logar</button>
                        </div>
                    <!-- /.col -->
                    </div>
                <?= $this->Form->end() ?>
                <p class="mb-1">
                    <a href="forgot-password.html">Esqueci minha senha</a>
                </p>
            </div>
            <!-- /.card-body -->
        </div>
    <!-- /.card -->
    </div>
    <?= $this->Html->script('Admin/bootstrap.bundle.min.js?v='.date('Ymd')) ?>
    <?= $this->Html->script('Admin/jquery.min.js?v='.date('Ymd')) ?>
    <?= $this->Html->script('Admin/adminlte.min.js?v='.date('Ymd')) ?>
</body>
</html>
