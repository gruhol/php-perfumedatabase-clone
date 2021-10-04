<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Infolog {
	var $CI = FALSE;
	
	function __construct() {
		$this->CI =& get_instance();
		$this->CI->load->library('users');
		$this->CI->load->model('users_model');
	}
	
	function blok() {
		return 'infolog';
	}
	
	function Wyswietl() {
		if ($this->CI->users->logged()) {
			$t = array (
				'infolog' => $this->CI->users->print_user()
			);
			return $this->CI->load->view('user/info_log_1', $t, TRUE);
		} else {
			$t = NULL;
			return $this->CI->load->view('user/info_log_0', $t, TRUE);
		}
	}
}

?>