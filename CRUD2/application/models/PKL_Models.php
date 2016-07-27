<?php
	class PKL_Models extends CI_Model{
		function __construct(){
			parent::__construct();
			$this->load->database();
			$this->load->library('session');
		}
		
		function getTabelPKL(){
			$query = $this->db->query("SELECT makalah_pkl.nim, mahasiswa.name, makalah_pkl.judul, dosen.nama as nama_dosen, mahasiswa.angkatan
										FROM makalah_pkl, mahasiswa, dosen
										WHERE makalah_pkl.nim = mahasiswa.nim
										AND makalah_pkl.nip = dosen.nip");
			
			return($query->num_rows() > 0) ? $query->result(): NULL;
		}
		
		function dosen(){
			$query = $this->db->query('SELECT * FROM dosen');
			
			return($query->num_rows() > 0) ? $query->result(): NULL;
		}
		
		function submitPKL($namaFile = null){
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
			$this->db->insert('makalah_pkl',$form);
			
			//insrt aktifitas
			$data = array('id_admin'=>1, 'aksi'=>'Menambahkan dokumen PKL', 'tujuan'=>0);
			$this->db->insert('aktifitas',$data);
			
			$form2 = array(
				'nim'		=> $this->input->post('nim'),
				'name'		=> $this->input->post('name'),
				'angkatan'	=> $this->input->post('angkatan'),
				'foto'		=> $namaFile['foto']
			);
			$this->db->insert('mahasiswa',$form2);
		}
		
		function detailPKL($nim){
			$query = $this->db->query("SELECT makalah_pkl.nim, mahasiswa.name, makalah_pkl.judul, dosen.nama as nama_dosen, 
											mahasiswa.angkatan, mahasiswa.foto, makalah_pkl.doc, makalah_pkl.pdf, makalah_pkl.ppt, makalah_pkl.source_code, makalah_pkl.artikel_ilmiah, makalah_pkl.lampiran
										FROM makalah_pkl, mahasiswa, dosen
										WHERE makalah_pkl.nim = mahasiswa.nim
										AND makalah_pkl.nip = dosen.nip
										AND mahasiswa.nim = $nim");
			
			return($query->num_rows() > 0) ? $query->result(): NULL;
		}
		
		function editPKL($nim){
			$query = $this->db->query("SELECT makalah_pkl.nim, mahasiswa.name, makalah_pkl.judul, mahasiswa.angkatan
										FROM makalah_pkl, mahasiswa
										WHERE makalah_pkl.nim = mahasiswa.nim
										AND mahasiswa.nim = $nim");
			
			return($query->num_rows() > 0) ? $query->result(): NULL;
		}
		
		function deletePKL($nim){
			
			$this->db->where('nim', $nim);
			$this->db->delete('mahasiswa');
			
			$this->db->where('nim', $nim);
			$this->db->delete('makalah_pkl');
			
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
			$this->db->update('makalah_pkl',$form);
			
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