<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Page_model extends CI_Model {

	function __construct() {
        parent::__construct();
    }
	function get_page($id) {
        $this->db->where('id_page', $id);
		$query = $this->db->get('pages');
		if (!$query->num_rows()) return FALSE;
		return $query->result();
    } 
}