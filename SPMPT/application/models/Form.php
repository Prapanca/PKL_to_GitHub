<?php
	class Form extends CI_Model{
		function __construct(){
			parent::__construct();
			$this->load->database();
			$this->load->library('session');
		}
		
		function savedata($namatabel, $data){
			
			$this->db->insert($namatabel, $data);
		}
		
		function getNama(){
			$query = $this->db->query("SELECT * FROM dosen");
			
			return($query->num_rows() > 0) ? $query->result(): NULL;
		}
		
		function getTahun(){
			$query = $this->db->query("SELECT DISTINCT angkatan FROM mahasiswa");
			
			return($query->num_rows() > 0) ? $query->result(): NULL;
		}
		
		function update_TA($nim){
			$query = $this->db->query("SELECT makalah_ta.nim, mahasiswa.name, makalah_ta.judul, dosen.nama as nama_dosen, mahasiswa.angkatan
										FROM makalah_ta, mahasiswa, dosen
										WHERE makalah_ta.nim = mahasiswa.nim
										AND makalah_ta.nip = dosen.nip
										AND mahasiswa.nim = $nim");
			
			return($query->num_rows() > 0) ? $query->result(): NULL;
		}
	}
?>