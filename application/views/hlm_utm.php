<html>
<head>
<?php $this->load->view('head');?>
</head>
<body>
<header>
<?php $this->load->view('header');?>
</header>
<?php $this->load->view('menu');?>
<?php
		if (isset($body))
		{
		if ($body=='master_pegawai')
		{
		$this->load->view('body_master_pegawai');
		}
		}

?>

</body>
</html>