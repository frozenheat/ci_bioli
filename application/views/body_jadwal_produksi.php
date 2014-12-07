

<center>
<a style="font-size:24pt; color:#801515; letter-spacing:7px; display:inline-block;">Jadwal Produksi</a><br>

<?php if (!isset($jadwal_produksi))
{
echo "<a style='padding-top:60px; display:inline-block;'> tidak ada jadwal produksi</a>";
}
else
{
?>
<div class="scroll" style="margin-top:30px; width:1176px;">
<table border=1 class="table-data">
<tr><td>Id produksi</td><td>Nama barang</td><td>Waktu produksi</td><td>Jumlah batch produksi</td><td>Waktu mulai produksi</td><td>Waktu selesai produksi</td><td>Keterangan</td><td>Terpenuhi</td></tr>

<?php if ($otoritas=='admin_utama'||$otoritas=='admin_produksi')
{
foreach ($jadwal_produksi as $row)
{

	echo "<tr>";
	echo "<td>".$row->id_prdksi."</td>";
	echo "<td>".$row->nm_brng."</td>";
	if ($row->wkt_prdksi == 0 && $row->jumlah_batch == 0)
	{
	echo "<td><center>-</center></td>";
	echo "<td><center>-</center></td>";
	}
	else
	{
	echo "<td>".$row->wkt_prdksi." jam</td>";
	echo "<td>".$row->jumlah_batch." kali</td>";
	}
	
	echo "<td>".$row->waktu_mulai."</td>";
	echo "<td>".$row->waktu_selesai."</td>";
	
	if ($row->wkt_prdksi == 0 && $row->jumlah_batch == 0)
	{
	echo "<td>Lanjutan</td>";
	
	}
	else
	{
	echo "<td>Awal</td>";
	echo "<td><input type='checkbox'></td>";
	}
	
	echo "</tr>";

}
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
?>
</center>

