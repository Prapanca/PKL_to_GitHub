<?php
	require('fpdf.php');

	class Pdf extends FPDF
	{
		// Page Left
		function Header()
		{
			$this->Image(APPPATH.'libraries/bebas jurusan.png',5,10,141,153,'PNG');
		}
		
		function Nama()
		{
			$this->SetY(42);
			$this->GetY();
			$this->SetX(32);
			$this->GetX();
			$this->MultiCell(110,5,$this->nama);
		}
		function NIM()
		{
			$this->SetX(32);
			$this->GetX();
			$this->MultiCell(110,5,$this->nim);
		}
		function Judul()
		{
			$this->SetX(32);
			$this->GetX();
			$this->MultiCell(110,9,$this->judul);
		}
		function Tanggal()
		{
			$this->SetX(115);
			$this->GetX();
			$this->MultiCell(50,5,date('d M Y'));			
		}
		
		function PrintChapter()
		{
			$this->Nama();
			$this->Ln(4.5);
			$this->NIM();
			$this->Ln(21);
			$this->Judul();
			$this->Ln(30.5);
			$this->Tanggal();
		}
		
		function Tampil($array)
		{
			$this->nama = $array['nama'];
			$this->nim = $array['nim'];
			$this->judul = $array['judul'];
			$this->AddPage('P',array(180,155));
			$this->SetFont('Times','',12);
			$this->PrintChapter();
			$this->Output();
		}
		
	}		
?>