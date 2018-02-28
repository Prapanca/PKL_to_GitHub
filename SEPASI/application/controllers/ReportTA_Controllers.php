<?php
	class ReportTA_Controllers extends CI_Controller{
		function __construct(){
			parent::__construct();
			$this->load->model("aktor");
			$this->load->model('ta_models');
			$this->load->helper(array('form', 'url'));
			$this->load->helper('url');
			$this->load->library('session');
		}
		
		public function logOut(){
			$data['status'] = $this->aktor->getStatus();
			$data = array('id_admin' => $data['status'], 'aksi'=>'Keluar dari Sistem Pengelolaan Skripsi', 'tujuan'=>0);
			$this->db->insert('aktifitas',$data);
			$this->session->unset_userdata('login');
			redirect('/Login');
		}
		
		function report_ta(){
			/*------------ semester -----------*/
			$query_semester = $this->db->query("SELECT * FROM semester");
			$query_semester = $query_semester->row_array();
			$data['status_smt'] = $query_semester['status_smt'];
			$data['thn_ajaran'] = $query_semester['thn_ajaran'];
			/*------------ semester -----------*/
			
			if(!$this->session->has_userdata('login'))
				redirect('/Login');
			$data['nama'] = $this->aktor->getNama();
			$data['linkKeluar'] = "logOut";
			$data['query'] = $this->db->query("SELECT * FROM makalah_ta GROUP BY semester, thn_ajaran");
			$data['row'] = $this->ta_models->getTabelTA();
			$this->load->view('report', $data);
		}
		
		function get_mengumpulkan($semester, $thn){
			$query_all = "SELECT * FROM makalah_ta";
			$q_all = $this->db->query($query_all);
			
			$query = "SELECT * FROM makalah_ta
						WHERE makalah_ta.thn_ajaran='$thn'
						AND makalah_ta.semester='$semester'";
			$q = $this->db->query($query);
			$data = $q->num_rows();
			//$data['belum_mengumpulkan'] = ($q_all->num_rows()) - $data['total_mengumpulkan'];
			return $data;
		}
		
		function get_chart(){
			$query = $this->db->query("SELECT * FROM makalah_ta GROUP BY semester, thn_ajaran");
			$i = 0;
			foreach($query->result() as $result){
				$data[$i]['y'] = $result->semester.' ('.$result->thn_ajaran.')';
				$queryJumlah = $this->get_mengumpulkan($result->semester, $result->thn_ajaran);
				$data[$i]['a'] = $queryJumlah;
				$i++;
			}
			
			header("Content-Type: application/json; charset=UTF-8");
			echo json_encode($data);
		}
		
		function TampilLaporan($nim){
			$this->load->library('laporan');
			$data = $this->ta_models->detailTA($nim);
			$array = array(
				'nama'	=> $data[0]->name,
				'nim'	=> $data[0]->nim,
				'angkatan'	=> $data[0]->angkatan,
				'judul' => $data[0]->judul,
				'nama_dosen' => $data[0]->nama_dosen,
				'abstrak' => $data[0]->abstrak,
				'kata_kunci' => $data[0]->kata_kunci,
				'doc' => $data[0]->doc,
				'pdf' => $data[0]->pdf,
				'ppt' => $data[0]->ppt,
				'source_code' => $data[0]->source_code,
				'artikel_ilmiah' => $data[0]->artikel_ilmiah,
				'lampiran' => $data[0]->lampiran,
				'waktu' => $data[0]->waktu,
			);
			$this->laporan->Makalah($array);
		}
		
		public function mengumpulkan_ta($semester = null, $thn = null,$next = null){
			/*------------ semester -----------*/
			$query_semester = $this->db->query("SELECT * FROM semester");
			$query_semester = $query_semester->row_array();
			$data['status_smt'] = $query_semester['status_smt'];
			$data['thn_ajaran'] = $query_semester['thn_ajaran'];
			/*------------ semester -----------*/
			
			if(!$this->session->has_userdata('login'))
				redirect('/Login');
			$data['nama'] = $this->aktor->getNama();
			$data['linkKeluar'] = "logOut";
			$data['semester'] = $semester;
			$data['thn'] = $thn;
			$data['next'] = $next;
			
			if($semester == null || $thn == null || $next = null){
				$data['row'] = $this->ta_models->getTabelTA();
			}
			else{
				$data['row'] = $this->ta_models->getTabelTA($semester, $thn." / ".$next);
			}
			
			$this->load->view('mengumpulkan_ta', $data);
		}
		
		//proses excel laporan
		public function proses_laporan($semester = null, $thn = null,$next = null){
			$this->load->library("Excel");
			$objPHPExcelAll = new PHPExcel();

			$nama_jenis_laporan = 'Kontraktual Fakultas';
			$filename = 'Laporan Makalah Tugas Akhir.xls'; //save our workbook as this file name
			/*$tbl = $this->db->query('SELECT makalah_ta.nim, mahasiswa.name, makalah_ta.judul, dosen.nama as nama_dosen,
											mahasiswa.angkatan, makalah_ta.waktu, dosen.nip, makalah_ta.thn_ajaran, makalah_ta.semester,
											dosen.jabatan, dosen.golongan
										FROM makalah_ta, mahasiswa, dosen
										WHERE makalah_ta.nim = mahasiswa.nim
										AND makalah_ta.nip = dosen.nip');*/
			$tbl = $this->ta_models->getTabelTALaporan($semester, $thn);
			$objPHPExcel = PHPExcel_IOFactory::load(FCPATH . "resource/excel/format.xlsx");     
			//kontraktual fakultas
			$objActiveSheet = $objPHPExcel->setActiveSheetIndex(0);
			$objActiveSheet->setTitle('Tes');
			//$objActiveSheet->getCell("A" . 2)->setValue('judulku');
			$i = 2;
			$no = 1;

			$tempnip = 0;
			foreach ($tbl as $rows) {
				$objActiveSheet->insertNewRowBefore($i + 2, 1);
				$i = $i + 1;
				if($tempnip != $rows->nip){
					$tempnip = $rows->nip;
					$objActiveSheet->getCell("A" . $i)->setValue($no);
					$objActiveSheet->getCell("B" . $i)->setValue($rows->nama_dosen);
					$objActiveSheet->getCell("B" . ($i+1))->setValue('NIP: '.$rows->nip);
					$objActiveSheet->getCell("C" . $i)->setValue($rows->jabatan);
					$objActiveSheet->getCell("D" . $i)->setValue($rows->golongan);
					$no++;
				}
				
				$objActiveSheet->getCell("E" . $i)->setValue($rows->name);
				$objActiveSheet->getCell("E" . ($i+1))->setValue($rows->nim);
				$objActiveSheet->getCell("F" . $i)->setValue($rows->judul);
				$i = $i + 1;
			}

			foreach ($objPHPExcel->getAllSheets() as $sheet) {
				$objPHPExcelAll->addExternalSheet($sheet);
			}

			$objPHPExcelAll->removeSheetByIndex(0);
			header('Content-Type: application/vnd.ms-excel'); //mime type
			header('Content-Disposition: attachment;filename="' . $filename . '"');
			header("Expires: 0");
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcelAll, 'Excel5');
			$objWriter->save('php://output');            
		}
	}
?>