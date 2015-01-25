

<center>
<a style="font-size:24pt; color:#801515; letter-spacing:7px; display:inline-block;">PESANAN PELANGGAN</a><br>

<?php 
if (!$pesanan_barang)
{
echo "<a style='padding-top:60px; display:inline-block;'> tidak ada pesanan</a>";
}
else
{
?>
<div class="scroll" style="margin-top:30px; width:1051px;">
<table border=1 class="table-data">
<tr><td>Id Pesanan</td><td>Nama barang</td><td>Tanggal pemesanan</td><td>Jumlah pesanan</td><td>Status pesanan</td><td>Status konfirmasi</td><td>perkiraan waktu selesai</td></tr>

<?php if ($otoritas=='pelanggan'||$otoritas=='admin_utama')
{
foreach ($pesanan_barang as $row)
{

	echo "<tr>";
	echo "<td>".$row->id_pesanan."</td>";
	echo "<td>".$row->nama_barang."</td>";
	echo "<td>".$row->tanggal_pemesanan."</td>";
	echo "<td>".$row->jumlah_pesanan."</td>";
	echo "<td>".$row->status_pesanan."</td>";
	echo "<td>".$row->sts_konfirm."</td>";
	echo "<td>".$row->perkiraan_waktu_selesai."</td>";
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
</center





