<?php
	require('fpdf.php');

	class Pdf extends FPDF
	{

		function Judul($judul)
		{
			// Read text file
			$txt = file_get_contents($judul);
			// Times 12
			$this->SetFont('Times','B',11);
			$this->SetX(10);
			$this->GetX();
			// Output justified text
			$this->MultiCell(0,5,$txt);
			// Line break
			$this->Ln();
		}

		function Section($section)
		{
			// Read text file
			$txt = file_get_contents($section);
			// Times 12
			$this->SetFont('Times','',11);
			$this->SetX(10);
			$this->GetX();
			// Output justified text
			$this->MultiCell(0,5,$txt);
			// Line break
			$this->Ln();
		}

		function Right($judul,$section)
		{
			$this->Judul($judul);
			$this->Section($section);
		}
		
		function Tulisan(){
			$this->SetFont('Times','B',12);
			$this->MultiCell(0,5,'Aditya Sandrian Prapanca');
			$this->SetX(50);
			$this->GetX();
			$this->SetY(50);
			$this->GetY();
		}
		
		function Tampil(){
			$this->AddPage('P',array(165,200));
			//$pdf->Tulisan();
			$this->Right('header.txt','baru.php');
			$this->Line(11,170,55,170);
			$this->Output();
		}

	}

	
?>