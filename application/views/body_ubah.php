

<div class="wrapper-form">
<?php if ($bagian=='pegawai')
{
?>
<center>
<table  class="table-form">


<?php
echo validation_errors();
echo form_open(site_url().'/master_pegawai/edit_pegawai/ubah_pegawai');
?>
<input type="hidden" name="id_pegawai" value="<?php echo $id_pegawai;?>">
<tr><td>nama pegawai:</td><td><input type ="text" name="nama_pegawai" value=<?php echo $nama_pegawai;?>></td></tr>
<tr><td>alamat pegawai:</td><td><input type ="text" name="almt_pgw" value=<?php echo $alamat_pegawai;?>></td></tr>
<tr><td>alamat email pegawai:</td><td><input type ="text" name="almt_email" value=<?php echo $alamat_email;?>></td></tr>
<tr><td>no telp:</td><td><input type ="text" name="telp" value=<?php echo $telp_pegawai;?>></td></tr>
<tr><td>otoritas:</td><td><select name="otoritas"><option value = "admin_pelanggan">admin_pelanggan</option><option value="admin_produksi">admin_produksi</option></select></td></tr>
<tr><td>password:</td><td><input type ="password" name="password"></td></tr>
<tr><td></td><td><input type="submit" name="ubah" value="ubah" class="submit"></td></tr>
</table>
</form>
</center>
<?php 
}
else if($bagian =='master_barang')
{
?>


<center>
<table  class="table-form">
<?php
echo validation_errors();
echo form_open(site_url().'/master_barang/edit_barang/ubah_barang');
?>
<input type="hidden" name="id_barang" value="<?php echo $id_barang;?>">
<tr><td>nama barang:</td><td><input type ="text" name="nama_barang" value=<?php echo $nama_barang;?>></td></tr>
<tr><td>lot size:</td><td><input type ="text" name="lot_size" value=<?php echo $lot_size;?>></td></tr>
<tr><td>waktu produksi:</td><td><input type ="text" name="waktu_produksi" value=<?php echo $waktu_produksi;?>></td></tr>
<tr><td></td><td><input type="submit" name="ubah" value="ubah" class="submit"></td></tr>
</table>
</form>
</center>


<?php
}
else if($bagian=='master_pelanggan')
{
?>

<center>
<table  class="table-form">
<?php
echo validation_errors();
echo form_open(site_url().'/master_pelanggan/edit_pelanggan/ubah_pelanggan');
?>
<input type="hidden" name="id_pelanggan" value="<?php echo $id_pelanggan;?>">
<tr><td>nama pelanggan:</td><td><input type ="text" name="nama_pelanggan" value=<?php echo $nama_pelanggan;?>></td></tr>
<tr><td>alamat pelanggan:</td><td><input type ="text" name="alamat_pelanggan" value=<?php echo $alamat_pelanggan;?>></td></tr>
<tr><td>alamat email:</td><td><input type ="text" name="alamat_email" value=<?php echo $alamat_email;?>></td></tr>
<tr><td>telp pelanggan:</td><td><input type ="text" name="telp_pelanggan" value=<?php echo $telp_pelanggan;?>></td></tr>
<tr><td>password:</td><td><input type ="password" name="password"></td></tr>
<tr><td></td><td><input type="submit" name="ubah" value="ubah" class="submit"></td></tr>
</table>
</form>
</center>




<?php
}
?>
</div>