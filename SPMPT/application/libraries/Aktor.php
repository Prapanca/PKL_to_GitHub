<?php 
	class Aktor{
		function __construct(){
			$this->CI=&get_instance();
			$this->getLibrary("session");
		}
		function getModel($a){
			$this->CI->load->model($a);
			$this->$a=$this->CI->$a;
		}
		function getLibrary($a){
			$this->CI->load->library($a);
			$this->$a=$this->CI->$a;
		}
		public function getTabel(){
			
		}
		public function getForm(){
			
		}
	}
?>