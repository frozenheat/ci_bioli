<?php if ($otoritas =="admin_utama")
	{?>
<div id="wrapper_menu">

<div id='cssmenu'>
<ul>
   <li><a href='<?php echo site_url();?>/c_halaman_utama'>Beranda</a></li>
   <li class="has-sub"><a href='#'>Master</a><ul><li class="has-sub"><a href='<?php echo site_url();?>/master_pegawai/c_tampil_pegawai'>Pegawai</a></li><li class="has-sub"><a href='<?php echo site_url();?>/master_barang/c_tampil_barang'>Barang</a><ul><li><a href='<?php echo site_url();?>/master_barang/c_tampil_jenis_barang'>jenis_barang</a></li></ul></li><li><a href='<?php echo site_url();?>/master_pelanggan/c_tampil_pelanggan'>Pelanggan</a></li><li><a href='<?php echo site_url();?>/master_pesanan_pelanggan/c_tampil_pesanan'>Pesanan pelanggan</a></li></ul></li>
   <li><a href="<?php echo site_url();?>/c_halaman_utama/logout">Keluar</a></li>
</ul>
</div>
</div>

	<?php
	}
	else if ($otoritas =="admin_produksi")
	{
	?>
	<div id="wrapper_menu">
<div id='cssmenu'>
<ul>
   <li><a href='<?php echo site_url();?>/c_halaman_utama'>Beranda</a></li>
   <li class="has-sub"><a href='#'>Master</a><ul><li><a href='<?php echo site_url();?>/master_barang/c_tampil_barang'>Barang</a></li><li><a href='<?php echo site_url();?>/master_barang/c_tampil_jenis_barang'>Jenis barang</a></li></ul></li>
   <li><a href='#'>Jadwal Produksi</a></li>
   <li><a href="<?php echo site_url();?>/c_halaman_utama/logout">Keluar</a></li>
</ul>
</div>
</div>
	
	<?php
	}
	else if ($otoritas =="admin_pelanggan")
	{
	?>
<div id="wrapper_menu">
<div id='cssmenu'>
<ul>
   <li><a href='<?php echo site_url();?>/c_halaman_utama'>Beranda</a></li>
   <li class="has-sub"><a href='#'>Master</a><ul><li class="has-sub"><a href='<?php echo site_url();?>/master_pelanggan/c_tampil_pelanggan'>Pelanggan</a></li><li class="has-sub"><a href='<?php echo site_url();?>/master_pesanan_pelanggan/c_tampil_pesanan'>Pesanan pelanggan</a></li></ul></li>
   <li><a href="<?php echo site_url();?>/c_halaman_utama/logout">Keluar</a></li>
</ul>
</div>
</div>
</div>
	<?php
	}
	else if($otoritas=="pelanggan")
	{
	?>
	<div id="wrapper_menu">
<div id='cssmenu'>
<ul>
	<li><a href='<?php echo site_url();?>/c_halaman_utama'>Beranda</a></li>
	<li class="has-sub"><a href='<?php echo site_url();?>/master_pesanan_pelanggan/c_tampil_pesanan'>Pemesanan barang</a></li>
	<li><a href="">status barang</a></li>
	<li><a href="<?php echo site_url();?>/c_halaman_utama/logout">Keluar</a></li>
</ul>
</div>
</div>
</div>
	<?php
	}
	?>