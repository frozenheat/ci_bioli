<script type="text/Javascript">
function pilihtindakan(tindakan, id_pelanggan, nama_pelanggan, alamat_pelanggan, alamat_email, telp_pelanggan)
{
document.getElementById('id_pelanggan').value = id_pelanggan;
document.getElementById('nama_pelanggan').value = nama_pelanggan;
document.getElementById('alamat_email').value = alamat_email;
document.getElementById('alamat_pelanggan').value = alamat_pelanggan;
document.getElementById('telp_pelanggan').value = telp_pelanggan;
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
echo form_open(site_url().'/master_pelanggan/c_input_pelanggan');
?>

<tr><td>nama pelanggan:</td><td><input type ="text" name="nama_pelanggan"></td></tr>
<tr><td>alamat pelanggan:</td><td><input type ="text" name="alamat_pelanggan"></td></tr>
<tr><td>alamat email:</td><td><input type ="text" name="alamat_email"></td></tr>
<tr><td>no telp:</td><td><input type ="text" name="no_telp"></td></tr>
<tr><td>password:</td><td><input type ="text" name="password"></td></tr>
<tr><td></td><td><input type="submit" name="tambah" value="tambah" class="submit"></td></tr>
</form>
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
	echo "<td><select onchange='pilihtindakan(this.value, \"$row->id_pln\", \"$row->nm_pln\" , \"$row->almt_pln\" , \"$row->almt_email\", \"$row->no_telp\")'><option></option><option value='hapus'>hapus</option><option value='ubah'>ubah</option></td>";
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

<?php
	echo "<form id='tindakan' method='POST' action='".site_url()."/master_pelanggan/edit_pelanggan'>";
	echo "<input type='hidden' name='id_pelanggan' id='id_pelanggan'>";
	echo "<input type='hidden' name='nama_pelanggan' id='nama_pelanggan'>";
	echo "<input type='hidden' name='alamat_email' id='alamat_email'>";
	echo "<input type='hidden' name='alamat_pelanggan' id='alamat_pelanggan'>";
	echo "<input type='hidden' name='telp_pelanggan' id='telp_pelanggan'>";
	echo "<input type='hidden' name='tindak' id='tindak'>";
	echo "</form>";
?>
