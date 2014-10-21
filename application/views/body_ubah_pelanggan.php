<div class="wrapper-form">
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
<tr><td>password:</td><td><input type ="password" name="password" ></td></tr>
<tr><td></td><td><input type="submit" name="ubah" value="ubah" class="submit"></td></tr>
</table>
</form>
</center>
</div>