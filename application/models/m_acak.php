<?php
class m_acak extends CI_Model
{
	
	function input_pegawai()
	{
		$array_word=array('0','1','2','3','4','5','6','7','8','9');
		shuffle($array_word);
		reset($array_word);
		$no=0;
		foreach($array_word as $line)
		{
		@$acak.=strtoupper($line);
		$no++;
		if (($no >= 5)) break;
		}
		return $acak;
	}
	
	
	function input_pelanggan()
	{
		$array_word=array('0','1','2','3','4','5','6','7','8','9');
		shuffle($array_word);
		reset($array_word);
		$no=0;
		foreach($array_word as $line)
		{
		@$acak.=strtoupper($line);
		$no++;
		if (($no >= 5)) break;
		}
		return $acak;
	}
	
	function input_barang()
	{
		$array_word=array('0','1','2','3','4','5','6','7','8','9');
		shuffle($array_word);
		reset($array_word);
		$no=0;
		foreach($array_word as $line)
		{
		@$acak.=strtoupper($line);
		$no++;
		if (($no >= 3)) break;
		}
		return $acak;
	}
	function input_stock()
	{
		$array_word=array('0','1','2','3','4','5','6','7','8','9');
		shuffle($array_word);
		reset($array_word);
		$no=0;
		foreach($array_word as $line)
		{
		@$acak.=strtoupper($line);
		$no++;
		if (($no >= 5)) break;
		}
		return $acak;
	}
	
	function input_pesanan()
	{
		$array_word=array('0','1','2','3','4','5','6','7','8','9');
		shuffle($array_word);
		reset($array_word);
		$no=0;
		foreach($array_word as $line)
			{
			@$acak.=strtoupper($line);
			$no++;
			if (($no >= 3)) break;
			}
		return $acak;
	}
	
	
	function jadwal_prdksi()
	{
		$array_word=array('0','1','2','3','4','5','6','7','8','9');
		shuffle($array_word);
		reset($array_word);
		$no=0;
		foreach($array_word as $line)
			{
			@$acak.=strtoupper($line);
			$no++;
			if (($no >= 4)) break;
			}
		return $acak;
	}
	
	function jadwal_cetak()
	{
		$array_word=array('0','1','2','3','4','5','6','7','8','9');
		shuffle($array_word);
		reset($array_word);
		$no=0;
		foreach($array_word as $line)
			{
			@$acak.=strtoupper($line);
			$no++;
			if (($no >= 3)) break;
			}
		return $acak;
	}
	function jadwal_bubut()
	{
		$array_word=array('0','1','2','3','4','5','6','7','8','9');
		shuffle($array_word);
		reset($array_word);
		$no=0;
		foreach($array_word as $line)
			{
			@$acak.=strtoupper($line);
			$no++;
			if (($no >= 3)) break;
			}
		return $acak;
	}
	function jadwal_milling()
	{
		$array_word=array('0','1','2','3','4','5','6','7','8','9');
		shuffle($array_word);
		reset($array_word);
		$no=0;
		foreach($array_word as $line)
			{
			@$acak.=strtoupper($line);
			$no++;
			if (($no >= 3)) break;
			}
		return $acak;
	}
	
	function master_mesin()
	{
		$array_word=array('0','1','2','3','4','5','6','7','8','9');
		shuffle($array_word);
		reset($array_word);
		$no=0;
		foreach($array_word as $line)
			{
			@$acak.=strtoupper($line);
			$no++;
			if (($no >= 3)) break;
			}
		return $acak;
	}
	
}
?>