<script type="text/Javascript">
function pilihtindakan(tindakan, id_barang, nama_barang, lot_size, waktu_produksi)
{
document.getElementById('id_barang').value = id_barang;
document.getElementById('nama_barang').value = nama_barang;
document.getElementById('lot_size').value = lot_size;
document.getElementById('waktu_produksi').value = waktu_produksi;
document.getElementById('tindak').value = tindakan;

if (tindakan == 'hapus' || tindakan=='ubah')
{	
	//alert(id_pegawai);
	document.getElementById('tindakan').submit();
	
}


}
</script>



<div class="wrapper-form">
<center>
<table  class="table-form">

<?php 
echo validation_errors();
echo form_open(site_url().'/master_barang/input_stock_barang');
?>

<tr><td>nama barang:</td><td><select name="nama_barang">
<?php 

	foreach($data_barang as $row)
	{
		echo "<option value=\"$row->nm_brng\">".$row->nm_brng."</option>";
	}

?>
</select></td></tr>
<tr><td>jumlah stock:</td><td><input type ="text" name="jumlah_stock"></td></tr>


<tr><td></td><td><input type="submit" name="tambah" value="tambah" class="submit"></td></tr>
</form>
</table>
</center>
</div>



<?php if ($otoritas=='admin_utama'||$otoritas=='admin_pelanggan')
{

	if ($stock_barang == true)
		{
		
		?>
		<center>
	<div class="scroll" style="width:404px;">
	<table border=1 class="table-data">
	<tr><td>Tanggal stock</td><td>id barang</td><td>nama barang</td><td>jumlah stock</td></tr>

		<?php
		 foreach ($stock_barang as $row)
{

		echo "<tr>";
		echo "<td>".$row->tgl_stock."</td>";
		echo "<td>".$row->id_brng."</td>";
		echo "<td>".$row->nm_brng."</td>";
		echo "<td>".$row->jml_stock."</td>";
		//echo "<td><select onchange='pilihtindakan(this.value, \"$row->id_brng\", \"$row->nm_brng\" , \"$row->lot_size\" , \"$row->wkt_prdksi\")'><option></option><option value='hapus'>hapus</option><option value='ubah'>ubah</option></td>";
		echo "</tr>";

}	
	echo "</table>";
		}
		else
		{
		echo '<center>Data tidak ada</center>';
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
	echo "</form>"
?>
</div>
</center>

