<div class="wrapper-table">
<center>
<table border=1 class="table">
<tr><td>id_pegawai</td><td>nama_pegawai</td><td>alamat_email</td><td>alamat pegawai</td><td>telp_pegawai</td><td>otoritas</td></tr>
<?php if ($otoritas=='admin_utama')
{
foreach ($data_pegawai as $row)
{
	echo "<tr>";
	echo "<td>".$row->id_pgw."</td>";
	echo "<td>".$row->nm_pgw."</td>";
	echo "<td>".$row->almt_email_pgw."</td>";
	echo "<td>".$row->almt_pgw."</td>";
	echo "<td>".$row->telp_pgw."</td>";
	echo "<td>".$row->otoritas."</td>";
	echo "</tr>";
}
}
else
{
	return false;
}
?>
</table>
<center>
</div>