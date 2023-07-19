<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Auth extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		// memanggil model
		$this->load->model('Auth_model');

	}

	function index()
	{
		// cek login
		if ($this->session->userdata('userlogin'))
		{
			redirect('admin/dashboard');
		}



		$this->form_validation->set_rules("user_name","User Name","required|trim");
		if ($this->form_validation->run()==false)
		{
			$data['error'] = validation_errors();
		}
		else
		{
			// eksekusi login
			$cek = $this->auth_model->login($this->input->post('user_name'),$this->input->post('password'));

			// jika login berhasil
			if ($cek==TRUE) {
				$this->session->set_flashdata('msg', alert('Login Success','info'));
				redirect('admin/dashboard');
			} else {
				// membuat pesan gagal
				$this->session->set_flashdata('msg', alert('Login Failed username/password salah','danger'));
				redirect('admin/auth');
			}
		}

		$this->load->view('admin/login',$data);
	}

	function logout()
	{
		// menghapus data session
		$this->session->unset_userdata('userlogin');
		// alihkan ke halaman auth
		redirect('admin/auth');
	}

}
