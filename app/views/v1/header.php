<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <title><?php echo $title;?></title>
        <meta name="description" content="">

        <meta name="viewport" content="width=device-width">
		<meta name="author" content="sanca.web.id">
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,800,700,600,300' rel='stylesheet' type='text/css'>
        <link rel="shortcut icon" href="<?php echo $this->uri->baseUri;?>favi.png" title="Favicon" />	
        <link rel="stylesheet" href="<?php echo $this->uri->baseUri.STYLE;?>css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo $this->uri->baseUri.STYLE;?>css/font-awesome.css">
        <link rel="stylesheet" href="<?php echo $this->uri->baseUri.STYLE;?>css/animate.css">
		
        <link rel="stylesheet" href="<?php echo $this->uri->baseUri.STYLE;?>css/templatemo_misc.css"> 
        <link rel="stylesheet" href="<?php echo $this->uri->baseUri.STYLE;?>css/templatemo_style.css">
       
		<!-- lightbox -->
		<link href="<?php echo $this->uri->baseUri.STYLE;?>lightbox/css/lightbox.min.css" rel="stylesheet"/>
		
	   
	   <script src="<?php echo $this->uri->baseUri.STYLE;?>js/vendor/modernizr-2.6.1-respond-1.1.0.min.js"></script>
    <?php if(isset($img_header)){
		$image=$img_header->image;
	}else{
		$image='blank.jpg';
	}
	?>
	<style>
	
	#templatemo_header {
		background: url(<?php echo $this->uri->baseUri;?>upload/header/<?php echo $image;?>);
		background-repeat: no-repeat;
		-webkit-background-size: cover;
		background-size: cover;
		background-position: center;
	}
	</style>
	<?php if(isset($page)){
		if($page=='inbox' || $page=='sentitems' || $page == 'contact'){
	?>
	<!-- dropdown ajax -->	
  <link rel="stylesheet" href="<?php echo $this->uri->baseUri.ADM_STYLE;?>dist/css/chosen.min.css">
  <?php
		}
	} //END ISSET $PAGE
	?>
	</head>