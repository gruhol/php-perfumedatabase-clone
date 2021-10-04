<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Database extends CI_Controller
{
	/*
	* Konstruktor z funkcjami do operacji na bazie produktów
	*
	* @package     Perfume Base
	* @category    Database
	* @author      Wojciech Dąbrowski <dabrowskiw@gmail.com>
	* @link        http://example.com
	*/
	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url', 'language'));
		$this->load->library(array('layout', 'form_validation', 'session', 'users', 'Pagination'));
		$this->config->load('cms', TRUE);
		$this->load->model(array('users_model', 'database_model'));
		$this->lang->load(array('users', 'database'));

		//$this->output->enable_profiler(TRUE);
	}

	public function test() {
		
	}

	/*
	* Display all brands perfumes, first letter A
	*/
	public function brands($char = 'A') {

		$this->session->set_userdata('referred_from', uri_string());
		$t = array
			(
				'title' 	=> $this->lang->line('database_all_brands'),
				'h1' 		=> $this->lang->line('database_all_brands'),
				'brands' 	=> $this->database_model->get_brands($char)
			);
		$this->layout->blok('database/show_brands', 'content', $t);
		$this->layout->make('theme');
	}

	/*
	* Display all  perfumes nutes, first letter A
	* @param	   $id number
	* @return      object
	*/
	public function note($id_note) {
		$this->session->set_userdata('referred_from', uri_string());
		if ($id_note == NULL)
		{
			redirect('database/notes', 'refresh');
		}
		foreach ($this->database_model->get_note($id_note) as $data) {
			$t = array
			(
				'title' 				=> $this->lang->line('database_note').$data->name_note,
				'h1' 					=> $data->name_note,
				'name_note' 			=> $data->name_note,
				'note_description'		=> $data->note_description
			);
		}
		
		$this->layout->blok('database/show_note', 'content', $t);
		$this->layout->make('theme');
	}
	
	/*
	* Display all  perfumes nutes, first letter A
	* @return	object
	*/
	public function notes() {
		$this->session->set_userdata('referred_from', uri_string());
		$t = array
			(
				'title' 			=> $this->lang->line('database_notes'),
				'h1' 				=> $this->lang->line('database_notes'),
				'category_notes' 	=> $this->database_model->get_category_notes()
			);
			$t['notes'] = array();
			foreach ($t['category_notes'] as $notes) {
				$category = 'category'.$notes->id_category_note;
				$t[$category] = $this->database_model->get_notes_by_category($notes->id_category_note);
			}

		$this->layout->blok('database/show_notes', 'content', $t);
		$this->layout->make('theme');
		
	}

	/*
	* Display brand perfume
	* @param	   $id string
	* @return      object
	*/
	public function brand($id_brand = NULL, $start=0) {

		$this->session->set_userdata('referred_from', uri_string());
		if ($id_brand == NULL)
		{
			redirect('database/brands', 'refresh');
		}
		$brand = $this->database_model->get_brand($id_brand);
		foreach ($brand as $value)
		{
			$t = array
			(
				'id_brand'				=> $id_brand,
				'name_brand' 			=> $value->name_brand,
				'title' 				=> $value->name_brand,
				'description' 			=> $value->description_brand,
			);
		}

		$config = array(
			array(
				'field'   => 'type[]',
				'label'   => $this->lang->line('database_type'),
				'rules'   => 'trim'
			),
			array(
				'field'   => 'sex[]',
				'label'   => $this->lang->line('database_sex'),
				'rules'   => 'trim'
			),
		);
		$this->form_validation->set_rules($config);
		$css_style = $this->config->item('css_style_error', 'cms');
		$this->form_validation->set_error_delimiters("<div class='$css_style'>", "</div>");
		if ($this->form_validation->run() == TRUE) { 
			if (!empty($this->input->post('type[]'))) {
				$this->session->set_userdata('b_wheretype', $this->input->post('type[]'));
				$where = $this->session->userdata('b_wheretype');
			} else {
				$where = FALSE;
			}
			if (!empty($this->input->post('sex[]'))) {
				$this->session->set_userdata('b_sex', $this->input->post('sex[]'));
				$sex = $this->session->userdata('b_sex');
			} else {
				$sex = FALSE;
			}
			$this->session->set_userdata('id_brand_filtred', $id_brand);
		} else {
			if ($this->session->userdata('id_brand_filtred') == $id_brand) {
				if ($this->session->has_userdata('b_wheretype')) {
					$where = $this->session->userdata('b_wheretype');
				} else {
					$where = FALSE;
				}
				if ($this->session->has_userdata('b_sex')) {
					$sex = $this->session->userdata('b_sex');
				} else {
					$sex = FALSE;
				}
			} else {
				$this->session->unset_userdata('b_wheretype');
				$this->session->unset_userdata('b_sex');
				$sex = FALSE;
				$where = FALSE;
			}
			
		}

		$howmany = $this->database_model->howmany('products', $id_brand, $where, $sex);
		$config['base_url'] = base_url()."database/brand/$id_brand";
		$config['total_rows'] = $howmany;
		$config['per_page'] = '10';
		$config['uri_segment'] = 4; //który sement url odpowiada za liczenie per page
		$config['num_links'] = 5;
		$config['cur_tag_open'] = '<li class="page-link" aria-current="page" style="background-color: #c03a5e; color: #ffffff"><b>';
		$config['cur_tag_close'] = '</b></li>';
		$config['attributes'] = array('class' => 'page-link', 'style' => 'display:inline');
			
		$this->pagination->initialize($config);
		$t['pagination'] = $this->pagination->create_links();

		$t['howmany'] = $howmany;
		$t['products'] = $this->database_model->get_products_by_brand($id_brand, $where, $sex, $start, 10);
		$t['types'] = $this->database_model->get_types_by_filter('id_brand', $id_brand);
		$t['sexbrand'] = $this->database_model->get_sex_by_filter('id_brand', $id_brand);
		$t['wheretype'] = $where;
		$t['sex'] = $sex;
		$t['canonical'] = base_url()."database/brand/$id_brand/";
		$this->layout->blok('database/show_brand', 'content', $t);
		$this->layout->make('theme');
	}

	/*
	* Display all authors perfumes, first letter A
	*/
	public function authors($char = 'A') {

		$this->session->set_userdata('referred_from', uri_string());
		$t = array
			(
				'title' 	=> $this->lang->line('database_authors'),
				'h1' 		=> $this->lang->line('database_authors'),
				'authors' 	=> $this->database_model->get_authors($char)
			);
		$this->layout->blok('database/show_authors', 'content', $t);
		$this->layout->make('theme');
	}

	/*
	* Display author perfume
	* @param	   $id string
	* @return      object
	*/
	public function author($id = NULL) {

		$this->session->set_userdata('referred_from', uri_string());
		if ($id == NULL)
		{
			redirect('database/authors', 'refresh');
		}
		$author = $this->database_model->get_author($id);
		foreach ($author as $value)
		{
			$t = array
			(
				'author_name' 			=> $value->author_name,
				'title' 				=> $value->author_name,
				'author_description' 	=> $value->author_description,
			);
		}

		$this->layout->blok('database/show_author', 'content', $t);
		$this->layout->make('theme');
	}

	/*
	* Display products form database
	* @param	   null
	* @return      object
	*/
	public function index($start=0) {
		
		// session data help login on this site
		$this->session->set_userdata('referred_from', uri_string());
		$config = array(
			array(
				'field'   => 'type[]',
				'label'   => $this->lang->line('database_type'),
				'rules'   => 'trim'
			),
			array(
				'field'   => 'sex[]',
				'label'   => $this->lang->line('database_sex'),
				'rules'   => 'trim'
			),
			array(
				'field'   => 'brands[]',
				'label'   => $this->lang->line('database_brands'),
				'rules'   => 'trim'
			),
		);
		$this->form_validation->set_rules($config);
		$css_style = $this->config->item('css_style_error', 'cms');
		$this->form_validation->set_error_delimiters("<div class='$css_style'>", "</div>");
		if ($this->form_validation->run() == TRUE) { 
			if (!empty($this->input->post('type[]'))) {
				$this->session->set_userdata('wheretype', $this->input->post('type[]'));
				$where = $this->session->userdata('wheretype');
			} else {
				$where = FALSE;
			}
			if (!empty($this->input->post('sex[]'))) {
				$this->session->set_userdata('sex', $this->input->post('sex[]'));
				$sex = $this->session->userdata('sex');
			} else {
				$sex = FALSE;
			}
			if (!empty($this->input->post('brands[]'))) {
				$this->session->set_userdata('brands_input', $this->input->post('brands[]'));
				$brands_input = $this->session->userdata('brands_input');
			} else {
				$brands_input = FALSE;
			}
		} else {
			if ($this->session->has_userdata('wheretype')) {
				$where = $this->session->userdata('wheretype');
			} else {
				$where = FALSE;
			}
			if ($this->session->has_userdata('sex')) {
				$sex = $this->session->userdata('sex');
			} else {
				$sex = FALSE;
			}
			if ($this->session->has_userdata('brands_input')) {
				$brands_input = $this->session->userdata('brands_input');
			} else {
				$brands_input = FALSE;
			}
		}
		
		
		$t = array (
			'products' => $this->database_model->get_products($where, $sex, $brands_input, $start, 10),
			'title' => $this->lang->line('database_products')
		);

		$howmany = $this->database_model->howmany2($where, $sex, $brands_input);
		$config['base_url'] = base_url().'database/index';
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
		$t['types'] = $this->database_model->get_types();
		$t['brands'] = $this->database_model->get_brands_to_from();
		$t['wheretype'] = $where;
		$t['sex'] = $sex;
		$t['brands_input'] = $brands_input;
		$t['canonical'] = 'https://www.perfumepedia.org/database';
		$this->layout->blok('database/show_products', 'content', $t);
		$this->layout->make('theme');
	}
	/*
	* delete session filtred data form products
	* @param	   none
	* @return      none
	*/
	public function del_filters() {
		if ($this->session->userdata('referred_from')) {
			$this->session->unset_userdata('wheretype');
			$this->session->unset_userdata('sex');
			$this->session->unset_userdata('tester');
			$this->session->unset_userdata('brands_input');
			$referred_from = $this->session->userdata('referred_from');
			redirect($referred_from, 'refresh');
		} else {
			show_404();
		}
	}
	/*
	* delete session filtred data form brands
	* @param	   none
	* @return      none
	*/
	public function del_brand_filters() {
		if ($this->session->userdata('referred_from')) {
			$this->session->unset_userdata('b_wheretype');
			$this->session->unset_userdata('b_sex');
			$referred_from = $this->session->userdata('referred_from');
			redirect($referred_from, 'refresh');
		} else {
			show_404();
		}
	}		
	
	/*
	* Display product form database by some id
	* @param	   $id string
	* @return      object
	*/
	public function product($id = NULL) {
		$this->session->set_userdata('referred_from', uri_string());
		if ($id == NULL OR !$this->database_model->get_product($id))
		{
			show_404();
		}
		foreach ($this->database_model->get_product($id) as $data) {
			$t = array(
				'id_product' 		=> $data->id_product,
				'title'				=> $data->name_brand.' '.$data->product_name.' '.$data->name_type.' ('.$this->get_sex($data->sex).')',
				'product_name'		=> $data->product_name,
				'id_brand'			=> $data->id_brand,
				'name_brand' 		=> $data->name_brand,
				'creation_date'		=> $data->creation_date,
				'description' 		=> $data->description,
				'id_author'			=> $data->id_author,
				'author_name'		=> $data->author_name,
				'sex'				=> $this->get_sex($data->sex),
				'name_type'			=> $data->name_type,
				'short_type'		=> $data->short_type
			);
		}
		$t['capacity']				= $this->database_model->get_capacity($id);
		$t['int_love']				= $this->database_model->get_vote_stats($id, 'love');
		$t['int_islike']			= $this->database_model->get_vote_stats($id, 'like');
		$t['int_dislike']			= $this->database_model->get_vote_stats($id, 'dislike');
		$t['int_ihave']				= $this->database_model->get_vote_stats($id, 'ihave');
		$t['int_ihad']				= $this->database_model->get_vote_stats($id, 'ihad');
		$t['int_iwant']				= $this->database_model->get_vote_stats($id, 'iwant');
		$t['int_winter']			= $this->database_model->get_vote_stats($id, 'winter');
		$t['int_spring']			= $this->database_model->get_vote_stats($id, 'spring');
		$t['int_summer']			= $this->database_model->get_vote_stats($id, 'summer');
		$t['int_autumn']			= $this->database_model->get_vote_stats($id, 'autumn');
		$t['int_day']				= $this->database_model->get_vote_stats($id, 'day');
		$t['int_night']				= $this->database_model->get_vote_stats($id, 'night');
		$t['logged']				= $this->users->logged();
		$t['score']					= $this->database_model->get_user_vote_review($this->users->print_id_user(), $id, 'score');
		$t['textreview']			= $this->database_model->get_user_vote_review($this->users->print_id_user(), $id, 'textreview');
		$t['stars']					= $this->get_score_star($this->database_model->get_score_product($id)); //$this->get_score_star($t['score']); //brakuje pobranie sumy gwiazdek
		$t['starsint']				= $this->database_model->get_score_product($id);
		$t['staruserint']			= $this->database_model->get_staruserint($id);
		$t['image']					= $this->database_model->get_image_of_product($id);
		$t['base_note']				= $this->database_model->get_notes($id, 1);
		$t['head_note']				= $this->database_model->get_notes($id, 2);
		$t['heart_note']			= $this->database_model->get_notes($id, 3);
		$t['ranking'] 				= $this->database_model->get_ranking_note($id);
		
		$a = array (
			'reviewsdata' => $this->database_model->get_all_vote_reviews($id)
		);

		if ($this->users->logged()) {
			$id_user = $this->users->print_id_user();
			$t['love']						= $this->database_model->get_vote_user($id_user, $id, 'love');
			$t['like']						= $this->database_model->get_vote_user($id_user, $id, 'like');
			$t['dislike']					= $this->database_model->get_vote_user($id_user, $id, 'dislike');
			$t['ihave']						= $this->database_model->get_vote_user($id_user, $id, 'ihave');
			$t['ihad']						= $this->database_model->get_vote_user($id_user, $id, 'ihad');
			$t['iwant']						= $this->database_model->get_vote_user($id_user, $id, 'iwant');
			$t['winter']					= $this->database_model->get_vote_user($id_user, $id, 'winter');
			$t['spring']					= $this->database_model->get_vote_user($id_user, $id, 'spring');
			$t['summer']					= $this->database_model->get_vote_user($id_user, $id, 'summer');
			$t['autumn']					= $this->database_model->get_vote_user($id_user, $id, 'autumn');
			$t['day']						= $this->database_model->get_vote_user($id_user, $id, 'day');
			$t['night']						= $this->database_model->get_vote_user($id_user, $id, 'night');
			$t['user_vote_notes']			= $this->database_model->get_user_vote_notes($id_user, $id);
			$t['user_vote_base_note']		= $this->database_model->get_notes2($id, 1, $this->users->print_id_user());
			$t['user_vote_head_note']		= $this->database_model->get_notes2($id, 2, $this->users->print_id_user());
			$t['user_vote_heart_note']		= $this->database_model->get_notes2($id, 3, $this->users->print_id_user());
		}

		$config = array(
			array(
				'field'   => 'uservote',
				'label'   => $this->lang->line('database_score'),
				'rules'   => 'trim|integer|required|min_length[1]|max_length[1]'
					),
			array(
				'field'   => 'userreview',
				'label'   => $this->lang->line('database_review'),
				'rules'   => 'trim|max_length[5000]'
			)
		);

    $this->form_validation->set_rules($config);
	$css_style = $this->config->item('css_style_error', 'cms');
    $this->form_validation->set_error_delimiters("<div class=\"$css_style\">", "</div>");
		if ($this->form_validation->run() == FALSE) {
			$t['message'] = FALSE;
			$this->layout->blok('database/show_reviews', 'reviews', $a);
 			$this->layout->blok('database/show_product', 'content', $t);
			$this->layout->make('theme');
		} else {
			$datareview = array(
				'id_user' 		=> $this->users->print_id_user(),
				'id_product' 	=> $data->id_product,
				'score'			=> set_value('uservote'),
				'textreview'	=> set_value('userreview')
			);
			if ($this->database_model->save_review($datareview)) {
				$this->session->set_flashdata('message', $this->lang->line('database_thanks_for_your_review'));
				$this->session->set_flashdata('style', 'success');
				redirect("database/product/$id/#formreview");
			} else {
				$this->session->set_flashdata('message', $this->lang->line('database_thanks_for_your_review'));
				$this->session->set_flashdata('style', 'danger');
				log_message('error', 'Error save review from user.');
				redirect("database/product/$id/#formreview");
			}
		}
	}

	public function savevoteradio() {
		if (!$this->users->logged() OR ($this->input->post('loveradio') == null) OR ($this->input->post('id_product') == null)) {
			show_404();
		} else {
			$data_in = $this->input->post('loveradio');
			$id_product = $this->input->post('id_product');
			if ($data_in == 'love') {
				$data_out = array(
					'love' 			=> 1,
					'like' 			=> 0,
					'dislike' 		=> 0,
					'id_user' 		=> $this->users->print_id_user(),
					'id_product'	=> $id_product

				);
			} elseif ($data_in == 'like') {
				$data_out = array(
					'love' 			=> 0,
					'like' 			=> 1,
					'dislike' 		=> 0,
					'id_user' 		=> $this->users->print_id_user(),
					'id_product'	=> $id_product
				);
			} elseif ($data_in == 'dislike') {
				$data_out = array(
					'love' 			=> 0,
					'like' 			=> 0,
					'dislike' 		=> 1,
					'id_user' 		=> $this->users->print_id_user(),
					'id_product'	=> $id_product
				);
			} else {
				$data_out = array(
					'love' 			=> 0,
					'like' 			=> 0,
					'dislike' 		=> 0,
					'id_user' 		=> $this->users->print_id_user(),
					'id_product'	=> $id_product
				);
			}
			
			if ($this->database_model->save_vote($data_out, $this->users->print_id_user(), $id_product)) {
				$data_to_show = array(
					'love' 		=> $this->database_model->get_vote_stats($id_product, 'love'),
					'like'		=> $this->database_model->get_vote_stats($id_product, 'like'),
					'dislike'	=> $this->database_model->get_vote_stats($id_product, 'dislike')
				);
				echo json_encode(array('status' => TRUE, 'value' => $data_to_show));
			} else {
				echo json_encode(array('status' => FALSE));
			}
		}
	}

	public function savevote() {
		if (!$this->users->logged() OR ($this->input->post('vote') == null) OR ($this->input->post('value') == null) OR ($this->input->post('id_product') == null)) {
			show_404();
		} else {
			$vote = $this->input->post('vote');
			$value = $this->input->post('value');
			$id_product = $this->input->post('id_product');
			$data_out = array(
				$vote 				=> $value,
				'id_user' 			=> $this->users->print_id_user(),
				'id_product'		=> $id_product
			);
			if ($this->database_model->save_vote($data_out, $this->users->print_id_user(), $id_product)) {
				echo json_encode(array('status' => TRUE));
			} else {
				echo json_encode(array('status' => FALSE));
			}
		}
	}

	public function get_vote_stat() {
		if (!$this->users->logged() OR ($this->input->post('vote') == null) OR ($this->input->post('id') == null)) {
			show_404();
		} else {
			$vote = $this->input->post('vote');
			$id = $this->input->post('id');
			$value = $this->database_model->get_vote_stats($id, $vote);
			if ($value) {
				echo json_encode(
					array(
						'status' => TRUE,
						'value' => $value
					)
				);
			} elseif ($value == 0) {
				echo json_encode(
					array(
						'status' => TRUE,
						'value' => $value
					)
				);
			} else {
				echo json_encode(
					array(
						'status' => FALSE,
						'value' => FALSE,
					)
				);
			}
		}
	}

	function save_vote_note() {
		if (
			!$this->users->logged() 
			OR ($this->input->post('id_note') == null) 
			OR ($this->input->post('vote_value') == null) 
			OR ($this->input->post('id_product') == null)
			) 
		{
			show_404();
		} else {
			$t['id_user']		= $this->users->print_id_user();
			$t['id_product']	= $this->input->post('id_product');
			$t['id_note']		= $this->input->post('id_note');
			$t['vote_value']	= $this->input->post('vote_value');
			
			$value = $this->database_model->save_note_stats($t);
			if ($value) {
				echo json_encode(
					array(
						'status' 			=> TRUE,
						'value'				=> $this->database_model->get_ranking_note($t['id_product'])
					)
				);
			} else {
				echo json_encode(
					array(
						'status' 			=> FALSE,
						//'value'				=> $t
					)
				);
			}		
		}
	}

	public function del_review($id_product) {
		if (!$this->users->logged() OR !isset($id_product)) {
			show_404();
		} else {
			
			if ($this->database_model->del_review($id_product, $this->users->print_id_user())) {
				$this->session->set_flashdata('message', $this->lang->line('database_review_deleted'));
				$this->session->set_flashdata('style', 'success');
				redirect("database/product/$id_product/#formreview");
			} else {
				$this->session->set_flashdata('message', $this->lang->line('database_review_deleted_error'));
				$this->session->set_flashdata('style', 'danger');
				redirect("database/product/$id_product/#formreview");
			}
		}
	}

	private function get_sex($code) {
		switch ($code) {
		    case 1:
		        return $this->lang->line('database_female');
		        break;
		    case 2:
		        return $this->lang->line('database_male');
		        break;
		    case 3:
		        return $this->lang->line('database_unisex');
		        break;
		}
	}
	/* pełna gwiazda <i class="fas fa-star"></i>
		 pusta gwiazda <i class="far fa-star"></i>
		 połowa giwazdy <i class="fas fa-star-half-alt"></i>
	*/
	private function get_score_star($score) {
		if ($score >= 0 && $score < 0.5) {
			$star = '<i class="far fa-star"></i> ';
			$star .= '<i class="far fa-star"></i> ';
			$star .= '<i class="far fa-star"></i> ';
			$star .= '<i class="far fa-star"></i> ';
			$star .= '<i class="far fa-star"></i> ';
			return $star;
		} 
		elseif ($score >= 0.5 && $score < 1) {
			$star = '<i class="fas fa-star-half-alt"></i>';
			$star .= '<i class="far fa-star"></i> ';
			$star .= '<i class="far fa-star"></i> ';
			$star .= '<i class="far fa-star"></i> ';
			$star .= '<i class="far fa-star"></i> ';
			return $star;
		} 
		elseif ($score >= 1 && $score < 1.5) {
			$star = '<i class="fas fa-star"></i> ';
			$star .= '<i class="far fa-star"></i> ';
			$star .= '<i class="far fa-star"></i> ';
			$star .= '<i class="far fa-star"></i> ';
			$star .= '<i class="far fa-star"></i> ';
			return $star;
		} 
		elseif ($score >= 1.5 && $score < 2) {
			$star = '<i class="fas fa-star"></i> ';
			$star .= '<i class="fas fa-star-half-alt"></i> ';
			$star .= '<i class="far fa-star"></i> ';
			$star .= '<i class="far fa-star"></i> ';
			$star .= '<i class="far fa-star"></i> ';
			return $star;
		} 
		elseif ($score >= 2 && $score < 2.5) {
			$star = '<i class="fas fa-star"></i> ';
			$star .= '<i class="fas fa-star"></i> ';
			$star .= '<i class="far fa-star"></i> ';
			$star .= '<i class="far fa-star"></i> ';
			$star .= '<i class="far fa-star"></i> ';
			return $star;
		} 
		elseif ($score >= 2.5 && $score < 3) {
			$star = '<i class="fas fa-star"></i> ';
			$star .= '<i class="fas fa-star"></i> ' ;
			$star .= '<i class="fas fa-star-half-alt"></i> ';
			$star .= '<i class="far fa-star"></i> ';
			$star .= '<i class="far fa-star"></i> ';
			return $star;
		} 
		elseif ($score >= 3 && $score < 3.5) {
			$star = '<i class="fas fa-star"></i> ';
			$star .= '<i class="fas fa-star"></i> ';
			$star .= '<i class="fas fa-star"></i> ';
			$star .= '<i class="far fa-star"></i> ';
			$star .= '<i class="far fa-star"></i> ';
			return $star;
		} 
		elseif ($score >= 3.5 && $score < 4) {
			$star = '<i class="fas fa-star"></i> ';
			$star .= '<i class="fas fa-star"></i> ';
			$star .= '<i class="fas fa-star"></i> ';
			$star .= '<i class="fas fa-star-half-alt"></i> ';
			$star .= '<i class="far fa-star"></i> ';
			return $star;
		} 
		elseif ($score >= 4 && $score < 4.5) {
			$star = '<i class="fas fa-star"></i> ';
			$star .= '<i class="fas fa-star"></i> ';
			$star .= '<i class="fas fa-star"></i> ';
			$star .= '<i class="fas fa-star"></i> ';
			$star .= '<i class="far fa-star"></i> ';
			return $star;
		} 
		elseif ($score >= 4.5 && $score == 5) {
			$star = '<i class="fas fa-star"></i> ';
			$star .= '<i class="fas fa-star"></i> ';
			$star .= '<i class="fas fa-star"></i> ';
			$star .= '<i class="fas fa-star"></i> ';
			$star .= '<i class="fas fa-star"></i>';
			return $star;
		}
	}
}

/* End of file Database.php */
/* Location: ./system/application/controllers/Database.php */