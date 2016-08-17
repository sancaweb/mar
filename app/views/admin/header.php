<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $title;?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="shortcut icon" href="<?php echo $this->uri->baseUri;?>favi.png" title="Favicon" />	
	<!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?php echo $this->uri->baseUri.ADM_STYLE;?>bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="<?php echo $this->uri->baseUri.ADM_STYLE;?>plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo $this->uri->baseUri.ADM_STYLE;?>dist/css/AdminLTE.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo $this->uri->baseUri.ADM_STYLE;?>dist/css/skins/_all-skins.min.css">
	
	<!-- Bootstrap Color Picker -->
    <link href="<?php echo $this->uri->baseUri.ADM_STYLE;?>plugins/colorpicker/bootstrap-colorpicker.min.css" rel="stylesheet"/>
    
	<!-- lightbox -->
    <link href="<?php echo $this->uri->baseUri.ADM_STYLE;?>lightbox/css/lightbox.min.css" rel="stylesheet"/>
    <?php
	if($page=='inbox' || $page=='sentitems' || $page=='pesan'){
		?>
		
	<!-- dropdown ajax -->	
  <link rel="stylesheet" href="<?php echo $this->uri->baseUri.ADM_STYLE;?>dist/css/chosen.min.css">
		<?php
	}
	?>
	
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	<!-- Tinymce -->
	<?php if(isset($page)){
		if($page=='produk' || $page== 'voucher' || $page=='about' || $page=='slide' || $page=='kabar'){
			?>
			<script src='<?php echo $this->uri->baseUri.ADM_STYLE;?>tinymce/tinymce.min.js'></script>
			<!-- <script src='//cdn.tinymce.com/4/tinymce.min.js'></script> -->
			<script>
			  tinymce.init({
				  relative_urls: false,
					remove_script_host : false,
				selector: '#mytextarea,#mytextarea1,#mytextarea2',
				  theme: 'modern',
				  height:300,
				  plugins: [
					'advlist autolink lists link image charmap print preview hr anchor pagebreak',
					'searchreplace wordcount visualblocks visualchars code fullscreen',
					'insertdatetime media nonbreaking save table contextmenu directionality',
					'emoticons template paste textcolor colorpicker textpattern imagetools responsivefilemanager'
				  ],
				  toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
				  toolbar2: 'print preview media | forecolor backcolor emoticons',
				  image_advtab: true,
				  templates: [
					{ title: 'Test template 1', content: 'Test 1' },
					{ title: 'Test template 2', content: 'Test 2' }
				  ],
				  content_css: [
					'//www.tinymce.com/css/codepen.min.css'
				  ],
				  external_filemanager_path:"<?php echo $this->uri->baseUri;?>assets/filemanager/filemanager/",
					filemanager_title:"Responsive Filemanager" ,
					external_plugins: { "filemanager" : "<?php echo $this->uri->baseUri;?>assets/filemanager/filemanager/plugin.min.js"},
					
			  });
			  </script>
			  
			  
			<?php
		}
		
		if($page=='penerima_voucher' || $page=='inbox' || $page=='sentitems'){
			?>
			<!-- daterange picker -->
			<link rel="stylesheet" href="<?php echo $this->uri->baseUri.ADM_STYLE;?>/plugins/daterangepicker/daterangepicker-bs3.css">
			
			<?php
		}
		
	}//end $page?>
  </head>