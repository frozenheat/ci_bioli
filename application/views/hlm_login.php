
<html>
<head>
<?php
  $this->load->view('head');
?>

<link rel="stylesheet" href="<?php echo base_url();?>css/login.css">
<script src="<?php echo base_url();?>javascript/js-image-slider.js" type="text/Javascript"></script>

</head>


<body>
<header>
	<?php $this->load->view('header')?>
</header>

<div id="body">
<div id="wrapper_login">
<div id="left_login"><div id="slider">
	<img src="<?php echo base_url();?>image/slide/slide1.jpg">
	<img src="<?php echo base_url();?>image/slide/slide2.jpg">
	<img src="<?php echo base_url();?>image/slide/slide3.jpg">
</div>
</div>
<div id="right_login">
		<div class="loginimage"></div>
		<form name="login" method="post">
			<table cellspacing="-" cellpadding="-" width="250" border="0">
			<tr><td>User Id</td></tr>
			<tr><td><input type="text" name="username" class ="login_inp"></td></tr>
			<tr><td>Password</td></tr>
			<tr><td><input type="text" name="password" class ="login_inp"></td></tr>
			<tr align="center"><td><input type="submit" name="login" class="login_button"></td></tr>
			</table>
		</form>
</div>
</div>
</div>


<footer>
 <?php include "footer.php"; ?>
</footer>

</body>
</html>