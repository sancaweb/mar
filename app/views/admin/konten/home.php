<!-- Content Header (Page header) -->
<?php if (isset($alert)){
	echo $alert;
}?>
        <section class="content-header">
          <h1>
            Mariumroh.com
            <small>Version 1.0</small>
          </h1>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- Info boxes -->

          <!-- Main row -->
          <div class="row">
            <!-- Left col -->
            <div class="col-md-8">
			<!-- TABLE: LATEST ORDERS -->
              <?php $this->output('admin/konten/home/register');?>
			<!-- TABLE: Konfirmasi Pembayaran -->
              <?php $this->output('admin/konten/home/pembayaran');?>
			  
              <div class="row">

                <div class="col-md-6">
                  <!-- USERS LIST -->
				  <?php $this->output('admin/konten/home/member');?>
                  <!--/.box -->
                </div><!-- /.col -->
                <div class="col-md-6">
				 <!-- Kabar LIST -->
				  <?php $this->output('admin/konten/home/kabar');?>
				  <!-- /.box -->
                </div><!-- /.col -->
				
              </div><!-- /.row -->

              
            </div><!-- /.col -->

            <div class="col-md-4">
              <!-- PRODUCT LIST -->
			  <?php $this->output('admin/konten/home/penerima_voucher');?>
			  <?php $this->output('admin/konten/home/produk');?>
              <!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->