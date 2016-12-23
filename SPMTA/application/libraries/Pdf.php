<?php
	require('fpdf.php');

	class Pdf extends FPDF
	{
		// Page Left
		function Header()
		{
			$this->Image(APPPATH.'libraries/bebas jurusan.png',5,10,141,153,'PNG');
		}
		function Footer()
		{
			$this->Image(APPPATH.'libraries/bebas jurusan.png',150,10,141,153,'PNG');
		}		
		function Nama()
		{
			$this->SetY(39.7);
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
			$this->SetY(120);
			$this->GetY();
			$this->SetX(115);
			$this->GetX();
			$this->MultiCell(50,5,date('d M Y'));			
		}
		
		function Nama2()
		{
			$this->SetY(39.7);
			$this->GetY();
			$this->SetX(177);
			$this->GetX();
			$this->MultiCell(110,5,$this->nama);
		}
		function NIM2()
		{
			$this->SetX(177);
			$this->GetX();
			$this->MultiCell(110,5,$this->nim);
		}
		function Judul2()
		{
			$this->SetX(177);
			$this->GetX();
			$this->MultiCell(110,9,$this->judul);
		}
		function Tanggal2()
		{
			$this->SetY(120);
			$this->GetY();
			$this->SetX(260);
			$this->GetX();
			$this->MultiCell(50,5,date('d M Y'));			
		}
		
		function PrintChapter()
		{
			$this->Nama();
			$this->Ln(4);
			$this->NIM();
			$this->Ln(19.5);
			$this->Judul();
			$this->Tanggal();
		}
		
		function PrintChapter2()
		{
			$this->Nama2();
			$this->Ln(4);
			$this->NIM2();
			$this->Ln(19.5);
			$this->Judul2();
			$this->Tanggal2();
		}
		
		function Tampil($array)
		{
			$this->nama = $array['nama'];
			$this->nim = $array['nim'];
			$this->judul = $array['judul'];
			$this->AddPage('L','A4');
			$this->SetFont('Times','',12);
			$this->PrintChapter();
			$this->PrintChapter2();
			$this->Output();
		}
		
	}		
?>