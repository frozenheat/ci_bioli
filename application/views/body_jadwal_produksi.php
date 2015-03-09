<script>
function pilih_mesin()
{
	document.getElementById('pilihan_mesin').submit();
}
</script>




<table>
<form id ='pilihan_mesin' method ='POST' action ='<?php echo site_url();?>/penjadwalan_produksi/tampil_jadwal_produksi/pilih_mesin' >
<tr><td>Jenis Mesin :</td><td><select name="jenis_mesin" onchange ='pilih_mesin()'><option></option><option value="cetak">Mesin cetak</option><option value="bubut">Mesin bubut</option><option value="milling">Mesin milling</option></select></td></tr>
</form>
</table>


<center>
<a style="font-size:24pt; color:#801515; letter-spacing:7px; display:inline-block;">Jadwal Produksi</a><br>

<?php 

if(isset($jadwal_produksi))
{
?>
<div class="scroll" style="margin-top:30px; width:778px;">
<table border=1 class="table-data">
<tr><td>Id produksi</td><td>Nama barang</td><td>Waktu produksi</td><td>Waktu mulai produksi</td><td>Waktu selesai produksi</td></tr>

<?php if ($otoritas=='admin_utama'||$otoritas=='admin_produksi')
{
$a = 0;
foreach ($jadwal_produksi as $row)
{

	echo "<tr>";
	if ($row->wkt_prdksi == 0 && $row->jumlah_batch == 0)
	{
	echo "<td><center>-</center></td>";
	}
	else
	{
	echo "<td>".$row->id_prdksi."</td>";
	}
	echo "<td>".$row->nm_brng."</td>";
	if ($row->wkt_prdksi == 0 && $row->jumlah_batch == 0)
	{
	echo "<td><center>-</center></td>";

	}
	else
	{
	echo "<td>".$row->wkt_prdksi." jam</td>";

	}
	
	echo "<td>".$row->waktu_mulai."</td>";
	echo "<td>".$row->waktu_selesai."</td>";
	
	if ($row->wkt_prdksi == 0 && $row->jumlah_batch == 0)
	{
	echo "<td>Lanjutan</td>";
	
	}

	
	echo "</tr>";

	
}
	echo "<form id='konfirmasi_proses_produksi' action='".site_url()."/penjadwalan_produksi/tampil_jadwal_produksi/update_status_pesanan' method='POST'>";
	echo "<input type='hidden' name='id_produksi' id='id_produksi'>";
	echo "</form>";
}
else
{
	return false;
}
?>

</table>
</div>
<?php
}
else if(isset($data_mesin))
{?>
	<div class="scroll" style="margin-top:30px; width:778px;">
		<table border=1 class="table-data">
		<tr><td>Id Jadwal</td><td>Jenis Mesin</td><td>Id Produksi</td><td>Nama Barang</td><td>Waktu Produksi</td><td>Jumlah Batch</td><td>Waktu Mulai</td><td>Waktu Selesai</td></tr>
		<?php
			foreach($data_mesin as $row)
			{ ?>
			<tr>
			<td><?php echo $row->id_jadwal_mesin; ?></td>
			<td><?php echo $row->jenis_mesin; ?></td>
			<td><?php echo $row->id_prdksi; ?></td>
			<td><?php echo $row->nama_barang; ?></td>
			<td><?php echo $row->waktu_prdksi ?></td>
			<td><?php echo $row->jumlah_batch; ?></td>
			<td><?php echo $row->waktu_mulai; ?></td>
			<td><?php echo $row->waktu_selesai; ?></td>
			</tr>
			<?php
			}
		?>
		</table>
	</div>
<?php
}
else
{
echo "<a style='padding-top:60px; display:inline-block;'> tidak ada jadwal produksi</a>";
}
?>
</center





