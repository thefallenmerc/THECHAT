<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 */
class ModelMain extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function getLastMsgID(){
		$this->db->select('id');
		$this->db->order_by('id','DESC');
		$this->db->from('chat');
		$result = $this->db->get();
		return $result->row();
	}
}

 ?>