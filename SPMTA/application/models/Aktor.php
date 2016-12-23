<?php
	class Aktor extends CI_Model{
		function __construct(){
			parent::__construct();
			$this->load->database();
			$this->load->library('session');
		}
		
		function setAktor($username,$password){
			$password = md5($password);
			$temp = $this->db->query('select * from admin where username="'.$username.'" and password="'.$password.'"')->row_array();
			if(count($temp)>0){
				$this->session->set_userdata('login',$temp['status']);
				$this->session->set_userdata('id',$temp['id_admin']);
				return true;
			}
			else false;
		}

		function getNama(){
			if(!$this->session->has_userdata('login'))
				return false;
			$temp = $this->db->query('select name as nama from admin where status="'.$this->session->userdata('login').'"')->row_array();
			return $temp['nama'];
		}

		function getStatus(){
			if(!$this->session->has_userdata('login'))
				return false;
			$temp = $this->db->query('select status from admin where status="'.$this->session->userdata('login').'"')->row_array();
			return $temp['status'];
		}
		
		function getAdmin($id){
			$query = $this->db->query("SELECT * FROM admin WHERE id_admin='".$id."'");
			
			return $query;
		}
		
		function update($id, $data){
			$this->db->where('id_admin', $id);
			$query= $this->db->update('admin', $data);
			return $query;
		}
		
	}
?>