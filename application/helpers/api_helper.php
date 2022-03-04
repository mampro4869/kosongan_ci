<?php
	function api($data) {
		$url = "http://localhost/api/".$data;

		return $url;
	}

	function create_id() {	
		/* ID OTOMATIS */
			$r = rand();
      $u = uniqid(getmypid() . $r . (double)microtime()*1000000,true);
      $id = sha1(session_id().$u);

		return $id;
	}

	function dblog($tipe, $id_barang = null, $harga = null) {
		$CI =& get_instance();
		$isi = $CI->session->userdata();

		$data['log_id'] = create_id();
		$data['log_data'] = addslashes($CI->db->last_query());
		$data['log_tipe'] = strtoupper($tipe);
		$data['log_ip'] = ($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : 'UNKNOWN IP';
		$data['barang_id'] = $id_barang;
		$data['barang_harga'] = $harga;
		$data['log_when'] = date('Y-m-d H:i:s');
		$data['log_who'] = $isi['user_nama_lengkap'];

		$CI->db->insert('global.global_dblog', $data);

		$CI->db->affected_rows();
	}