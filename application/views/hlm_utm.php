<html>
<head>
<?php $this->load->view('head');?>

</head>
<body>
<header>
<?php $this->load->view('header');?>
</header>
<?php $this->load->view('menu');?>

<div id="body">


<?php
		if (isset($body))
		{
		if ($body=='master_pegawai')
		{
		$this->load->view('body_master_pegawai');
		}
		else if($body=='master_barang')
		{
		$this->load->view('body_master_barang');
		}
		else if($body=='jenis_barang')
		{
		$this->load->view('body_jenis_barang');
		}
		else if($body=='master_pelanggan')
		{
		$this->load->view('body_master_pelanggan');
		}
		else if($body=='ubah_pegawai')
		{
		$this->load->view('body_ubah_pelanggan');
		}
		}

?>

</div>



</body>
<footer>
<?php $this->load->view('footer'); ?>
</footer>
</html>