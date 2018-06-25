<?php 
/**
 * 
 */
class MY_Controller extends CI_Controller 
{
	
	function __construct()
	{
		# code...
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('cookie');
		$this->load->library('session');
		$this->load->model('ModelMain');
		$this->load->database();
	}

	function renderTemplate($data){
	if(!isset($data['title']))
		$data['title'] = "The Chattenger";
	if(!isset($data['page']))
		$data["page"] = 'landing';
		$data['site_name'] = "THECHAT";
		$this->load->view('Template/header', $data);
		$this->load->view('Template/navbar', $data);
		$this->load->view($data['page'], $data);
		$this->load->view('Template/footer', $data);

	}
}
 ?>