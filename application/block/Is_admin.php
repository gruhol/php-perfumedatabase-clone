<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Is_admin {
	var $CI = FALSE;
	
	function __construct() {
		$this->CI =& get_instance();
		$this->CI->load->library('users');
		$this->CI->load->model('users_model');
	}
	
	function blok() {
		return 'is_admin';
	}
	
	function Wyswietl() {
		if ($this->CI->users->logged()) {
			if ($this->CI->users->is('admin')) {
				return '<a href="'.base_url().'admin" class="btn btn-light btn-sm">Admin panel</a>';
			}
		}
	}
}

?>