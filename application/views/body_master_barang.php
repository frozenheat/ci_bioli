<script type="text/Javascript">
function pilihtindakan(tindakan, id_barang, nama_barang, lot_size, waktu_produksi)
{
document.getElementById('id_barang').value = id_barang;
document.getElementById('nama_barang').value = nama_barang;
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
echo form_open(site_url().'/master_barang/c_input_barang/master_barang');
?>

<tr><td>nama barang:</td><td><input type ="text" name="nama_barang"></td></tr>
<tr><td>jenis barang:</td>
<?php
if ($jenis_barang)
{
?>
<td><select name="jenis_barang">
<?php

foreach ($jenis_barang as $row)
{
	echo '<option value = "'.$row->nm_jns_brng.'">'.$row->nm_jns_brng.'</option>';
}
?>
</select></td></tr>
<tr><td>Lot size cetak:</td><td><input type ="text" name="lot_cetak"></td></tr>
<tr><td>Lot size bubut:</td><td><input type ="text" name="lot_bubut"></td></tr>
<tr><td>Lot size milling:</td><td><input type ="text" name="lot_milling"></td></tr>
<tr><td>Waktu cetak:</td><td><input type ="text" name="waktu_cetak"></td></tr>
<tr><td>Waktu bubut:</td><td><input type ="text" name="waktu_bubut"></td></tr>
<tr><td>Waktu milling:</td><td><input type ="text" name="waktu_milling"></td></tr>
<?php 
}
else
{
 echo "<td>Tidak ada jenis barang </td>";
}
?>
<tr><td></td><td><input type="submit" name="tambah" value="tambah" class="submit"></td></tr>
</form>
</table>
</center>
</div>
<?php
if ($barang)
{
?>
<center>
<div class="scroll">
<table border=1 class="table-data">
<tr><td>Id barang</td><td>Nama barang</td><td>Jenis barang</td><td>Lot size cetak</td><td>Lot size bubut</td><td>Lot size milling</td><td>Waktu cetak (menit)</td><td>Waktu bubut (menit)</td><td>Waktu milling (menit)</td></tr>

<?php if ($otoritas=='admin_utama'||$otoritas=='admin_produksi')
{

foreach ($barang as $row)
{

	echo "<tr>";
	echo "<td>".$row->id_brng."</td>";
	echo "<td>".$row->nm_brng."</td>";
	echo "<td>".$row->nm_jns_brng."</td>";
	echo "<td>".$row->lot_size_cetak."</td>";
	echo "<td>".$row->lot_size_bubut."</td>";
	echo "<td>".$row->lot_size_milling."</td>";
	echo "<td>".$row->wkt_prdksi_cetak."</td>";
	echo "<td>".$row->wkt_prdksi_bubut."</td>";
	echo "<td>".$row->wkt_prdksi_milling."</td>";
	echo "</tr>";

}	
	echo "</table>";
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

<?php
}
else
{
echo "<center> Tidak ada data barang </center>";
}
?>
