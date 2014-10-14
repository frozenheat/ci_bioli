<?php if ($otoritas =="admin_utama")
	{?>
<div id="wrapper_menu">
<div id='cssmenu'>
<ul>
   <li><a href='#'>Beranda</a></li>
   <li class="has-sub"><a href='#'>Master</a><ul><li class="has-sub"><a href='#'>Pegawai</a></li><li class="has-sub"><a href='#'>Barang</a></li><li><a href='#'>Pelanggan</a></li><li><a href="#">Pesanan pelanggan</a></li></ul></li>
   <li><a href="c_halaman_utama/logout">Keluar</a></li>
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
   <li><a href="c_halaman_utama/logout">Keluar</a></li>
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
   <li><a href="c_halaman_utama/logout">Keluar</a></li>
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
	<li><a href="c_halaman_utama/logout">Keluar</a></li>
</ul>
</div>
</div>
</div>
	<?php
	}
	?>