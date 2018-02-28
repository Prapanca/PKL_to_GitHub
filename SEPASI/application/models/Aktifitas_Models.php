<?php
	class Aktifitas_Models extends CI_Model{
		function __construct(){
			parent::__construct();
			$this->load->database();
			$this->load->library('session');
		}
		
		function getAktifitas(){
			$query = $this->db->query("
										SELECT * FROM aktifitas 
										ORDER BY DATE_FORMAT(waktu, '%d-%M-%Y') DESC,
										         DATE_FORMAT(waktu, '%h:%i:%sa') ASC");
			
			return($query->num_rows() > 0) ? $query->result(): NULL;
		}
		
	}
?>