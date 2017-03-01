<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Kick</title>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->


    <!-- Bootstrap Core CSS -->
    <?php echo $this->Html->css('bootstrap/css/bootstrap.min.css'); ?>

    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">

    <!-- Theme style -->
    <?php echo $this->Html->css('dist/css/AdminLTE.min.css'); ?>
    <?php echo $this->Html->css('dist/css/skins/skin-blue.css'); ?>
    <?php echo $this->Html->css('plugins/iCheck/square/blue.css'); ?>
    <?php echo $this->Html->css('register.css'); ?>
    <?php echo $this->Html->css('custom.css'); ?>


      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <!--[endif]-->
          <style>
          .login-page, .register-page {
              background: #fafafa;
          }
          h4 {
            color:#fff;
          }
          .login-logo a, a {
            color:#d81b60
          }
          a:hover {
            color:#ad0c47
          }
          .login-box-body{
            background: #525556;
          }
          p {
            color: #fff
          }
      </style>
</head>

<body class="hold-transition login-page">
    <div class="wrapper">
        <div id="page-wrapper">

            <div class="container-fluid">

             <?php echo $this->fetch('content'); ?>

            </div>
            </div>
            </div>



    <!-- Bootstrap Core JavaScript -->
    <?php echo $this->Html->script('plugins/jQuery/jquery-2.2.3.min.js'); ?>
    <?php echo $this->Html->script('register.js'); ?>
    <?php echo $this->Html->script('bootstrap/js/bootstrap.min.js'); ?>
    <?php echo $this->Html->script('plugins/iCheck/icheck.min.js'); ?>

<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
  </script>
</html>
</body>
</html>