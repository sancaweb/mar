<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Mariumroh || Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="shortcut icon" href="<?php echo $this->uri->baseUri;?>favi.png" title="Favicon" />	
	<!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?php echo $this->uri->baseUri.STYLE;?>css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo $this->uri->baseUri.STYLE;?>css/login.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo $this->uri->baseUri.STYLE;?>plugins/iCheck/square/blue.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>	
  <body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">
        <a href="<?php echo $this->uri->baseUri;?>"><b>Mariumroh</b>.com</a>
      </div><!-- /.login-logo -->
	  <?php
		if(isset($alert)){
			echo $alert;
		}
	  ?>
      <div class="login-box-body">
        <p class="login-box-msg">
        <?php
			if(isset($page)){
				if($page=='register'){
					//registerpage
					?>
					
					<form action="<?php echo $this->uri->baseUri;?>index.php/login/pro_register" method="post">
			<?php
				if(isset($no_voucher)){
					?>					
            <input name="no_voucher" type="hidden" class="form-control" value="<?php echo $no_voucher;?>" />
					<?php
				}else{
					?>
					
            <input name="no_voucher" type="hidden" class="form-control" value=""/>
					<?php
				}
			?>
			
          <div class="form-group has-feedback">
            <input name="nama" type="text" class="form-control" placeholder="Nama Lengkap">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input name="username" type="text" class="form-control" placeholder="Username">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input name="password" type="password" class="form-control" placeholder="Password">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-8">
              
				<button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
			</div><!-- /.col -->
            <div class="col-xs-4">
              <a href="<?php echo $this->uri->baseUri;?>" class="btn btn-primary btn-block btn-flat">Cancel</a>
            </div><!-- /.col -->
          </div>
        </form>
					<?php
					
				}else{
					//loginpage
					?>
					<form action="<?php echo $this->uri->baseUri;?>index.php/login/pro_login" method="post">
					<?php
						if(isset($no_voucher)){
							?>					
					<input name="no_voucher" type="hidden" class="form-control" value="<?php echo $no_voucher;?>" />
							<?php
						}else{
							?>
							
					<input name="no_voucher" type="hidden" class="form-control" value=""/>
							<?php
						}
					?>
					
				  <div class="form-group has-feedback">
					<input name="username" type="text" class="form-control" placeholder="Username">
					<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
				  </div>
				  <div class="form-group has-feedback">
					<input name="password" type="password" class="form-control" placeholder="Password">
					<span class="glyphicon glyphicon-lock form-control-feedback"></span>
				  </div>
				  <div class="row">
            <div class="col-xs-8">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
            </div><!-- /.col -->
					<div class="col-xs-4">
					  <a href="<?php echo $this->uri->baseUri;?>" class="btn btn-primary btn-block btn-flat">Cancel</a>
					</div><!-- /.col -->
				  </div>
				</form>
					
					<?php
				}
			}
		?>
		
		
		
	<!--
        <div class="social-auth-links text-center">
          <p>- OR -</p>
          <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using Facebook</a>
          <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using Google+</a>
        </div><!-- /.social-auth-links -->
<!--
        <a href="#">I forgot my password</a><br>
        <a href="register.html" class="text-center">Register a new membership</a>
-->
      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <!-- jQuery 2.1.4 -->
    <script src="<?php echo $this->uri->baseUri.STYLE;?>/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="<?php echo $this->uri->baseUri.STYLE;?>/js/bootstrap.js"></script>
    <!-- iCheck -->
    <script src="<?php echo $this->uri->baseUri.STYLE;?>/plugins/iCheck/icheck.min.js"></script>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>
  </body>
</html>
