<?php $this->output('admin/header');?>
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

      <?php $this->output('admin/head');?>
      <!-- Left side column. contains the logo and sidebar -->
      <?php $this->output('admin/sidebar');?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
	  <section class="content">
        <?php $this->output($konten);?>
		</section>
      </div><!-- /.content-wrapper -->

      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 2.3.0
        </div>
        <strong>Copyright &copy; 2014-2015 <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.</strong> All rights reserved.
      </footer>
	<?php $this->output('admin/control_side');?>

    </div><!-- ./wrapper -->
<?php echo $this->output('admin/footer');?>
