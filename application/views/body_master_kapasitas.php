
<div class="wrapper-form">
<center>
<table  class="table-form">

<?php 
echo validation_errors();
echo form_open(site_url().'/master_mesin/c_kapasitas/input_data');
?>

<tr><td>nama mesin:</td><td><select name="id_mesin">
<?php 

	foreach($data_mesin as $row)
	{
		echo "<option value=\"$row->id_mesin\">".$row->nm_mesin."</option>";
	}

?>
</select></td></tr>
<tr><td>nama barang:</td><td><select name="id_barang">
<?php 

	foreach($data_barang as $row)
	{
		echo "<option value=\"$row->id_brng\">".$row->nm_brng."</option>";
	}

?>
</select></td></tr>

<tr><td>Lot Size:</td><td><input type="text" name="lot"></td></tr>
<tr><td>Waktu Produksi (jam):</td><td><input type="text" name="wkt_prdksi"></td></tr>


<tr><td></td><td><input type="submit" name="tambah" value="tambah" class="submit"></td></tr>
</form>
</table>
</center>
</div>



<?php if ($otoritas=='admin_utama'||$otoritas=='admin_pelanggan')
{

	if ($data_kapasitas == true)
		{
		
		?>
		<center>
	<div class="scroll" style="width:404px;">
	<table border=1 class="table-data">
	<tr><td>Nama barang</td><td>Nama mesin</td><td>Lot size</td><td>Waktu produksi (Jam)</td></tr>
	<?php
		$nama_barang = $data_kapasitas['nama_barang'];
		$nama_mesin = $data_kapasitas['nama_mesin'];
		$lot_size = $data_kapasitas['lot_size'];
		$waktu_prdksi = $data_kapasitas['waktu_prdksi'];
		for($a=0; $a<$data_kapasitas['jumlah_row']; $a++)
		{
		?>
		<tr><td><?php echo $nama_barang[$a];?></td><td><?php echo $nama_mesin[$a];?></td><td><?php echo $lot_size[$a];?></td><td><?php echo $waktu_prdksi[$a];?>&nbsp;Jam</td></tr>
		<?php
		}
	?>
	</table>
		<?php
		}


}
else
{
	return false;
}


	echo "<form id='tindakan' method='POST' action='".site_url()."/master_barang/edit_barang'>";
	echo "<input type='hidden' name='id_barang' id='id_barang'>";
	echo "<input type='hidden' name='nama_barang' id='nama_barang'>";
	echo "<input type='hidden' name='lot_size' id='lot_size'>";
	echo "<input type='hidden' name='waktu_produksi' id='waktu_produksi'>";
	echo "<input type='hidden' name='tindak' id='tindak'>";
	echo "</form>";
?>
</div>
</center>

