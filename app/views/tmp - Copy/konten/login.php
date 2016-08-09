<!DOCTYPE html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]> <html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]> <html class="lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title><?php echo $title;?></title>
  <link rel="stylesheet" href="<?php echo $this->uri->baseUri.TMP;?>css/login.css">
  <!--[if lt IE 9]><script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
</head>
<body>
  <form action="<?php echo $this->uri->baseUri.'login/pro_login';?>" method='POST' autocomplete='off' class="login">
    <h1>Login</h1>
	<?php if (isset($pesan)){echo $pesan;}?>
    <input type="text" name="username" class="login-input" placeholder="Username" autofocus>
    <input type="password" name="password" class="login-input" placeholder="Password">
    <input type="submit" value="Login" class="login-submit">
    <a class="login-submit" href="<?php echo $this->uri->baseUri.'pinjaman';?>"> View Pinjaman</a>
	<!--
    <a class="login-submit" href="<?php echo $this->uri->baseUri.'cicilan';?>"> View Cicilan</a>
	-->
	<!--
    <p class="login-help"><a href="index.html">Forgot password?</a></p>-->
  </form>

  <section class="about"><!--
    <p class="about-links">
      <a href="http://www.sanca.web.id" target="_parent">Sancaweb</a>
      <a href="http://www.cssflow.com/snippets/facebook-login-form.zip" target="_parent">Download</a>
    </p>-->
    <p class="about-author">
      &copy; 2014 <a href="http://thibaut.me" target="_blank">Sancaweb Development</a><br />
      Web Base Application Developer nya
    </p>
  </section>
</body>
</html>
