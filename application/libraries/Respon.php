<?php 

class Respon
{
	function __construct()
	{
		// menggabungkan controller ci ke variabel $this->ci
		// $this->ci =& get_instance();
		// load model menu
		// $this->ci->load->model('Maccess');
	}

	function createRespon($code = 200, $msg = 'OK', $data)
	{
		header('Content-Type: application/json');

		$pesan = array(
		  'status_code' => $code,
		  'message' => $msg,
		  'data' => $data
		);
		return json_encode($pesan);
	  }
}
