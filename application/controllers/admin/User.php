<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class User extends CI_Controller
{
	// public $group_id;
	// public $user_group;
	// public $userdata;
	function __construct()
	{
		parent::__construct();
		
	// 	// cek login
		if (! $this->session->userdata('userlogin'))
		{
			$this->session->set_flashdata('msg', alert('You must login','danger'));
			redirect('sw-admin/auth');
		}

	// 	// update cookie
	// 	check_auth();

	// 	// memanggil library
		$this->load->library('Themes');
		// $this->load->helper('url');
	// 	$this->load->model("Moption");
	// 	$this->group_id = $this->Moption->get_option("super_admin");


	// 	$user = $this->session->userdata("userlogin");
	// 	$this->userdata = $user;
	// 	$this->user_group = $user['group_id'];
	}

	function index()
	{
		// if ($this->group_id==$this->user_group)
		// {
		// 	$data['super_admin'] = true;
		// }
		// else
		// {
		// 	$data['super_admin'] = false;
		// }
		// $data['userdata'] = $this->userdata;
		// $this->themes->set_ui('sw-admin/dashboard',$data);
		$this->themes->set_ui('admin/user');
	}

}
