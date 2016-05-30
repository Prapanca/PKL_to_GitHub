<?php
	class CRUD_Model extends CI_Model{
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
		
		function submitTA(){
			$form = array(
				'nim' => $this->input->post('nim'),
				'nip' => $this->input->post('nip'),
				'judul' => $this->input->post('judul'),
			);
			$this->db->insert('makalah_ta',$form);
			
			$form2 = array(
				'nim' => $this->input->post('nim'),
				'name' => $this->input->post('name'),
				'angkatan' => $this->input->post('angkatan'),
			);
			$this->db->insert('mahasiswa',$form2);
		}
		
		function detailTA($nim){
			$query = $this->db->query("SELECT makalah_ta.nim, mahasiswa.name, makalah_ta.judul, dosen.nama as nama_dosen, 
											mahasiswa.angkatan, mahasiswa.foto, makalah_ta.doc, makalah_ta.pdf
										FROM makalah_ta, mahasiswa, dosen
										WHERE makalah_ta.nim = mahasiswa.nim
										AND makalah_ta.nip = dosen.nip
										AND mahasiswa.nim = $nim");
			
			return($query->num_rows() > 0) ? $query->result(): NULL;
		}
		
		function editTA($nim){
			$query = $this->db->query("SELECT makalah_ta.nim, mahasiswa.name, makalah_ta.judul, dosen.nama as nama_dosen, mahasiswa.angkatan
										FROM makalah_ta, mahasiswa, dosen
										WHERE makalah_ta.nim = mahasiswa.nim
										AND makalah_ta.nip = dosen.nip
										AND mahasiswa.nim = $nim");
			
			return($query->num_rows() > 0) ? $query->result(): NULL;
		}
		
		function deleteTA($nim){
			$this->db->where('nim', $nim);
			$this->db->delete('mahasiswa');
			
			$this->db->where('nim', $nim);
			$this->db->delete('makalah_ta');
		}
		
		function update(){
			$edit = $this->input->post('nim');
			$form = array(
				'nim' => $this->input->post('nim'),
				'nip' => $this->input->post('nip'),
				'judul' => $this->input->post('judul'),
			);
			$this->db->where('nim',$edit);
			$this->db->update('makalah_ta',$form);
			
			$edit2 = $this->input->post('nim');
			$form2 = array(
				'nim' => $this->input->post('nim'),
				'name' => $this->input->post('name'),
				'angkatan' => $this->input->post('angkatan'),
			);
			$this->db->where('nim',$edit2);
			$this->db->update('mahasiswa',$form2);
		}
	}
?>