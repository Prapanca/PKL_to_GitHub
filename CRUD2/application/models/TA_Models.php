<?php
	class TA_Models extends CI_Model{
		function __construct(){
			parent::__construct();
			$this->load->database();
			$this->load->library('session');
		}
		
		function getTabelTA(){
			$query = $this->db->query("SELECT makalah_ta.nim, mahasiswa.name, makalah_ta.judul, dosen.nama as nama_dosen, mahasiswa.angkatan
										FROM makalah_ta, mahasiswa, dosen
										WHERE makalah_ta.nim = mahasiswa.nim
										AND makalah_ta.nip = dosen.nip");
			
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
				'doc'	=> $namaFile['doc'],
				'pdf'	=> $namaFile['pdf'],
				'ppt'	=> $namaFile['ppt'],
				'source_code'		=> $namaFile['source_code'],
				'artikel_ilmiah'	=> $namaFile['artikel_ilmiah'],
				'lampiran'			=> $namaFile['lampiran']
			);
			$this->db->insert('makalah_ta',$form);
			
			//insrt aktifitas
			$data['status'] = $this->aktor->getStatus();
			$data = array('id_admin' => $data['status'], 'aksi'=>'Menambahkan Dokumen Makalah Tugas Akhir', 'tujuan'=>0);
			$this->db->insert('aktifitas',$data);
			
			$form2 = array(
				'nim'		=> $this->input->post('nim'),
				'name'		=> $this->input->post('name'),
				'angkatan'	=> $this->input->post('angkatan'),
				'foto'		=> $namaFile['foto']
			);
			$this->db->insert('mahasiswa',$form2);
		}
		
		function detailTA($nim){
			$query = $this->db->query("SELECT makalah_ta.nim, mahasiswa.name, makalah_ta.judul, dosen.nama as nama_dosen, 
											mahasiswa.angkatan, mahasiswa.foto, makalah_ta.doc, makalah_ta.pdf, makalah_ta.ppt, makalah_ta.source_code, makalah_ta.artikel_ilmiah, makalah_ta.lampiran
										FROM makalah_ta, mahasiswa, dosen
										WHERE makalah_ta.nim = mahasiswa.nim
										AND makalah_ta.nip = dosen.nip
										AND mahasiswa.nim = $nim");
			
			return($query->num_rows() > 0) ? $query->result(): NULL;
		}
		
		function editTA($nim){
			$query = $this->db->query("SELECT makalah_ta.nim, mahasiswa.name, makalah_ta.judul, mahasiswa.angkatan
										FROM makalah_ta, mahasiswa
										WHERE makalah_ta.nim = mahasiswa.nim
										AND mahasiswa.nim = $nim");
			
			return($query->num_rows() > 0) ? $query->result(): NULL;
		}
		
		function deleteTA($nim){
			
			$this->db->where('nim', $nim);
			$this->db->delete('mahasiswa');
			
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
				'nim' => $this->input->post('nim'),
				'nip' => $this->input->post('nip'),
				'judul' => $this->input->post('judul'),
				'doc'	=> $namaFile['doc'],
				'pdf'	=> $namaFile['pdf'],
				'ppt'	=> $namaFile['ppt'],
				'source_code'		=> $namaFile['source_code'],
				'artikel_ilmiah'	=> $namaFile['artikel_ilmiah'],
				'lampiran'			=> $namaFile['lampiran']
			);
			$this->db->where('nim',$edit);
			$this->db->update('makalah_ta',$form);
			
			//insrt aktifitas
			$data['status'] = $this->aktor->getStatus();
			$data = array('id_admin' => $data['status'], 'aksi'=>'Merubah Dokumen Makalah Tugas Akhir', 'tujuan'=>0);
			$this->db->insert('aktifitas',$data);
			
			$edit2 = $this->input->post('nim');
			$form2 = array(
				'nim' => $this->input->post('nim'),
				'name' => $this->input->post('name'),
				'angkatan' => $this->input->post('angkatan'),
				'foto'		=> $namaFile['foto']
			);
			$this->db->where('nim',$edit2);
			$this->db->update('mahasiswa',$form2);
		}
	}
?>