<?php
	class CRUD extends CI_Controller{
		function __construct(){
			parent::__construct();
			$this->load->model('crud_model');
			$this->load->helper(array('form', 'url'));
			$this->load->helper('url');
			$this->load->library('session');	
		}
		
		public function index(){
			$data['row'] = $this->crud_model->getTabelTA();
			$this->load->view('tabel_ta', $data);
		}
		
		function tabel_ta(){
			$data['row'] = $this->crud_model->getTabelTA();
			$this->load->view('tabel_ta', $data);
		}
		
		function form_ta(){
			$this->load->view('form_ta',  array('error' => ' ','dosen'=> $this->crud_model->dosen()));
		}
		
		function submitTA(){
			$config							= array();
			$config['upload_path']          = './uploads/';
			$config['allowed_types']        = 'gif|jpg|png|pdf';
			$config['max_size']             = 100000;
			$config['max_width']            = 5000;
			$config['max_height']           = 5000;
			
			$this->load->library('upload');

			$files = $_FILES;
			$cpt = count($_FILES['foto']['name']);
			for($i=0; $i<$cpt; $i++)
			{
				$_FILES['foto']['name']= $files['foto']['name'][$i];
				$_FILES['foto']['type']= $files['foto']['type'][$i];
				$_FILES['foto']['tmp_name']= $files['foto']['tmp_name'][$i];
				$_FILES['foto']['error']= $files['foto']['error'][$i];
				$_FILES['foto']['size']= $files['foto']['size'][$i];    

				$this->upload->initialize($config);
				$this->upload->do_upload('foto');
			}
			
			$data							= array();
			$data['upload_path']          = './uploads/';
			$data['allowed_types']        = 'pdf|ppt|pptx|doc|docx';
			$data['max_size']             = 100000;
			$data['max_width']            = 100000;
			$data['max_height']           = 100000;
			
			$this->load->library('upload');

			$files = $_FILES;
			$cpt = count($_FILES['file']['name']);
			for($i=0; $i<$cpt; $i++)
			{
				$_FILES['file']['name']= $files['file']['name'][$i];
				$_FILES['file']['type']= $files['file']['type'][$i];
				$_FILES['file']['tmp_name']= $files['file']['tmp_name'][$i];
				$_FILES['file']['error']= $files['file']['error'][$i];
				$_FILES['file']['size']= $files['file']['size'][$i];    

				$this->upload->initialize($data);
				$this->upload->do_upload('file');
			}
			
			$this->crud_model->submitTA();
			redirect ('CRUD/tabel_ta');
			
			/*$config['upload_path']          = './uploads/';
			$config['allowed_types']        = 'gif|jpg|png|pdf';
			$config['max_size']             = 100000;
			$config['max_width']            = 5000;
			$config['max_height']           = 5000;

			$this->load->library('upload', $config);
			
			if ( ! $this->upload->do_upload('foto'))
			{
					$error = array('error' => $this->upload->display_errors());

					$this->load->view('form_ta', $error);
			}
			else
			{
					$data = array('upload_data' => $this->upload->data());

					$this->load->view('upload_success', $data);
			}*/
		}
		
		function detailTA($nim){
			$data['row'] = $this->crud_model->detailTA($nim);
			$this->load->view('detail_ta', $data);
		}
		
		function editTA($nim){
			$data['row'] = $this->crud_model->editTA($nim);
			$this->load->view('form_ta_edit', $data);
		}
		
		function deleteTA($nim){
			$this->crud_model->deleteTA($nim);
			redirect ('CRUD/tabel_ta');
		}
		
		function update(){
			$this->crud_model->update();
			redirect ('CRUD/tabel_ta');
		}
		
		function form_ta_edit(){
			$data ['dosen'] = $this->crud_model->dosen();
			$this->load->view('form_ta_edit', $data);
		}
		
	}
?>