<div class="wrapper-form">
<center>
<table  class="table-form">

<?php 
echo validation_errors();
echo form_open(site_url().'/master_barang/c_input_barang/master_barang');
?>

<tr><td>nama barang:</td><td><input type ="text" name="nama_barang"></td></tr>
<tr><td>lot size:</td><td><input type ="text" name="lot_size"></td></tr>
<tr><td>waktu produksi:</td><td><input type ="text" name="waktu_produksi"></td></tr>
<tr><td>jenis barang:</td><td><select name="jenis_barang">
</form>
<?php
foreach ($jenis_barang as $row)
{
	echo '<option value = "'.$row->nm_jns_brng.'">'.$row->nm_jns_brng.'</option>';
}
?>
</select></td></tr>

<tr><td></td><td><input type="submit" name="tambah" value="tambah" class="submit"></td></tr>
</table>
</center>
</div>

<center>
<div class="scroll">
<table border=1 class="table-data">
<tr><td>id_barang</td><td>nama_barang</td><td>lot_size</td><td>waktu_produksi</td></tr>

<?php if ($otoritas=='admin_utama'||$otoritas=='admin_produksi')
{
foreach ($barang as $row)
{

	echo "<tr>";
	echo "<td>".$row->id_brng."</td>";
	echo "<td>".$row->nm_brng."</td>";
	echo "<td>".$row->lot_size."</td>";
	echo "<td>".$row->wkt_prdksi."</td>";
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

