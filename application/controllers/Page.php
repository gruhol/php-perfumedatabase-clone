<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->helper(array('form', 'url', 'language'));
		$this->load->library(array('layout', 'users', 'pagination', 'form_validation', 'session'));
		$this->load->model(array('admin_model', 'users_model', 'page_model'));
		$this->config->load('cms', TRUE);
		$this->lang->load(array('users', 'database'));
	}

	public function showpage($id = NULL) {
		if ($id == NULL) {
			show_404();
		} else {
			$page = $this->page_model->get_page($id);
			if ($page == FALSE) return show_404();
			foreach ($page as $value) {
				$t = array(
					'page_name' 	=> $value->page_name,
					'title'			=> $value->page_title,
					'page_content'	=> $value->page_content,
				);
			}
			$this->layout->blok('page/page_show', 'content', $t);
			$this->layout->make('theme');

		}
	}
}
