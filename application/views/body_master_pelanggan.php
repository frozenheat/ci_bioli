<div class="wrapper-form">
<center>
<table  class="table-form">

<?php 
echo validation_errors();
echo form_open(site_url().'/master_pelanggan/c_input_pelanggan');
?>

<tr><td>nama pelanggan:</td><td><input type ="text" name="nama_pelanggan"></td></tr>
<tr><td>alamat pelanggan:</td><td><input type ="text" name="alamat_pelanggan"></td></tr>
<tr><td>alamat email:</td><td><input type ="text" name="alamat_email"></td></tr>
<tr><td>no telp:</td><td><input type ="text" name="no_telp"></td></tr>
<tr><td>password:</td><td><input type ="text" name="password"></td></tr>
<tr><td></td><td><input type="submit" name="tambah" value="tambah" class="submit"></td></tr>
</table>
</center>
</div>

<center>
<div class="scroll">
<table border=1 class="table-data">
<tr><td>id_pelanggan</td><td>nama_pelanggan</td><td>alamat_pelanggan</td><td>alamat_email</td><td>no_telp</td></tr>

<?php if ($otoritas=='admin_utama'||$otoritas=='admin_pelanggan')
{
foreach ($data_pelanggan as $row)
{

	echo "<tr>";
	echo "<td>".$row->id_pln."</td>";
	echo "<td>".$row->nm_pln."</td>";
	echo "<td>".$row->almt_pln."</td>";
	echo "<td>".$row->almt_email."</td>";
	echo "<td>".$row->no_telp."</td>";
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

