<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends CI_Controller {

	/*
	* Konstruktor klasy Search
	*
	* @package     Perfume Base
	* @category    Search
	* @author      Wojciech Dąbrowski <dabrowskiw@gmail.com>
	* @link        http://example.com
	*/

	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url', 'language'));
		$this->load->library(array('layout', 'form_validation', 'session', 'users', 'pagination'));
		$this->config->load('cms', TRUE);
		$this->load->model(array('users_model', 'search_model'));
		$this->lang->load(array('users', 'database'));
	}

	/** Funkcja wyszukująca główna
	*
	* @access	public
	* @param	string
	* @return	object
	*/
	public function search($start=0) {
		$config = array(
			array(
				'field'   => 'search',
				'label'   => 'Wyszukiwane hasło',
				'rules'   => 'required|min_length[2]'
			)
		 );
		$this->form_validation->set_rules($config);
		$css_style = $this->config->item('css_style_error', 'cms');
    	$this->form_validation->set_error_delimiters("<div class=\"$css_style\">", "</div>");
		if ($this->form_validation->run() == FALSE) {

			if($this->input->post('search') !== NULL) {
				$search = FALSE;
				$this->session->unset_userdata('search');
				$search_keyword = $this->input->post('search');
			} elseif ($this->session->userdata('search') !== NULL) {
				$search = $this->session->userdata('search');
				$search_keyword = $this->session->userdata('search');
			} else {
				$search = FALSE;
				$search_keyword = '';
			}

		} else {
			$this->session->unset_userdata('search');
			$this->session->set_userdata('search', set_value('search'));
			redirect('search/search');
		}


		$t = array (
			'products' => $this->search_model->search($search, $start, 10),
			'title' => 'Wyszukiwarka'
		);
	
		$howmany = $this->search_model->howmany_search($search);
		$config['base_url'] = base_url().'search/search';
		$config['total_rows'] = $howmany;
		$config['per_page'] = '10';
		$config['uri_segment'] = 3;
		$config['num_links'] = 5;
		$config['cur_tag_open'] = '<li class="page-link" aria-current="page" style="background-color: #c03a5e; color: #ffffff"><b>';
		$config['cur_tag_close'] = '</b></li>';
		$config['attributes'] = array('class' => 'page-link', 'style' => 'display:inline');
				
		$this->pagination->initialize($config);
		$t['pagination'] = $this->pagination->create_links();
		$t['howmany'] = $howmany;
		$t['search_keyword'] = $search_keyword; 
		$this->layout->blok('search/search_result', 'content', $t);
		$this->layout->make('theme');
	}
	
	/*
	* delete session search text
	* @param	   none
	* @return      none
	*/
	public function del_search() {
		if ($this->session->userdata('referred_from')) {
			$this->session->unset_userdata('search');
			$referred_from = $this->session->userdata('referred_from');
			redirect('search/search', 'refresh');
		} else {
			show_404();
		}
	}
}

/* End of file Search.php */
/* Location: ./system/application/controllers/Search.php */