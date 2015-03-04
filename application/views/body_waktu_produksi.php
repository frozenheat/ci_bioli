<?php echo form_open(site_url().'/master_mesin/input_mesin/update_mesin'); ?>
<table class="table-form">
<tr><td>Jenis Mesin</td><td>Waktu Proses</td><td>Lot size</td></tr>
<?php
	$a = 1;
	foreach($jenis_mesin as $row)
	{ ?>
		<tr>
			<td><?php echo $row->jenis_mesin; ?></td><td><input type="text" name="waktu_produksi<?php echo $a;?>"></td><td><input type="text" name="lot_size<?php echo $a;?>"></td>
		</tr>
		<input type="hidden" name="jenis_mesin<?php echo $a; ?>" value="<?php echo $row->jenis_mesin?>" >
		
	<?php 
	$a++;
	}

?>
<input type="hidden" name="nama_barang" value="<?php echo $nama_barang; ?>" >
<tr><td></td><td><input type="submit" value="submit"></td>
</table>
</form>