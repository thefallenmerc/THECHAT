<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ControllerMain extends MY_Controller 
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$username = $this->session->username;
		if($username==null){
			$username = get_cookie('username');
			if($username==null){
				$username =  'Anonymous';
			}
		}
		$theme = $this->session->theme;
		if($theme==null){
			$theme = get_cookie('theme');
			if($theme==null){
				$theme =  'colorDefault';
			}
		}
		$this->session->set_userdata('theme', $theme);
		$this->session->set_userdata('username', $username);
		set_cookie('theme',$theme,60*60*24*30);
		set_cookie('username',$username,60*60*24*30);

		// // last seen msg

		$lastmsg = $this->session->lastmsg;
		if($lastmsg==null){
			$lastmsg = get_cookie('lastmsg');
			if($lastmsg==null){
				$lastmsg =  0;
			}
		}
		$newlastmsg = $this->ModelMain->getLastMsgID()->id;
		// if($newlastmsg - $lastmsg > 100)
		$this->session->set_userdata('lastmsg', $lastmsg);
		set_cookie('lastmsg',$lastmsg,60*60*24*30);


		// get chat
		$this->db->where('id >', $newlastmsg - 100);
		$messages = $this->db->get('chat');
		$messages = $messages->result();
		// echo $this->ModelMain->getLastMsgID()->id;


		// die;
		$this->renderTemplate(['username'=>$username, 'theme'=>$theme, 'messages' => $messages]);
	}

	public function setUsername(){
    	$this->load->library('form_validation');
    	$response = new stdClass();
    	$response->url = base_url();
    	$this->form_validation->set_rules("username","Username","required");
    	if($this->form_validation->run()==false){
    		$response->status = 500;
    		$response->message = validation_errors();
    	}
    	else{
    		$username = htmlspecialchars($this->input->post('username'));

    		$data = array(
    			'username' => $username,
    			'type' => 'nmc',
    			'message' => $this->session->username." changed to ".$username,
    		);
    		$result = $this->db->insert('chat',$data);

    		// change session values
			$this->session->set_userdata('username', $username);
			delete_cookie('username');
			set_cookie('username',$username,60*60*24*30);
    		$response->status = 200;
    		$response->message = $this->session->username." changed to ".$username;
    		// $response->message = '<div class="alert alert-info text-center">'."Username updated Successfully!".'</div>';
    	}
    	echo json_encode($response);
	}

	public function setTheme(){
    	$this->load->library('form_validation');
    	$response = new stdClass();
    	$response->url = base_url();
    	$theme = "colorDefault";
    		$theme = htmlspecialchars($this->input->post('theme'));
    		switch ($theme) {
    			case '1':
    				$theme = "colorRed";
    				break;
    			case '2':
    				$theme = "colorPurple";
    				break;
    			case '3':
    				$theme = "colorOrange";
    				break;

    			
    			default:
    				$theme = "colorDefault";
    				break;
    		}

    		// change session values
			$this->session->set_userdata('theme', $theme);
			delete_cookie('theme');
			set_cookie('theme',$theme,60*60*24*30);
    		$response->status = 200;
    		$response->theme = $theme;
    		$response->message = "Theme changed!";
    	echo json_encode($response);
	}

	public function sendMessage(){
    	$this->load->library('form_validation');
    	$response = new stdClass();
    	$response->url = base_url();
    	$this->form_validation->set_rules("message","Message","required");
    	if($this->form_validation->run()==false){
    		$response->status = 500;
    		$response->message = validation_errors();
    	}
    	else{
    		$message = htmlspecialchars($this->input->post('message'));
    		$data = array(
    			'username' => $this->session->username,
    			'type' => 'msg',
    			'message' => $message,
    		);
    		$result = $this->db->insert('chat',$data);
    		if($result==true){
    			$response->status = 200;
    			$response->message = 'Message sent Successfully!';
    		}
    		else{
    			$response->status = 500;
    			$response->message = '<div class="alert alert-info text-center">'."Message sending failed!".'</div>';
    			$response->additional = $message;
    		}
    	}
    	echo json_encode($response);

	}

	public function getUpdate(){

		if($this->input->post('action')=="getUpdate"){
			$lastmsg = $this->session->lastmsg;


			$newlastmsg = $this->ModelMain->getLastMsgID()->id;

			$this->db->where('id >', $lastmsg);
			$messages = $this->db->get('chat');
			$messages = $messages->result();
			foreach ($messages as $message) {
				$message->timestamp = explode(" ", $message->timestamp)[1];
			}
			// if($newlastmsg - $lastmsg > 100)
			$this->session->set_userdata('lastmsg', $newlastmsg);
			set_cookie('lastmsg',$newlastmsg,60*60*24*30);

			echo json_encode($messages);
		}

	}
}
