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


</script>



<center>
<table class="table-form">
<form action ='<?php echo site_url();?>/master_pesanan_pelanggan/c_tampil_pesanan/pilihan_form' method ='POST' id ='pilihan_form'>
<tr><td><select name='status' onchange ='pilih_form()'><option></option><option value='semua'>Semua</option><option value='belum' >Belum konfirmasi</option><option value='telah'>Telah konfirmasi</option></select></td></tr>
</form>
</table>
</center>

<center>
<?php if ($otoritas=='admin_utama' || $otoritas=='admin_pelanggan')
{
	if ($data_pesanan)
	{
?>
	<div class="scroll">
	<table border=1 class="table-data">
	<tr><td>id pesanan</td><td>id pemesan</td><td>nama barang</td><td>tanggal pemesanan</td><td>jam pemesanan</td><td>jumlah pesanan</td><td>status pesanan</td><td>status konfirmasi</td><td>perkiraan waktu selesai</td></tr>
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
	echo "<td>".$row2->sts_konfirm."</td>";
	echo "<td>".$row2->perkiraan_waktu_selesai."</td>";
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
		<?php
		}
		}
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

