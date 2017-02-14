<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Kick</title>

    <!-- Bootstrap Core CSS -->
    <?php echo $this->Html->css('bootstrap/css/bootstrap.min.css'); ?>

    <!-- MetisMenu CSS -->
    <?php echo $this->Html->css('metisMenu/metisMenu.min.css'); ?>

    <!-- Custom CSS -->
  <!--  <?php echo $this->Html->css('sb-admin-2.css'); ?>-->

    <!-- Morris Charts CSS -->
     <?php echo $this->Html->css('plugins/morris/morris.css'); ?>

    <!-- Custom Fonts -->
    <?php echo $this->Html->css('font-awesome/css/font-awesome.min.css'); ?>
    <!--<link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">-->

    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">

    <!-- Theme style -->
    <?php echo $this->Html->css('dist/css/AdminLTE.min.css'); ?>
    <?php echo $this->Html->css('dist/css/skins/skin-blue.css'); ?>
    <?php echo $this->Html->css('plugins/iCheck/flat/blue.css'); ?>
    <?php echo $this->Html->css('plugins/jvectormap/jquery-jvectormap-1.2.2.css'); ?>
    <?php echo $this->Html->css('plugins/datatables/dataTables.bootstrap.css'); ?>
    <?php echo $this->Html->css('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css'); ?>
    <?php echo $this->Html->css('plugins/datepicker/datepicker3.css'); ?>
    <?php echo $this->Html->css('plugins/daterangepicker/daterangepicker.css'); ?>
    <?php echo $this->Html->css('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css'); ?>

      <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
      <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
      <!--[if lt IE 9]-->
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <!--[endif]-->
</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
          <header id="header" class="main-header">
            <?= $this->element('navegation_bar') ?>
          </header>
          <aside id="sidebar" class="main-sidebar">
            <?= $this->element('side_menu') ?>
          </aside>
          <div class="content-wrapper">


        <div id="page-wrapper">

            <div class="container-fluid">

             <?php echo $this->fetch('content'); ?>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
    <?php echo $this->Html->script('plugins/jQuery/jquery-2.2.3.min.js'); ?>

    <!-- jQuery -->
    <?php echo $this->Html->script('jquery/jquery.min.js'); ?>
    <!--<script src="../vendor/jquery/jquery.min.js"></script>-->
    <!-- jQuery UI 1.11.4 -->
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <?php echo $this->Html->script('bootstrap/js/bootstrap.min.js'); ?>
    <!--<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>-->

    <!-- Metis Menu Plugin JavaScript -->
    <?php echo $this->Html->script('metisMenu/metisMenu.min.js'); ?>
    <!--<script src="../vendor/metisMenu/metisMenu.min.js"></script>-->

    <!-- Morris Charts JavaScript -->
    <?php echo $this->Html->script('raphael/raphael.min.js'); ?>
    <!--<script src="../vendor/raphael/raphael.min.js"></script>-->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <?php echo $this->Html->script('plugins/morris/morris.min.js'); ?>
    <!--<script src="../vendor/morrisjs/morris.min.js"></script>-->

    <?php echo $this->Html->script('morris-data.js'); ?>
    <!--<script src="../data/morris-data.js"></script>-->
    <?php echo $this->Html->css('custom.css'); ?>

    <!-- Custom Theme JavaScript -->
    <?php echo $this->Html->script('sb-admin-2.js'); ?>
    <!--<script src="../dist/js/sb-admin-2.js"></script>-->


    <!-- Sparkline -->
    <?php echo $this->Html->script('plugins/sparkline/jquery.sparkline.min.js'); ?>
    <!-- jvectormap -->
    <?php echo $this->Html->script('plugins/jvectormap/jquery-jvectormap-1.2.2.min.js'); ?>
    <?php echo $this->Html->script('plugins/jvectormap/jquery-jvectormap-world-mill-en.js'); ?>
    <!-- jQuery Knob Chart -->
    <?php echo $this->Html->script('plugins/knob/jquery.knob.js'); ?>

    <!-- daterangepicker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
    <?php echo $this->Html->script('plugins/daterangepicker/daterangepicker.js'); ?>
    <!-- datepicker -->
    <?php echo $this->Html->script('plugins/datepicker/bootstrap-datepicker.js'); ?>
    <!-- Bootstrap WYSIHTML5 -->
    <?php echo $this->Html->script('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js'); ?>
    <!-- Slimscroll -->
    <?php echo $this->Html->script('plugins/slimScroll/jquery.slimscroll.min.js'); ?>
    <!-- FastClick -->
    <?php echo $this->Html->script('plugins/fastclick/fastclick.js'); ?>
    <!-- AdminLTE App -->
    <?php echo $this->Html->script('dist/js/app.min.js'); ?>
    <?php echo $this->Html->script('plugins/datatables/jquery.dataTables.min.js'); ?>
    <?php echo $this->Html->script('plugins/datatables/dataTables.bootstrap.min.js'); ?>
</body>

</html>
