<?php
	class Tabel extends CI_Model{
		function __construct(){
			parent::__construct();
			$this->load->database();
			$this->load->library('session');
		}
		
		function getTabel_TA(){
			$query = $this->db->query("SELECT makalah_ta.nim, mahasiswa.name, makalah_ta.judul, dosen.nama as nama_dosen, mahasiswa.angkatan
					FROM makalah_ta, mahasiswa, dosen
					WHERE makalah_ta.nim = mahasiswa.nim
					AND makalah_ta.nip = dosen.nip");
			
			return($query->num_rows() > 0) ? $query->result(): NULL;
		}
		
		function getTabel_PKL(){
			$query = $this->db->query("SELECT makalah_pkl.nim, mahasiswa.name, makalah_pkl.judul, dosen.nama as nama_dosen, mahasiswa.angkatan
					FROM makalah_pkl, mahasiswa, dosen
					WHERE makalah_pkl.nim = mahasiswa.nim
					AND makalah_pkl.nip = dosen.nip");
			
			return($query->num_rows() > 0) ? $query->result(): NULL;
		}
		
		function detailTA($nim){
			$query = $this->db->query("SELECT makalah_ta.nim, mahasiswa.name, makalah_ta.judul, dosen.nama as nama_dosen, mahasiswa.angkatan
										FROM makalah_ta, mahasiswa, dosen
										WHERE makalah_ta.nim = mahasiswa.nim
										AND makalah_ta.nip = dosen.nip
										AND mahasiswa.nim = $nim");
			
			return($query->num_rows() > 0) ? $query->result(): NULL;
		}
	}
?>