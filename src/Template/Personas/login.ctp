<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Bootstrap Admin Theme</title>

    <!-- Bootstrap Core CSS -->
    <?php echo $this->Html->css('bootstrap/css/bootstrap.min.css'); ?>
    <!--<link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">-->

    <!-- MetisMenu CSS -->
    <?php echo $this->Html->css('metisMenu/metisMenu.min.css'); ?>
    <!--<link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet"> -->

    <!-- Custom CSS -->
    <?php echo $this->Html->css('sb-admin-2.css'); ?>
    <!--<link href="../dist/css/sb-admin-2.css" rel="stylesheet">-->

    <!-- Morris Charts CSS -->
    <?php echo $this->Html->css('morrisjs/morris.css'); ?>
    <!--<link href="../vendor/morrisjs/morris.css" rel="stylesheet">-->

    <!-- Custom Fonts -->
    <?php echo $this->Html->css('font-awesome/css/font-awesome.min.css'); ?>
    <!--<link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">-->

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In</h3>
                    </div>
                    <div class="panel-body">
			<?= $this->Flash->render('auth') ?>
			<?= $this->Form->create() ?>
                        <!--<form role="form">-->
                            <fieldset>
                                <div class="form-group">
				    <?= $this->Form->input('email', ['class'=>'form-control', 'placeholder'=>'E-mail' , 'name'=>'email' , 'type'=>'email', 'autofocus'] ) ?>
                                    <!--<input class="form-control" ="" name="" type="email" autofocus>-->
                                </div>
                                <div class="form-group">
				    <?= $this->Form->input('password', ['class'=>'form-control', 'placeholder'=>'Password', 'name'=>'password','type'=>'password', 'value'=>'']) ?>
                                    <!--<input ="" ="" ="" type="" value="">-->
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <!--<input name="remember" type="checkbox" value="Remember Me">Remember Me-->
                                    </label>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <?= $this->Form->button(__('Login',['class'=>'btn btn-lg btn-success btn-block'])); ?>
                                <!--<a href="index.html" class="">Login</a>-->
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <?php echo $this->Html->script('jquery/jquery.min.js'); ?>
    <!--<script src="../vendor/jquery/jquery.min.js"></script>-->

    <!-- Bootstrap Core JavaScript -->
    <?php echo $this->Html->script('bootstrap/js/bootstrap.min.js'); ?>
    <!--<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>-->

    <!-- Metis Menu Plugin JavaScript -->
    <?php echo $this->Html->script('metisMenu/metisMenu.min.js'); ?>
    <!--<script src="../vendor/metisMenu/metisMenu.min.js"></script>-->

    <!-- Morris Charts JavaScript -->
    <?php echo $this->Html->script('raphael/raphael.min.js'); ?>
    <!--<script src="../vendor/raphael/raphael.min.js"></script>-->
    
    <?php echo $this->Html->script('morrisjs/morris.min.js'); ?>
    <!--<script src="../vendor/morrisjs/morris.min.js"></script>-->
    
    <?php echo $this->Html->script('morris-data.js'); ?>
    <!--<script src="../data/morris-data.js"></script>-->

    <!-- Custom Theme JavaScript -->
    <?php echo $this->Html->script('sb-admin-2.js'); ?>
    <!--<script src="../dist/js/sb-admin-2.js"></script>-->

</body>

</html>