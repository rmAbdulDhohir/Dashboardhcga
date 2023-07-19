<?php 

function check_auth()
{
	$ci =& get_instance();

	// cek login
	if ($ci->session->userdata('userlogin')) {
		
		// update cookie jika cookie masih ada
		if (get_cookie('userlogin')) {
			// mengambil semua config CI
			$cf =& get_config();
			// mengisi batas dengan config[batas] CI
			$limit = $cf['limit'];
			// update cookie
			set_cookie('userlogin','login', $limit);
		} else {
			redirect('sw-admin/auth/logout');
		}

	}
}

function is_allowed($group_id)
{
	// mengambil core ci 
	$ci =& get_instance();

	// mengambil url
	$current_url = $ci->uri->segment(1).'/'.$ci->uri->segment(2).'/'.$ci->uri->segment(3);
	$current_url = trim($current_url,"/");

	// cek di database
	$ci->db->where('a.group_id', $group_id);
	$ci->db->where('m.module_status', 1);
	$ci->db->where('m.module_url', $current_url);
	$ci->db->join('module m', 'a.module_id = m.module_id');
	$qry = $ci->db->get('access a');

	// jika ada
	if($qry->num_rows() > 0) {
		return TRUE;
	} else {
		return FALSE;
	}
}


