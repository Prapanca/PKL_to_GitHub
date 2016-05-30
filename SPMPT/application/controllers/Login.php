<?php
	class Login extends CI_Controller{
		function __construct(){
			parent::__construct();
			$this->load->model("aktor");
			$this->load->helper('url');
		}
		
		function authentication(){
			if($this->input->post('username') === null){
				redirect("/Login");
				return;
			}
			if($this->input->post('password') === null){
				redirect("/Login");
				return;
			}
			if($this->aktor->setAktor($this->input->post('username'),$this->input->post('password')))
			{
				redirect("/Home");
			}
			else{
				redirect("/Login");
			}
		}
		
		public function index(){
			$this->load->view("login");
		}
	}
?>