<?php
	class TA_Models extends CI_Model{
		function __construct(){
			parent::__construct();
			$this->load->database();
			$this->load->library('session');
		}
		
		function read($data){
			$this->db->select('*');
			$this->db->from('mahasiswa');
			if($data!=null){
				$this->db->where($data);
			}
			$query = $this->db->get();
			return $query;
		}
		
		function getTabelTA($semester = null, $thn = null){
			$query="";
			if($semester==null || $thn==null){
				//exit("l");
				$query = $this->db->query("SELECT makalah_ta.nim, mahasiswa.name, makalah_ta.judul, dosen.nama as nama_dosen,
											mahasiswa.angkatan, makalah_ta.waktu, dosen.nip, dosen.jabatan, dosen.golongan
										FROM makalah_ta, mahasiswa, dosen
										WHERE makalah_ta.nim = mahasiswa.nim
										AND makalah_ta.nip = dosen.nip");
			}else{
				//exit(." ".$semester);
				$query = $this->db->query("SELECT makalah_ta.nim, mahasiswa.name, makalah_ta.judul, dosen.nama as nama_dosen,
											mahasiswa.angkatan, makalah_ta.waktu, dosen.nip, makalah_ta.thn_ajaran, makalah_ta.semester,
											dosen.jabatan, dosen.golongan
										FROM makalah_ta, mahasiswa, dosen
										WHERE makalah_ta.nim = mahasiswa.nim
										AND makalah_ta.nip = dosen.nip 
										AND makalah_ta.thn_ajaran='".$thn."".(intval($thn)+1)."'
										AND makalah_ta.semester='".$semester."'");
			}
			return($query->num_rows() > 0) ? $query->result(): NULL;
		}
		
		function getTabelTALaporan($semester = null, $thn = null){
			$query="";
			if($semester==null || $thn==null){
				//exit("l");
				$query = $this->db->query("SELECT makalah_ta.nim, mahasiswa.name, makalah_ta.judul, dosen.nama as nama_dosen,
											mahasiswa.angkatan, makalah_ta.waktu, dosen.nip, dosen.jabatan, dosen.golongan
										FROM makalah_ta, mahasiswa, dosen
										WHERE makalah_ta.nim = mahasiswa.nim
										AND makalah_ta.nip = dosen.nip
										order by makalah_ta.nip");
			}else{
				//exit(." ".$semester);
				$query = $this->db->query("SELECT makalah_ta.nim, mahasiswa.name, makalah_ta.judul, dosen.nama as nama_dosen,
											mahasiswa.angkatan, makalah_ta.waktu, dosen.nip, makalah_ta.thn_ajaran, makalah_ta.semester,
											dosen.jabatan, dosen.golongan
										FROM makalah_ta, mahasiswa, dosen
										WHERE makalah_ta.nim = mahasiswa.nim
										AND makalah_ta.nip = dosen.nip 
										AND makalah_ta.thn_ajaran='".$thn." / ".(intval($thn)+1)."'
										AND makalah_ta.semester='".$semester."' 
										order by makalah_ta.nip");
			}
			return($query->num_rows() > 0) ? $query->result(): NULL;
		}
		
		function dosen(){
			$query = $this->db->query('SELECT * FROM dosen');
			
			return($query->num_rows() > 0) ? $query->result(): NULL;
		}
		
		function submitTA($namaFile = null){
			$form = array(
				'nim'	=> $this->input->post('nim'),
				'nip'	=> $this->input->post('nip'),
				'judul' => $this->input->post('judul'),
				'abstrak' => $this->input->post('abstrak'),
				'kata_kunci' => $this->input->post('kata_kunci'),
				'doc'	=> $namaFile['doc'],
				'pdf'	=> $namaFile['pdf'],
				'dokumen_per_bab'	=> $namaFile['dokumen_per_bab'],
				'ppt'	=> $namaFile['ppt'],
				'source_code'		=> $namaFile['source_code'],
				'artikel_ilmiah'	=> $namaFile['artikel_ilmiah'],
				'lampiran'			=> $namaFile['lampiran'],
				'semester' => $this->input->post('semester'),
				'thn_ajaran' => $this->input->post('thn_ajaran')
			);
			$this->db->insert('makalah_ta',$form);
			
			//insrt aktifitas
			$data['status'] = $this->aktor->getStatus();
			$nim = $this->input->post('nim');
			$data = array('id_admin' => $data['status'], 'aksi'=>'Menambahkan Data Skripsi Mahasiswa ', 'nim'=> $nim, 'tujuan'=>0);
			$this->db->insert('aktifitas',$data);

			$this->db->query("UPDATE mahasiswa SET foto='".$namaFile['foto']."' WHERE nim='".$this->input->post('nim')."'");
		}
		
		function detailTA($nim){
			$query = $this->db->query("SELECT makalah_ta.nim, mahasiswa.name, makalah_ta.judul, dosen.nama as nama_dosen, 
											mahasiswa.angkatan, mahasiswa.foto, makalah_ta.doc, makalah_ta.dokumen_per_bab, makalah_ta.pdf, makalah_ta.ppt,
											makalah_ta.source_code, makalah_ta.artikel_ilmiah, makalah_ta.lampiran, makalah_ta.abstrak,
											makalah_ta.kata_kunci, makalah_ta.waktu
										FROM makalah_ta, mahasiswa, dosen
										WHERE makalah_ta.nim = mahasiswa.nim
										AND makalah_ta.nip = dosen.nip
										AND mahasiswa.nim = $nim");
			
			return($query->num_rows() > 0) ? $query->result(): NULL;
		}
		
		function editTA($nim){
			$query = $this->db->query("SELECT makalah_ta.nim, mahasiswa.name, makalah_ta.judul, makalah_ta.doc, makalah_ta.dokumen_per_bab, mahasiswa.angkatan,
											makalah_ta.abstrak, makalah_ta.kata_kunci, mahasiswa.foto, makalah_ta.nip, dosen.nama as nama_dosen,
											makalah_ta.pdf, makalah_ta.ppt, makalah_ta.source_code, makalah_ta.artikel_ilmiah, makalah_ta.lampiran
										FROM makalah_ta, mahasiswa, dosen
										WHERE makalah_ta.nim = mahasiswa.nim
										AND makalah_ta.nip = dosen.nip
										AND mahasiswa.nim = $nim");
			
			return($query->num_rows() > 0) ? $query->result(): NULL;
		}
		
		function deleteTA($nim){
			
			$this->db->where('nim', $nim);
			$this->db->delete('makalah_ta');
			
			$path= str_ireplace('\application','',APPPATH).'uploads\\'.$nim;
			$this->load->helper("file"); // load the helper
			delete_files($path, true); // delete all files/folders
			rmdir($path);
		}
		
		function update($namaFile = null){
			$edit = $this->input->post('nim');
			$form = array(
					'nim'	=> $this->input->post('nim'),
					'nip'	=> $this->input->post('nip'),
					'judul' => $this->input->post('judul'),
					'abstrak' => $this->input->post('abstrak'),
					'kata_kunci' => $this->input->post('kata_kunci')
			);
			
			if($namaFile['doc']!=null){
				$form['doc']	= $namaFile['doc'];
			}
			if($namaFile['pdf']!=null){
				$form ['pdf']	= $namaFile['pdf'];
			}
			if($namaFile['dokumen_per_bab']!=null){
				$form ['dokumen_per_bab'] = $namaFile['dokumen_per_bab'];		
			}
			if($namaFile['ppt']!=null){
				$form ['ppt'] = $namaFile['ppt'];
			}
			if($namaFile['source_code']!=null){
				$form ['source_code'] = $namaFile['source_code'];
			}
			if($namaFile['artikel_ilmiah']!=null){
				$form ['artikel_ilmiah'] = $namaFile['artikel_ilmiah'];
			}
			if($namaFile['lampiran']!=null){
				$form ['lampiran'] = $namaFile['lampiran'];
			}
			$this->db->where('nim',$edit);
			$this->db->update('makalah_ta',$form);
			
			//insrt aktifitas
			$data['status'] = $this->aktor->getStatus();
			$nim = $this->input->post('nim');
			$data = array('id_admin' => $data['status'], 'aksi'=>'Merubah Dokumen Skripsi ', 'nim'=> $nim, 'tujuan'=>0);
			$this->db->insert('aktifitas',$data);
			//.insert aktifitas

			$edit2 = $this->input->post('nim');
			$form2 = array(
					'nim' => $this->input->post('nim'),
					'name' => $this->input->post('name'),
					'angkatan' => $this->input->post('angkatan')					
			);
			if($namaFile['foto']!=null){
				$form2 ['foto'] = $namaFile ['foto'];
			}
					
			$this->db->where('nim',$edit2);
			$this->db->update('mahasiswa',$form2);
		}

	}
?>