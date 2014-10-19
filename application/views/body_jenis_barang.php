<div class="wrapper-form">
<center>
<table  class="table-form">

<?php 
echo validation_errors();
echo form_open(site_url().'/master_barang/c_input_barang/jenis_barang');
?>

<tr><td>id jenis barang:</td><td><input type ="text" name="id_jenis_barang"></td></tr>
<tr><td>nama jenis barang:</td><td><input type ="text" name="nama_jenis_barang"></td></tr>
<tr><td></td><td><input type="submit" name="tambah" value="tambah" class="submit"></td></tr>
</table>
</center>
</div>

<center>
<div class="scroll">
<table border=1 class="table-data">
<tr><td>id_Jenis_barang</td><td>nama_jenis_barang</td></tr>

<?php if ($otoritas=='admin_utama'||$otoritas=='admin_produksi')
{
foreach ($jenis_barang as $row)
{

	echo "<tr>";
	echo "<td>".$row->id_jns_brng."</td>";
	echo "<td>".$row->nm_jns_brng."</td>";
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

