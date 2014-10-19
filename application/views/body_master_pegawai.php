<div class="wrapper-form">
<center>
<table  class="table-form">

<?php 
echo validation_errors();
echo form_open(site_url().'/master_pegawai/input_pegawai');
?>

<tr><td>nama pegawai:</td><td><input type ="text" name="nama_pegawai"></td></tr>
<tr><td>alamat pegawai:</td><td><input type ="text" name="almt_pgw"></td></tr>
<tr><td>alamat email pegawai:</td><td><input type ="text" name="almt_email"></td></tr>
<tr><td>no telp:</td><td><input type ="text" name="telp"></td></tr>
<tr><td>otoritas:</td><td><select name="otoritas"><option value = "admin_pelanggan">admin_pelanggan</option><option value="admin_produksi">admin_produksi</option></select></td></tr>
<tr><td>password:</td><td><input type ="text" name="password"></td></tr>
<tr><td></td><td><input type="submit" name="tambah" value="tambah" class="submit"></td></tr>
</table>
</center>
</div>

<center>
<div class="scroll">
<table border=1 class="table-data">
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
</div>
</center>

