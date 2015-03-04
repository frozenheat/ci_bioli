<div class="wrapper-form">
<center>
<table  class="table-form">

<?php 
echo validation_errors();
echo form_open(site_url().'/master_mesin/input_mesin/master_mesin');
?>

<tr><td>Jenis mesin:</td><td><input type ="text" name="jenis_mesin"></td></tr>
<tr><td></td><td><input type="submit" name="tambah" value="tambah" class="submit"></td></tr>
</form>
</table>
</center>
</div>
<?php
if ($data_mesin)
{
?>
<center>
<div class="scroll">

<?php if ($otoritas=='admin_utama'||$otoritas=='admin_produksi')
{
	echo $this->table->generate($data_mesin);

}


else
{
	return false;
}
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
