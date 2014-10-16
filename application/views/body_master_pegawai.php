<?php if ($otoritas=='admin_utama')
{
foreach ($data_pegawai as $row)
{
	echo $row->id_pgw;
	echo $row->nm_pgw;
	echo $row->almt_pgw;
	echo $row->telp_pgw;
	echo "<br>";
}
}
else
{
	return false;
}
?>