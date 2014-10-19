<?php if ($otoritas =="admin_utama")
	{?>
<div id="wrapper_menu">
<div id='cssmenu'>
<ul>
   <li><a href='<?php echo site_url();?>/c_halaman_utama'>Beranda</a></li>
   <li class="has-sub"><a href='#'>Master</a><ul><li class="has-sub"><a href='<?php echo site_url();?>/master_pegawai/c_tampil_pegawai'>Pegawai</a></li><li class="has-sub"><a href='<?php echo site_url();?>/master_barang/c_tampil_barang'>Barang</a><ul><li><a href='<?php echo site_url();?>/master_barang/c_tampil_jenis_barang'>jenis_barang</a></li></ul></li><li><a href='<?php echo site_url();?>/master_pelanggan/c_tampil_pelanggan'>Pelanggan</a></li><li><a href="#">Pesanan pelanggan</a></li></ul></li>
   <li><a href="<?php echo site_url();?>/c_halaman_utama/logout">Keluar</a></li>
</ul>
</div>
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
   <li><a href='#'>Beranda</a></li>
   <li class="has-sub"><a href='#'>Master</a><ul><li class="has-sub"><a href='#'>Barang</a></li></ul></li>
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
   <li><a href='#'>Beranda</a></li>
   <li class="has-sub"><a href='#'>Master</a><ul><li class="has-sub"><a href='#'>Pelanggan</a></li><li class="has-sub"><a href='#'>Pesanan pelanggan</a></li></ul></li>
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
	<li><a href='#'>Beranda</a></li>
	<li class="has-sub"><a href='#'>Pemesanan barang</a></li>
	<li><a href="">status barang</a></li>
	<li><a href="<?php echo site_url();?>/c_halaman_utama/logout">Keluar</a></li>
</ul>
</div>
</div>
</div>
	<?php
	}
	?>