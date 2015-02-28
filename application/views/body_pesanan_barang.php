<?php
//dari halaman pegawai (admin utama, admin pelanggan)
if ($database == 'pegawai')
{
?>

<script type="text/Javascript">

function pilih_form()
{
	document.getElementById('pilihan_form').submit();
}

function konfirm_pesanan(hasil_konfirm, id_pesanan, id_pemesan, nama_barang, jumlah_pesanan, tgl_pemesanan)
{
	
	document.getElementById('id_pesanan').value = id_pesanan;
	document.getElementById('id_pemesan').value = id_pemesan;
	document.getElementById('nama_barang').value = nama_barang;
	document.getElementById('hasil_konfirm').value = hasil_konfirm;
	document.getElementById('jml_pesanan').value = jumlah_pesanan;
	document.getElementById('tgl_pemesanan').value = tgl_pemesanan;
	document.getElementById('con').submit();

}


</script>



<center>
<table class="table-form pesanan-pelanggan">
<form action ='<?php echo site_url();?>/master_pesanan_pelanggan/c_tampil_pesanan/pilihan_form' method ='POST' id ='pilihan_form'>
<tr><td><select name='status' onchange ='pilih_form()'><option></option><option value='semua'>Semua</option><option value='belum' >Belum konfirmasi</option><option value='telah'>Telah konfirmasi</option><option value="terpenuhi">Terpenuhi</option></select></td></tr>
</form>
</table>
</center>

<center>
<?php if ($otoritas=='admin_utama' || $otoritas=='admin_pelanggan')
{
	if ($data_pesanan)
	{
?>
	<div class="scroll" style="width:1306px;">
	<table border=1 class="table-data">
	<tr><td>id pesanan</td><td>id pemesan</td><td>nama barang</td><td>tanggal pemesanan</td><td>jam pemesanan</td><td>jumlah pesanan</td><td>status pesanan</td><td>konfirmasi pesanan</td><td>perkiraan waktu selesai</td></tr>
<?php
	foreach ($data_pesanan as $row2)
	{

	echo "<tr>";
	echo "<td>".$row2->id_pesanan."</td>";
	echo "<td>".$row2->id_pemesan."</td>";
	echo "<td>".$row2->nama_barang."</td>";
	echo "<td>".$row2->tanggal_pemesanan."</td>";
	echo "<td>".$row2->jam_pemesanan."</td>";
	echo "<td>".$row2->jumlah_pesanan."</td>";
	echo "<td>".$row2->status_pesanan."</td>";
	//echo "<td>".$row2->sts_konfirm."</td>

	if ($row2->perkiraan_waktu_selesai == '0000-00-00 00:00:00'|| $row2->perkiraan_waktu_selesai =='')
	{
		echo "<td>".$row2->sts_konfirm."</td>";
		echo "<td>belum diproses</td>";
	}
	else
	{
	if (isset($status))
	{
		if ($status =='belum')
		{
		echo "<td><select onchange='konfirm_pesanan(this.value, \"$row2->id_pesanan\", \"$row2->id_pemesan\", \"$row2->nama_barang\", \"$row2->tanggal_pemesanan\")'><option></option><option value='batal'>batal</option><option value='pesan'>pesan</option></select></td>";
		}
		else if($status =='telah')
		{
		echo "<td>".$row2->sts_konfirm."</td>";
		}
		else if($status == 'semua')
		{
			if($row2->sts_konfirm !="belum_konfirmasi")
			{
			echo "<td>".$row2->sts_konfirm."</td>";
			}
			else if($row2->sts_konfirm =="belum_konfirmasi")
			{
			echo "<td><select onchange='konfirm_pesanan(this.value, \"$row2->id_pesanan\", \"$row2->id_pemesan\", \"$row2->nama_barang\", \"$row2->jumlah_pesanan\")'><option></option><option value='batal'>batal</option><option value='pesan'>pesan</option></select></td>";
			}
			
		}
		else if ($status =='terpenuhi')
		{
		echo "<td>".$row2->sts_konfirm."</td>";
		}
	}
	else
	{
			if($row2->sts_konfirm !="belum_konfirmasi")
			{
			echo "<td>".$row2->sts_konfirm."</td>";
			}
			else if($row2->sts_konfirm =="belum_konfirmasi")
			{
			echo "<td><select onchange='konfirm_pesanan(this.value, \"$row2->id_pesanan\", \"$row2->id_pemesan\", \"$row2->nama_barang\")'><option></option><option value='batal'>batal</option><option value='pesan'>pesan</option></select></td>";
			}
		
	}
	
	echo "<td>".$row2->perkiraan_waktu_selesai."</td>";
	}
	
	
	
	//echo "<td><select><option>batal</option><option>pesan</option></select></td>";
	//echo "<td><select onchange='pilihtindakan(this.value, \"$row->id_pgw\", \"$row->nm_pgw\" , \"$row->almt_email_pgw\" , \"$row->almt_pgw\", \"$row->telp_pgw\", \"$row->otoritas\")'><option></option><option value='hapus'>hapus</option><option value='ubah'>ubah</option></td>";
	echo "</tr>";
	}
	echo '</table>';
	echo '</div>';
		if (isset($status))
		{
		if ($status == 'belum')
		{
		echo form_open(site_url().'/penjadwalan_produksi/penjadwalan_produksi_sementara');
		?>
		
		<input type ='submit' style='margin-top:5px;' value='Penjadwalan produksi'>
		</form>
		
		<?php
		}
		else if($status == 'telah')
		{
		echo form_open(site_url().'/penjadwalan_produksi/penjadwalan_produksi_utama');
		?>
		
		<input type ='submit' style='margin-top:5px;' value='Penjadwalan produksi'>
		</form>
		
		<?php
		}
		}
		?>
		<form action='<?php echo site_url();?>/master_pesanan_pelanggan/konfirmasi_pesanan' id='con' method='POST'>
		
		<input type='hidden' name="id_pesanan" id="id_pesanan">
		<input type='hidden' name="id_pemesan" id="id_pemesan">
		<input type='hidden' name="nama_barang" id="nama_barang">
		<input type='hidden' name="hasil_konfirm" id="hasil_konfirm">
		<input type='hidden' name="jml_pesanan" id="jml_pesanan">
		<input type='hidden' name="tgl_pemesanan" id="tgl_pemesanan">
		</form>
		<?php
		
	}
	else
	{
	if (!isset($status))
	{
	echo "tidak ada pesanan pelanggan";
	}
	else if ($status == 'belum')
	{
	echo 'tidak ada pesanan yang belum dikonfirmasi';
	}
	else if ($status == 'telah')
	{
	echo 'tidak ada pesanan yang telah dikonfirmasi';
	}
	}
}
else
{
	return false;
}

?>
</center>
<?php


}
else if ($database == 'pelanggan')
{
?>
<div class="wrapper-form">
<center>
<table  class="table-form">


<?php
echo validation_errors();
echo form_open(site_url().'/master_pesanan_pelanggan/input_pesanan');
?>
<input type='hidden' name='database' value='<?php echo $database;?>'>
<input type='hidden' name='id_pelanggan' value='<?php echo $id_pelanggan;?>'>
<tr><td>nama barang:</td><td><select name="nama_barang">
<?php
foreach ($nama_barang as $row)
{
 echo "<option value=\"$row->nm_brng\">".$row->nm_brng."</option>";
}
?> 
</td>
<tr><td>jumlah pesanan:</td><td><input type ="text" name="jml_psn"></td></tr>
<tr><td></td><td><input type="submit" name="tambah" value="tambah" class="submit"></td></tr>
</table>
</form>
</center>
</div>
<?php }?>

