<?php
	require('fpdf.php');

	class Pdf extends FPDF
	{
		// Page Left
		function Header()
		{
			$this->Image(APPPATH.'libraries/bebas jurusan.png',5,5,140,200,'PNG');
		}
		function Footer()
		{
			$this->Image(APPPATH.'libraries/bebas jurusan.png',150,5,140,200,'PNG');
		}		
		function Nama()
		{
			$this->SetY(42);
			$this->GetY();
			$this->SetX(35);
			$this->GetX();
			$this->MultiCell(110,5.5,$this->nama);
		}
		function NIM()
		{
			$this->SetX(35);
			$this->GetX();
			$this->MultiCell(110,5,$this->nim);
		}
		function Judul()
		{
			$this->SetX(35);
			$this->GetX();
			$this->MultiCell(109,6,$this->judul);
		}
		function Tanggal()
		{
			$this->SetY(149);
			$this->GetY();
			$this->SetX(112);
			$this->GetX();
			$this->MultiCell(36,5,date('d F Y'));			
		}
		
		function Nama2()
		{
			$this->SetY(42);
			$this->GetY();
			$this->SetX(180);
			$this->GetX();
			$this->MultiCell(110,5.5,$this->nama);
		}
		function NIM2()
		{
			$this->SetX(180);
			$this->GetX();
			$this->MultiCell(110,5,$this->nim);
		}
		function Judul2()
		{
			$this->SetX(180);
			$this->GetX();
			$this->MultiCell(108,6,$this->judul);
		}
		function Tanggal2()
		{
			$this->SetY(149);
			$this->GetY();
			$this->SetX(257);
			$this->GetX();
			$this->MultiCell(36,5,date('d F Y'));			
		}
		
		function PrintChapter()
		{
			$this->Nama();
			$this->Ln(5);
			$this->NIM();
			$this->Ln(25);
			$this->Judul();
			$this->Tanggal();
		}
		
		function PrintChapter2()
		{
			$this->Nama2();
			$this->Ln(5);
			$this->NIM2();
			$this->Ln(25);
			$this->Judul2();
			$this->Tanggal2();
		}
		
		function Tampil($array)
		{
			$this->nama = $array['nama'];
			$this->nim = $array['nim'];
			$this->judul = $array['judul'];
			$this->AddPage('L','A4');
			$this->SetFont('Times','',11);
			$this->PrintChapter();
			$this->PrintChapter2();
			$this->Output();
		}
		
	}		
?>