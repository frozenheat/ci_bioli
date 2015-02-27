<script type="text/Javascript">
function pilihtindakan(tindakan, id_pegawai, nama_pegawai, alamat_email, alamat_pegawai, telp_pegawai, otoritas)
{
document.getElementById('id_pegawai').value = id_pegawai;
document.getElementById('nama_pegawai').value = nama_pegawai;
document.getElementById('alamat_email').value = alamat_email;
document.getElementById('alamat_pegawai').value = alamat_pegawai;
document.getElementById('telp_pegawai').value = telp_pegawai;
document.getElementById('otoritas').value = otoritas;
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
echo  form_open_multipart(site_url().'/master_pegawai/input_pegawai');
?>

<tr><td>nama pegawai:</td><td><input type ="text" name="nama_pegawai"></td></tr>
<tr><td>alamat pegawai:</td><td><input type ="text" name="almt_pgw"></td></tr>
<tr><td>alamat email pegawai:</td><td><input type ="text" name="almt_email"></td></tr>
<tr><td>no telp:</td><td><input type ="text" name="telp"></td></tr>
<tr><td>otoritas:</td><td><select name="otoritas"><option value = "admin_pelanggan">admin_pelanggan</option><option value="admin_produksi">admin_produksi</option></select></td></tr>
<tr><td>password:</td><td><input type ="password" name="password"></td></tr>
<tr><td>Upload foto:</td><td><input type ="file" name="foto"></td></tr>
<tr><td></td><td><input type="submit" name="tambah" value="tambah" class="submit"></td></tr>
</table>
</form>
</center>
</div>

<center>
<div class="scroll" style="width:891px;">
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
	echo "<td><select onchange='pilihtindakan(this.value, \"$row->id_pgw\", \"$row->nm_pgw\" , \"$row->almt_email_pgw\" , \"$row->almt_pgw\", \"$row->telp_pgw\", \"$row->otoritas\")'><option></option><option value='hapus'>hapus</option><option value='ubah'>ubah</option></td>";
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
	echo "<form id='tindakan' method='POST' action='".site_url()."/master_pegawai/edit_pegawai'>";
	echo "<input type='hidden' name='id_pegawai' id='id_pegawai'>";
	echo "<input type='hidden' name='nama_pegawai' id='nama_pegawai'>";
	echo "<input type='hidden' name='alamat_email' id='alamat_email'>";
	echo "<input type='hidden' name='alamat_pegawai' id='alamat_pegawai'>";
	echo "<input type='hidden' name='telp_pegawai' id='telp_pegawai'>";
	echo "<input type='hidden' name='otoritas' id='otoritas'>";
	echo "<input type='hidden' name='tindak' id='tindak'>";
	echo "</form>";
?>

