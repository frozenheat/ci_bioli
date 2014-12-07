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
		else if($body=='stock_barang')
		{
		$this->load->view('body_master_stock_barang');
		}
		else if($body=='jenis_barang')
		{
		$this->load->view('body_jenis_barang');
		}
		else if($body=='master_pelanggan')
		{
		$this->load->view('body_master_pelanggan');
		}
		else if($body=='ubah')
		{
		$this->load->view('body_ubah');
		}
		else if($body=='pesanan_pelanggan')
		{
		$this->load->view('body_pesanan_barang');
		}
		else if($body=='jadwal_produksi')
		{
		$this->load->view('body_jadwal_produksi');
		}
		else if($body=="status_pesanan")
		{
		$this->load->view('body_status_pesanan');
		}
		}

?>

</div>



</body>
<footer>
<?php $this->load->view('footer'); ?>
</footer>
</html>