<?php

class Auth_model extends CI_Model
{
	private $_table = "user";
	const SESSION_KEY = 'user_id';

	public function rules()
	{
		return [
			[
				'field' => 'username',
				'label' => 'Username or Email',
				'rules' => 'required'
			],
			[
				'field' => 'password',
				'label' => 'Password',
				'rules' => 'required|max_length[255]'
			]
		];
	}

	public function login($username, $password)
	{
		$this->db->where('username', $username);
		$query = $this->db->get('user');
		$user = $this->db->get('user')->row();
		
		// jika ada usernya
		if(!empty($user)) {

			// berhasil
			// cek apakah passwordnya benar?
			if (!password_verify($password, $user->password)) {
				return FALSE;
			}
			// mengambil data
			$data = $query->row_array();
				// menghapus password dari data
				unset($data['password']);
			// menyimpan data ke dalam session
			$this->session->set_userdata('userlogin', $data);
			$this->_update_last_login($user->id);

			// untuk batasan waktu login
			// mengambil semua config CI
			$cf =& get_config();
			// mengisi batas dengan config[batas] CI
			$limit = $cf['limit'];
			// seting cookie
			set_cookie('userlogin', 'login', $limit);

			return TRUE;
		} else {
			// gagal
			return FALSE;
		}
	}

	public function current_user()
	{
		if (!$this->session->has_userdata(self::SESSION_KEY)) {
			return null;
		}

		$user_id = $this->session->userdata(self::SESSION_KEY);
		$query = $this->db->get_where($this->_table, ['id' => $user_id]);
		return $query->row();
	}

	public function logout()
	{
		$this->session->unset_userdata(self::SESSION_KEY);
		return !$this->session->has_userdata(self::SESSION_KEY);
	}

	private function _update_last_login($id)
	{
		$data = [
			'last_login' => date("Y-m-d H:i:s"),
		];

		return $this->db->update('user', $data, ['id' => $id]);
	}
}
