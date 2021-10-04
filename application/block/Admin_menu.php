<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_menu {
	var $CI = FALSE;
	
	function __construct() {
		$this->CI =& get_instance();
		$this->CI->load->library('users');
		$this->CI->load->model('users_model');
	}
	
	function blok() {
		return 'admin_menu';
	}
	
	function Wyswietl() {
		$t = array();
		return $this->CI->load->view('admin/admin_menu', $t, TRUE);
	}
}

?>