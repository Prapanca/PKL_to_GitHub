<?php
	require('fpdf.php');

	class Laporan extends FPDF
	{
		// Page Left
		function Header(){
			$this->Image(APPPATH.'libraries/LaporanMTA.png',null,null,155,215,'PNG');
		}
		
		function Nama()
		{
			$this->SetY(65.5);
			$this->GetY();
			$this->SetX(82);
			$this->GetX();
			$this->MultiCell(97,5,$this->nama);
		}
		
		function NIM()
		{
			$this->SetX(82);
			$this->GetX();
			$this->MultiCell(97,5,$this->nim);
		}
		
		function Angkatan()
		{
			$this->SetX(82);
			$this->GetX();
			$this->MultiCell(97,5,$this->angkatan);
		}
		
		function Foto(){
			$this->Image(APPPATH.'libraries/foto.jpg',83,88,30,40,'JPG');
		}
		
		function Judul()
		{
			$this->SetX(82);
			$this->GetX();
			$this->MultiCell(97,5,$this->judul);
		}
		
		function Dosen_Pembimbing()
		{
			$this->SetY(152.5);
			$this->GetY();
			$this->SetX(82);
			$this->GetX();
			$this->MultiCell(97,5,$this->nama_dosen);
		}
		
		function Abstrak()
		{
			$this->SetX(82);
			$this->GetX();
			$this->MultiCell(97,5,$this->abstrak);
		}
		
		function Kata_Kunci()
		{
			$this->SetX(82);
			$this->GetX();
			$this->MultiCell(97,5,$this->kata_kunci);
		}
		
		function DOC()
		{
			$this->SetX(88);
			$this->GetX();
			$this->MultiCell(97,5,$this->doc);
		}
		
		function PDF()
		{
			$this->SetX(88);
			$this->GetX();
			$this->MultiCell(97,5,$this->pdf);
		}
		
		function PPT()
		{
			$this->SetX(88);
			$this->GetX();
			$this->MultiCell(97,5,$this->ppt);
		}
		
		function Source_Code()
		{
			$this->SetX(88);
			$this->GetX();
			$this->MultiCell(97,5,$this->source_code);
		}
		
		function Artikel_Ilmiah()
		{
			$this->SetX(88);
			$this->GetX();
			$this->MultiCell(97,5,$this->artikel_ilmiah);
		}
		
		function Lampiran()
		{
			$this->SetX(88);
			$this->GetX();
			$this->MultiCell(97,5,$this->lampiran);
		}
		
		function Waktu()
		{
			$this->SetY(226.5);
			$this->GetY();
			$this->SetX(85);
			$this->GetX();
			$this->MultiCell(97,5,date("h:i:s a", strtotime($this->waktu)));
		}
		
		function Tanggal()
		{
			$this->SetX(85);
			$this->GetX();
			$this->MultiCell(97,5,date("D / d-M-Y", strtotime($this->waktu)));
		}
		
		function PrintChapter()
		{
			$this->Nama();
			$this->Ln(2.5);
			$this->NIM();
			$this->Ln(2.5);
			$this->Angkatan();
			$this->Ln(47.5);
			$this->Judul();
			$this->Dosen_Pembimbing();
			$this->Ln(2.5);
			$this->Abstrak();
			$this->Ln(2.5);
			$this->Kata_Kunci();
			$this->Ln(1);
			$this->DOC();
			$this->Ln(1);
			$this->PDF();
			$this->Ln(1.5);
			$this->PPT();
			$this->Ln(1.5);
			$this->Source_Code();
			$this->Ln(1);
			$this->Artikel_Ilmiah();
			$this->Ln(1.5);
			$this->Lampiran();
			$this->Waktu();
			$this->Ln(2.5);
			$this->Tanggal();
		}
		
		function Makalah($array)
		{
			$this->SetMargins(25.4, 25.4, 25.4);
			$this->AddPage('P','A4');
			$this->nama = $array['nama'];
			$this->nim = $array['nim'];
			$this->angkatan = $array['angkatan'];
			$this->judul = $array['judul'];
			$this->nama_dosen = $array['nama_dosen'];
			$this->abstrak = $array['abstrak'];
			$this->kata_kunci = $array['kata_kunci'];
			$this->doc = $array['doc'];
			$this->pdf = $array['pdf'];
			$this->ppt = $array['ppt'];
			$this->source_code = $array['source_code'];
			$this->artikel_ilmiah = $array['artikel_ilmiah'];
			$this->lampiran = $array['lampiran'];
			$this->waktu = $array['waktu'];
			$this->SetFont('Times','',12);
			$this->PrintChapter();
			$this->Foto();
			$this->Output();
		}
		
	}
?>