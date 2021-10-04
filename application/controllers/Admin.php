<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* User Class
* @package     Perfume Base
* @category    admin
* @author      Wojciech Dąbrowski <dabrowskiw@gmail.com>
* @link        http://example.com
*/

class Admin extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->helper(array('form', 'url', 'language'));
		$this->load->library(array('layout', 'users', 'pagination', 'form_validation', 'session'));
		$this->load->model(array('admin_model', 'users_model'));
		$this->config->load('cms', TRUE);
		$this->lang->load(array('users', 'database', 'admin'));
	}
	/*
	Index metod - admin panel. Show major data form database
	*/
	function index() {
		$this->session->set_userdata('referred_from', uri_string());
		if (!$this->users->is('admin')) {
			redirect('user/login_redirect');
		} else {
			$t = array(
				'title' 			=> $this->lang->line('admin_admin_panel'),
				'valueusers'		=> $this->admin_model->howmany('users'),
				'valueproducts'		=> $this->admin_model->howmany('products'),
				'valuebrands'		=> $this->admin_model->howmany('brands')
			);
			$this->layout->blok('admin/admin_dashboard', 'content', $t);
			$this->layout->make('admin');
		}
	}

	function test() {
		$xml = simplexml_load_file("http://www.drogeriada.pl/ceneo-id-1.xml") or die("Error: Cannot create object");
		echo '<pre>';
		//print_r($xml);
		echo '</pre>';
		echo '<table border="1">';
		foreach ($xml->children() as $row) {
			
			echo '<tr>';
			echo '<td>'.$row->name.'</td>';
			echo '<td>'.$row->desc.'</td>';
			echo '<td>'.$row->attrs['EAN'].'</td>';
			echo '<tr>';
		}
		echo '</table>';
	}

	function brand($start=0) {
		$this->session->set_userdata('referred_from', uri_string());
		if (!$this->users->is('admin')) {
			redirect('user/login_redirect');
		} else {
			$howmany = $this->admin_model->howmany("brands");
			$config['base_url'] = base_url().'admin/brand';
			$config['total_rows'] = $howmany;
			$config['per_page'] = '10';
			$config['uri_segment'] = 3;
			$config['num_links'] = 5;
			$config['cur_tag_open'] = '<li class="page-link page-link-red" aria-current="page"><b>';
			$config['cur_tag_close'] = '</b></li>';
			$config['attributes'] = array('class' => 'page-link', 'style' => 'display:inline');
				
			$this->pagination->initialize($config);
			$t['pagination'] = $this->pagination->create_links();
			$t['brand'] = $this->admin_model->get_brands($start, 10);
			$t['title'] = $this->lang->line('admin_admin_panel').' - '.$this->lang->line('admin_brands');
			$t['howmany'] = $howmany;
			if ($this->session->has_userdata('message_delete_brand')) {
				$t['message'] 	= $this->session->userdata('message_delete_brand');
				$t['alert'] 	= $this->session->userdata('alert_delete_brand');
				$this->session->unset_userdata('message_delete_brand');
				$this->session->unset_userdata('alert_delete_brand');
			} else if ($this->session->has_userdata('message_add_brand')) {
				$t['message'] 	= $this->session->userdata('message_add_brand');
				$t['alert'] 	= $this->session->userdata('alert_add_brand');
				$this->session->unset_userdata('message_add_brand');
				$this->session->unset_userdata('alert_add_brand');
			} else {
				$t['message'] 	= FALSE;
				$t['alert'] 	= FALSE;
			}
			$this->layout->blok('admin/admin_brands', 'content', $t);
			$this->layout->make('admin');
		}
	}

	function products($start=0) {
		$this->session->set_userdata('referred_from', uri_string());
		if (!$this->users->is('admin')) {
			redirect('user/login_redirect');
		} else {
			$howmany = $this->admin_model->howmany("products");
			$config['base_url'] = base_url().'admin/products';
			$config['total_rows'] = $howmany;
			$config['per_page'] = '10';
			$config['uri_segment'] = 3;
			$config['num_links'] = 5;
			$config['cur_tag_open'] = '<li class="page-link page-link-red" aria-current="page"><b>';
			$config['cur_tag_close'] = '</b></li>';
			$config['attributes'] = array('class' => 'page-link', 'style' => 'display:inline');
				
			$this->pagination->initialize($config);
			$t['pagination'] = $this->pagination->create_links();
			$t['products'] = $this->admin_model->get_products($start, 10);
			$t['title'] = $this->lang->line('admin_admin_panel').' - '.$this->lang->line('admin_products');
			$t['howmany'] = $howmany;
			if ($this->session->has_userdata('message_delete_product')) {
				$t['message'] 	= $this->session->userdata('message_delete_product');
				$t['alert'] 	= $this->session->userdata('alert_delete_product');
				$this->session->unset_userdata('message_delete_product');
				$this->session->unset_userdata('alert_delete_product');
			} else if ($this->session->has_userdata('message_add_product')) {
				$t['message'] 	= $this->session->userdata('message_add_product');
				$t['alert'] 	= $this->session->userdata('alert_add_product');
				$this->session->unset_userdata('message_add_product');
				$this->session->unset_userdata('alert_add_product');
			} else {
				$t['message'] 	= FALSE;
				$t['alert'] 	= FALSE;
			}
			$this->layout->blok('admin/admin_products', 'content', $t);
			$this->layout->make('admin');
		}
	}

	function notes($start=0) {
		$this->session->set_userdata('referred_from', uri_string());
		if (!$this->users->is('admin')) {
			redirect('user/login_redirect');
		} else {
			$howmany = $this->admin_model->howmany("notes");
			$config['base_url'] = base_url().'admin/notes';
			$config['total_rows'] = $howmany;
			$config['per_page'] = '10';
			$config['uri_segment'] = 3;
			$config['num_links'] = 5;
			$config['cur_tag_open'] = '<li class="page-link page-link-red" aria-current="page"><b>';
			$config['cur_tag_close'] = '</b></li>';
			$config['attributes'] = array('class' => 'page-link', 'style' => 'display:inline');
				
			$this->pagination->initialize($config);
			$t['pagination'] = $this->pagination->create_links();
			$t['notes'] = $this->admin_model->get_notes($start, 10);
			$t['title'] = $this->lang->line('admin_admin_panel').' - '.$this->lang->line('admin_nutes');
			$t['howmany'] = $howmany;
			if ($this->session->has_userdata('message_delete_note')) {
				$t['message'] 	= $this->session->userdata('message_delete_note');
				$t['alert'] 	= $this->session->userdata('alert_delete_note');
				$this->session->unset_userdata('message_delete_note');
				$this->session->unset_userdata('alert_delete_note');
			} else if ($this->session->has_userdata('message_add_note')) {
				$t['message'] 	= $this->session->userdata('message_add_note');
				$t['alert'] 	= $this->session->userdata('alert_add_note');
				$this->session->unset_userdata('message_add_note');
				$this->session->unset_userdata('alert_add_note');
			} else {
				$t['message'] 	= FALSE;
				$t['alert'] 	= FALSE;
			}
			$this->layout->blok('admin/admin_notes', 'content', $t);
			$this->layout->make('admin');
		}
	}

	function authors($start=0) {
		$this->session->set_userdata('referred_from', uri_string());
		if (!$this->users->is('admin')) {
			redirect('user/login_redirect');
		} else {
			$howmany = $this->admin_model->howmany("authors");
			$config['base_url'] = base_url().'admin/authors';
			$config['total_rows'] = $howmany;
			$config['per_page'] = '10';
			$config['uri_segment'] = 3;
			$config['num_links'] = 5;
			$config['cur_tag_open'] = '<li class="page-link" aria-current="page" style="background-color: #f0f0f0; color: #000000"><b>';
			$config['cur_tag_close'] = '</b></li>';
			$config['attributes'] = array('class' => 'page-link', 'style' => 'display:inline');
				
			$this->pagination->initialize($config);
			$t['pagination'] = $this->pagination->create_links();
			$t['authors'] = $this->admin_model->get_authors2($start, 10);
			$t['title'] = $this->lang->line('admin_admin_panel').' - '.$this->lang->line('admin_authors');
			$t['howmany'] = $howmany;
			if ($this->session->has_userdata('message_delete_note')) {
				$t['message'] 	= $this->session->userdata('message_delete_author');
				$t['alert'] 	= $this->session->userdata('alert_delete_author');
				$this->session->unset_userdata('message_delete_author');
				$this->session->unset_userdata('alert_delete_author');
			} else if ($this->session->has_userdata('message_add_author')) {
				$t['message'] 	= $this->session->userdata('message_add_author');
				$t['alert'] 	= $this->session->userdata('alert_add_author');
				$this->session->unset_userdata('message_add_author');
				$this->session->unset_userdata('alert_add_author');
			} else {
				$t['message'] 	= FALSE;
				$t['alert'] 	= FALSE;
			}
			$this->layout->blok('admin/admin_authors', 'content', $t);
			$this->layout->make('admin');
		}
	}

	function pages($start=0) {
		$this->session->set_userdata('referred_from', uri_string());
		if (!$this->users->is('admin')) {
			redirect('user/login_redirect');
		} else {
			$howmany = $this->admin_model->howmany("pages");
			$config['base_url'] = base_url().'admin/pages';
			$config['total_rows'] = $howmany;
			$config['per_page'] = '10';
			$config['uri_segment'] = 3;
			$config['num_links'] = 5;
			$config['cur_tag_open'] = '<li class="page-link" aria-current="page" style="background-color: #f0f0f0; color: #000000"><b>';
			$config['cur_tag_close'] = '</b></li>';
			$config['attributes'] = array('class' => 'page-link', 'style' => 'display:inline');
				
			$this->pagination->initialize($config);
			$t['pagination'] = $this->pagination->create_links();
			$t['page'] = $this->admin_model->get_pages($start, 10);
			$t['title'] = $this->lang->line('admin_admin_panel').' - '.$this->lang->line('admin_pages');
			$t['howmany'] = $howmany;
			if ($this->session->has_userdata('message_delete_page')) {
				$t['message'] 	= $this->session->userdata('message_delete_page');
				$t['alert'] 	= $this->session->userdata('alert_delete_page');
				$this->session->unset_userdata('message_delete_page');
				$this->session->unset_userdata('alert_delete_page');
			} else if ($this->session->has_userdata('message_add_page')) {
				$t['message'] 	= $this->session->userdata('message_add_page');
				$t['alert'] 	= $this->session->userdata('alert_add_page');
				$this->session->unset_userdata('message_add_page');
				$this->session->unset_userdata('alert_add_page');
			} else {
				$t['message'] 	= FALSE;
				$t['alert'] 	= FALSE;
			}
			$this->layout->blok('admin/admin_pages', 'content', $t);
			$this->layout->make('admin');
		}
	}

	function reviews($start=0) {
		$this->session->set_userdata('referred_from', uri_string());
		if (!$this->users->is('admin')) {
			redirect('user/login_redirect');
		} else {
			$howmany = $this->admin_model->howmany("vote_review");
			$config['base_url'] = base_url().'admin/reviews';
			$config['total_rows'] = $howmany;
			$config['per_page'] = '10';
			$config['uri_segment'] = 3;
			$config['num_links'] = 5;
			$config['cur_tag_open'] = '<li class="page-link" aria-current="page" style="background-color: #f0f0f0; color: #000000"><b>';
			$config['cur_tag_close'] = '</b></li>';
			$config['attributes'] = array('class' => 'page-link', 'style' => 'display:inline');
				
			$this->pagination->initialize($config);
			$t['pagination'] = $this->pagination->create_links();
			$t['reviews'] = $this->admin_model->get_reviews($start, 10);
			$t['title'] = $this->lang->line('admin_admin_panel').' - '.$this->lang->line('admin_users_reviews');
			$t['howmany'] = $howmany;
			if ($this->session->has_userdata('message_delete_review')) {
				$t['message'] 	= $this->session->userdata('message_delete_review');
				$t['alert'] 	= $this->session->userdata('alert_delete_review');
				$this->session->unset_userdata('message_delete_review');
				$this->session->unset_userdata('alert_delete_review');
			} else {
				$t['message'] 	= FALSE;
				$t['alert'] 	= FALSE;
			}
			$this->layout->blok('admin/admin_reviews', 'content', $t);
			$this->layout->make('admin');
		}
	}

	function edit_brand($id_brand) {
		$this->session->set_userdata('referred_from', uri_string());
		if (!$this->users->is('admin')) {
			redirect('user/login_redirect');
		} else {
			$config = array(
				array(
					'field'   => 'name_brand',
					'label'   => $this->lang->line('admin_brand_name'),
					'rules'   => 'trim|required|min_length[2]|max_length[150]'
				),
				array(
					'field'   => 'description',
					'label'   => $this->lang->line('admin_brand_description'),
					'rules'   => 'trim'
				)
			);
			$this->form_validation->set_rules($config);
			$css_style = $this->config->item('css_style_error', 'cms');
			$this->form_validation->set_error_delimiters("<div class='$css_style'>", "</div>");
			if ($this->form_validation->run() == TRUE) {
				$data = array(
					'id_brand' 				=> $id_brand,
					'name_brand'			=> $this->input->post('name_brand'),
					'description_brand'		=> $this->input->post('description_brand')
				);
				if ($brand = $this->admin_model->edit_brand($data)) {
					$message = $this->lang->line('admin_data_update_sucessfull');
					$alert 	 = 'alert alert-success';
				} else {
					$message = $this->lang->line('admin_data_update_error');
					$alert   = 'alert alert-danger';
				}
				$brand = $this->admin_model->get_brand($id_brand);
				foreach ($brand as $value)
				{
					$t = array (
						'id_brand'				=> $id_brand,
						'name_brand' 			=> $value->name_brand,
						'title' 				=> $this->lang->line('admin_admin_panel').' - '.$this->lang->line('admin_edit').$value->name_brand,
						'description_brand' 	=> $value->description_brand,
						'message'				=> $message,
						'alert'					=> $alert,
					);
				}
				$this->layout->blok('admin/edit_brands', 'content', $t);
				$this->layout->make('admin');
				
			} else {
				$brand = $this->admin_model->get_brand($id_brand);
				foreach ($brand as $value)
				{
					$t = array
					(
						'id_brand'				=> $id_brand,
						'name_brand' 			=> $value->name_brand,
						'title' 				=> $this->lang->line('admin_admin_panel').' - '.$this->lang->line('admin_edit').$value->name_brand,
						'description_brand' 	=> $value->description_brand,
						'message'				=> FALSE,
						'alert'					=> FALSE,
					);
				}
				$this->layout->blok('admin/edit_brands', 'content', $t);
				$this->layout->make('admin');
			}		
		}
	}

	function edit_page($id_page) {
		$this->session->set_userdata('referred_from', uri_string());
		if (!$this->users->is('admin')) {
			redirect('user/login_redirect');
		} else {
			$config = array(
				array(
					'field'   => 'page_name',
					'label'   => $this->lang->line('admin_page_name'),
					'rules'   => 'trim|required|min_length[2]|max_length[150]'
				),
				array(
					'field'   => 'page_content',
					'label'   => $this->lang->line('admin_page_content'),
					'rules'   => 'trim|required|min_length[2]'
				),
				array(
					'field'   => 'page_title',
					'label'   => $this->lang->line('admin_page_title'),
					'rules'   => 'trim|required|min_length[2]|max_length[100]'
				)
			);
			$this->form_validation->set_rules($config);
			$css_style = $this->config->item('css_style_error', 'cms');
			$this->form_validation->set_error_delimiters("<div class='$css_style'>", "</div>");
			if ($this->form_validation->run() == TRUE) {
				$data = array(
					'id_page' 				=> $id_page,
					'page_name'				=> $this->input->post('page_name'),
					'page_content'			=> $this->input->post('page_content'),
					'page_title'			=> $this->input->post('page_title')
				);
				if ($brand = $this->admin_model->edit_page($data)) {
					$message = $this->lang->line('admin_data_update_sucessfull');
					$alert 	 = 'alert alert-success';
				} else {
					$message = $this->lang->line('admin_data_update_error');
					$alert   = 'alert alert-danger';
				}
				$page = $this->admin_model->get_page($id_page);
				foreach ($page as $value)
				{
					$t = array (
						'id_page'				=> $id_page,
						'page_name' 			=> $value->page_name,
						'page_title' 			=> $value->page_title,
						'page_content' 			=> $value->page_content,
						'title' 				=> $this->lang->line('admin_admin_panel').' - '.$this->lang->line('admin_edit').$value->page_name,
						'message'				=> $message,
						'alert'					=> $alert,
					);
				}
				$this->layout->blok('admin/edit_page', 'content', $t);
				$this->layout->make('admin');
				
			} else {
				$page = $this->admin_model->get_page($id_page);
				foreach ($page as $value)
				{
					$t = array
					(
						'id_page'				=> $id_page,
						'page_name' 			=> $value->page_name,
						'page_title' 			=> $value->page_title,
						'page_content' 			=> $value->page_content,
						'title' 				=> $this->lang->line('admin_admin_panel').' - '.$this->lang->line('admin_edit').$value->page_name,
						'message'				=> FALSE,
						'alert'					=> FALSE,
					);
				}
				$this->layout->blok('admin/edit_page', 'content', $t);
				$this->layout->make('admin');
			}		
		}
	}
	
	function edit_author($id_author) {
		$this->session->set_userdata('referred_from', uri_string());
		if (!$this->users->is('admin')) {
			redirect('user/login_redirect');
		} else {
			$config = array(
				array(
					'field'   => 'author_name',
					'label'   => $this->lang->line('admin_author_name'),
					'rules'   => 'trim|required|min_length[2]|max_length[50]'
				),
				array(
					'field'   => 'author_description',
					'label'   => $this->lang->line('admin_author_description'),
					'rules'   => 'trim'
				)
			);
			$this->form_validation->set_rules($config);
			$css_style = $this->config->item('css_style_error', 'cms');
			$this->form_validation->set_error_delimiters("<div class='$css_style'>", "</div>");
			if ($this->form_validation->run() == TRUE) {
				$data = array(
					'id_author' 			=> $id_author,
					'author_name'			=> $this->input->post('author_name'),
					'author_description'	=> $this->input->post('author_description')
				);
				if ($this->admin_model->edit_author($data)) {
					$message = $this->lang->line('admin_data_update_sucessfull');
					$alert 	 = 'alert alert-success';
				} else {
					$message = $this->lang->line('admin_data_update_error');
					$alert   = 'alert alert-danger';
				}
				$author = $this->admin_model->get_author($id_author);
				foreach ($author as $value)
				{
					$t = array(
						'id_author'				=> $id_author,
						'author_name' 			=> $value->author_name,
						'author_description'	=> $value->author_description,
						'title' 				=> $this->lang->line('admin_admin_panel').' - '.$this->lang->line('admin_edit').$value->author_name,
						'message'				=> $message,
						'alert'					=> $alert,
					);
				}
				$this->layout->blok('admin/admin_edit_author', 'content', $t);
				$this->layout->make('admin');
				
			} else {
				$author = $this->admin_model->get_author($id_author);
				foreach ($author as $value)
				{
					$t = array(
						'id_author'				=> $id_author,
						'author_name' 			=> $value->author_name,
						'author_description'	=> $value->author_description,
						'title' 				=> $this->lang->line('admin_admin_panel').' - '.$this->lang->line('admin_edit').$value->author_name,
						'message'				=> FALSE,
						'alert'					=> FALSE,
					);
				}
				$this->layout->blok('admin/admin_edit_author', 'content', $t);
				$this->layout->make('admin');
			}		
		}
	}

	function edit_note($id_note) {
		$this->session->set_userdata('referred_from', uri_string());
		if (!$this->users->is('admin')) {
			redirect('user/login_redirect');
		} else {
			$config = array(
				array(
					'field'   => 'name_note',
					'label'   => $this->lang->line('admin_name_note'),
					'rules'   => 'trim|required|min_length[2]|max_length[150]'
				),
				array(
					'field'   => 'id_category_note',
					'label'   => $this->lang->line('admin_category_note'),
					'rules'   => 'trim|required|numeric'
				),
				array(
					'field'   => 'description',
					'label'   => $this->lang->line('admin_note_description'),
					'rules'   => 'trim'
				)
			);
			$this->form_validation->set_rules($config);
			$css_style = $this->config->item('css_style_error', 'cms');
			$this->form_validation->set_error_delimiters("<div class='$css_style'>", "</div>");
			if ($this->form_validation->run() == TRUE) {
				$data = array(
					'id_note' 				=> $id_note,
					'id_category_note'		=> $this->input->post('id_category_note'),
					'name_note'				=> $this->input->post('name_note'),
					'note_description'		=> $this->input->post('note_description')
				);
				if ($this->admin_model->edit_note($data)) {
					$message = $this->lang->line('admin_data_update_sucessfull');
					$alert 	 = 'alert alert-success';
				} else {
					$message = $this->lang->line('admin_data_update_error');
					$alert   = 'alert alert-danger';
				}
				$note = $this->admin_model->get_note($id_note);
				foreach ($note as $value)
				{
					$t = array(
						'id_note'				=> $id_note,
						'name_note' 			=> $value->name_note,
						'id_category_note'		=> $value->id_category_note,
						'title' 				=> $this->lang->line('admin_admin_panel').' - '.$this->lang->line('admin_edit').$value->name_note,
						'note_description' 		=> $value->note_description,
						'message'				=> $message,
						'alert'					=> $alert,
						'note_category'			=> $this->admin_model->get_notes_category(),
					);
				}
				$this->layout->blok('admin/admin_edit_note', 'content', $t);
				$this->layout->make('admin');
				
			} else {
				$note = $this->admin_model->get_note($id_note);
				foreach ($note as $value)
				{
					$t = array(
						'id_note'				=> $id_note,
						'id_category_note'		=> $value->id_category_note,
						'name_note' 			=> $value->name_note,
						'title' 				=> $this->lang->line('admin_admin_panel').' - '.$this->lang->line('admin_edit').$value->name_note,
						'note_description' 		=> $value->note_description,
						'message'				=> FALSE,
						'alert'					=> FALSE,
						'note_category'			=> $this->admin_model->get_notes_category(),
					);
				}
				$this->layout->blok('admin/admin_edit_note', 'content', $t);
				$this->layout->make('admin');
			}		
		}
	}

	function edit_product($id_product) {
		$this->session->set_userdata('referred_from', uri_string());
		if (!$this->users->is('admin')) {
			redirect('user/login_redirect');
		} else {
			$config = array(
				array(
					'field'		=> 'product_name',
					'label'		=> $this->lang->line('admin_product_name'),
					'rules'		=> 'trim|required|min_length[2]|max_length[150]'
				),
				array(
					'field'		=> 'id_brand',
					'label'		=> $this->lang->line('admin_name_brand'),
					'rules'		=> 'trim|required|numeric'
				),
				array(
					'field'		=> 'creation_date',
					'label'		=> $this->lang->line('admin_creation_date'),
					'rules'		=> 'trim|numeric|min_length[4]|max_length[4]'
				),
				array(
					'field'		=> 'description',
					'lebel'		=> $this->lang->line('admin_product_description'),
					'rules'		=> 'trim|min_length[2]'
				),
				array(
					'field'		=> 'id_type',
					'lebel'		=> $this->lang->line('admin_perfume_type'),
					'rules'		=> 'trim|required|numeric'
				),
				array(
					'field'		=> 'id_author',
					'lebel'		=> $this->lang->line('admin_author'),
					'rules'		=> 'trim|required|numeric'
				),
				array(
					'field'		=> 'sex',
					'lebel'		=> $this->lang->line('admin_sex'),
					'rules'		=> 'trim|numeric'
				)
			);
			$this->form_validation->set_rules($config);
			$css_style = $this->config->item('css_style_error', 'cms');
			$this->form_validation->set_error_delimiters("<div class='$css_style'>", "</div>");
			if ($this->form_validation->run() == TRUE) {
				$data = array(
					'id_product' 			=> $id_product,
					'product_name'			=> $this->input->post('product_name'),
					'id_brand'				=> $this->input->post('id_brand'),
					'creation_date'			=> $this->input->post('creation_date'),
					'description'			=> $this->input->post('description'),
					'id_type'				=> $this->input->post('id_type'),
					'id_author'				=> $this->input->post('id_author'),
					'sex'					=> $this->input->post('sex'),

				);
				if ($this->admin_model->edit_product($data)) {
					$message = $this->lang->line('admin_data_update_sucessfull');
					$alert 	 = 'alert alert-success';
				} else {
					$message = $this->lang->line('admin_data_update_error');
					$alert   = 'alert alert-danger';
				}

				$product = $this->admin_model->get_product($id_product);
				foreach ($product as $value)
				{
					$t = array(
						'id_product'			=> $id_product,
						'product_name' 			=> $value->product_name,
						'id_brand'				=> $value->id_brand,
						'title' 				=> $this->lang->line('admin_admin_panel').' - '.$this->lang->line('admin_edit').$value->product_name,
						'creation_date' 		=> $value->creation_date,
						'description' 			=> $value->description,
						'id_type' 				=> $value->id_type,
						'id_author' 			=> $value->id_author,
						'sex' 					=> $value->sex,
						'message'				=> $message,
						'alert'					=> $alert,
						'category'				=> $this->admin_model->get_notes_category(),
						'base_note'				=> $this->admin_model->get_product_notes($id_product, 1),
						'head_note'				=> $this->admin_model->get_product_notes($id_product, 2),
						'heart_note'			=> $this->admin_model->get_product_notes($id_product, 3),
						'brands'				=> $this->admin_model->get_brands_to_form(),
						'types'					=> $this->admin_model->get_types(),
						'authors'				=> $this->admin_model->get_authors(),
						'capacity'				=> $this->admin_model->get_capacity($id_product),
					);
				}
				$this->layout->blok('admin/admin_edit_product', 'content', $t);
				$this->layout->make('admin');
				
			} else {
				if ($this->session->has_userdata('message_delete_capacity')) 
				{
					$message 	= $this->session->userdata('message_delete_capacity');
					$alert 	= $this->session->userdata('alert_delete_capacity');
					$this->session->unset_userdata('message_delete_capacity');
					$this->session->unset_userdata('alert_delete_capacity');
				} 
				else if ($this->session->has_userdata('message_add_capacity')) 
				{
					$message 	= $this->session->userdata('message_add_capacity');
					$alert 	= $this->session->userdata('alert_add_capacity');
					$this->session->unset_userdata('message_add_capacity');
					$this->session->unset_userdata('alert_add_capacity');
				}
				else if ($this->session->has_userdata('message_delete_note2')) 
				{
					$message 	= $this->session->userdata('message_delete_note2');
					$alert 	= $this->session->userdata('alert_delete_note2');
					$this->session->unset_userdata('message_delete_note2');
					$this->session->unset_userdata('alert_delete_note2');
				} 
				else 
				{
					$message 	= FALSE;
					$alert 	= FALSE;
				}

				$product = $this->admin_model->get_product($id_product);
				foreach ($product as $value)
				{
					$t = array(
						'id_product'			=> $id_product,
						'product_name' 			=> $value->product_name,
						'id_brand'				=> $value->id_brand,
						'title' 				=> $this->lang->line('admin_admin_panel').' - '.$this->lang->line('admin_edit').$value->product_name,
						'creation_date' 		=> $value->creation_date,
						'description' 			=> $value->description,
						'id_type' 				=> $value->id_type,
						'id_author' 			=> $value->id_author,
						'sex' 					=> $value->sex,
						'message'				=> $message,
						'alert'					=> $alert,
						'category'				=> $this->admin_model->get_notes_category(),
						'base_note'				=> $this->admin_model->get_product_notes($id_product, 1),
						'head_note'				=> $this->admin_model->get_product_notes($id_product, 2),
						'heart_note'			=> $this->admin_model->get_product_notes($id_product, 3),
						'brands'				=> $this->admin_model->get_brands_to_form(),
						'types'					=> $this->admin_model->get_types(),
						'authors'				=> $this->admin_model->get_authors(),
						'capacity'				=> $this->admin_model->get_capacity($id_product),
					);
				}
				$this->layout->blok('admin/admin_edit_product', 'content', $t);
				$this->layout->make('admin');
			}		
		}
	}

	function add_page() {
		$this->session->set_userdata('referred_from', uri_string());
		if (!$this->users->is('admin')) {
			redirect('user/login_redirect');
		} else {
			$config = array(
				array(
					'field'   => 'page_name',
					'label'   => $this->lang->line('admin_page_name'),
					'rules'   => 'trim|required|min_length[2]|max_length[150]'
				),
				array(
					'field'   => 'page_content',
					'label'   => $this->lang->line('admin_page_content'),
					'rules'   => 'trim|required|min_length[2]'
				),
				array(
					'field'   => 'page_title',
					'label'   => $this->lang->line('admin_page_title'),
					'rules'   => 'trim|required|min_length[2]|max_length[100]'
				)
			);
			$this->form_validation->set_rules($config);
			$css_style = $this->config->item('css_style_error', 'cms');
			$this->form_validation->set_error_delimiters("<div class='$css_style'>", "</div>");
			if ($this->form_validation->run() == TRUE) {
				$data = array(
					'page_name'				=> $this->input->post('page_name'),
					'page_content'			=> $this->input->post('page_content'),
					'page_title'			=> $this->input->post('page_title')
				);
				if ($this->admin_model->add_page($data)) {
					$this->session->set_userdata('message_add_page', $this->lang->line('admin_added_new_site'));
					$this->session->set_userdata('alert_add_page', 'alert alert-success');
					redirect('admin/pages');
				} else {
					$this->session->set_userdata('message_add_page', $this->lang->line('admin_data_add_error'));
					$this->session->set_userdata('alert_add_page', 'alert alert-success');
					redirect('admin/pages');
				}

			} else {
				$t = array(
					'message' 				=> FALSE,
					'alert' 				=> FALSE,
					'title' 				=> $this->lang->line('admin_add_new_site'),
				);
				$this->layout->blok('admin/add_page', 'content', $t);
				$this->layout->make('admin');
			}
		}
	}

	function add_brand() {
		$this->session->set_userdata('referred_from', uri_string());
		if (!$this->users->is('admin')) {
			redirect('user/login_redirect');
		} else {
			$config = array(
				array(
					'field'   => 'name_brand',
					'label'   => $this->lang->line('admin_brand_name'),
					'rules'   => 'trim|required|min_length[2]|max_length[150]|is_unique[brands.name_brand]'
				),
				array(
					'field'   => 'description',
					'label'   => $this->lang->line('admin_brand_description'),
					'rules'   => 'trim'
				)
			);
			$this->form_validation->set_rules($config);
			$css_style = $this->config->item('css_style_error', 'cms');
			$this->form_validation->set_error_delimiters("<div class='$css_style'>", "</div>");
			if ($this->form_validation->run() == TRUE) {
				$data = array(
					'name_brand'			=> $this->input->post('name_brand'),
					'description_brand'		=> $this->input->post('description_brand')
				);
				if ($this->admin_model->add_brand($data)) {
					$this->session->set_userdata('message_add_brand', $this->lang->line('admin_add_brand'));
					$this->session->set_userdata('alert_add_brand', 'alert alert-success');
					redirect('admin/brand');
				} else {
					$this->session->set_userdata('message_add_brand', $this->lang->line('admin_error_add_brand'));
					$this->session->set_userdata('alert_add_brand', 'alert alert-success');
					redirect('admin/brand');
				}
			} else {
				$t = array(
					'message' 				=> FALSE,
					'alert' 				=> FALSE,
					'title' 				=> $this->lang->line('admin_add_brand'),
				);
				$this->layout->blok('admin/add_brand', 'content', $t);
				$this->layout->make('admin');
			}
		}
	}

	function add_author() {
		$this->session->set_userdata('referred_from', uri_string());
		if (!$this->users->is('admin')) {
			redirect('user/login_redirect');
		} else {
			$config = array(
				array(
					'field'   => 'author_name',
					'label'   => $this->lang->line('admin_author_name'),
					'rules'   => 'trim|required|min_length[2]|max_length[150]|is_unique[authors.author_name]'
				),
				array(
					'field'   => 'author_description',
					'label'   => $this->lang->line('admin_author_description'),
					'rules'   => 'trim'
				)
			);
			$this->form_validation->set_rules($config);
			$css_style = $this->config->item('css_style_error', 'cms');
			$this->form_validation->set_error_delimiters("<div class='$css_style'>", "</div>");
			if ($this->form_validation->run() == TRUE) {
				$data = array(
					'author_name'			=> $this->input->post('author_name'),
					'author_description'	=> $this->input->post('author_description')
				);
				if ($this->admin_model->add_author($data)) {
					$this->session->set_userdata('message_add_author', $this->lang->line('admin_add_author'));
					$this->session->set_userdata('alert_add_author', 'alert alert-success');
					redirect('admin/authors');
				} else {
					$this->session->set_userdata('message_add_author', $this->lang->line('admin_error_add_author'));
					$this->session->set_userdata('alert_add_author', 'alert alert-danger');
					redirect('admin/authors');
				}
			} else {
				$t = array(
					'message' 				=> FALSE,
					'alert' 				=> FALSE,
					'title' 				=> $this->lang->line('admin_add_author'),
				);
				$this->layout->blok('admin/add_author', 'content', $t);
				$this->layout->make('admin');
			}
		}
	}

	function add_note() {
		$this->session->set_userdata('referred_from', uri_string());
		if (!$this->users->is('admin')) {
			redirect('user/login_redirect');
		} else {
			$config = array(
				array(
					'field'   => 'name_note',
					'label'   => $this->lang->line('admin_name_note'),
					'rules'   => 'trim|required|min_length[2]|max_length[150]|is_unique[notes.name_note]'
				),
				array(
					'field'   => 'id_category_note',
					'label'   => $this->lang->line('admin_category_note'),
					'rules'   => 'trim'
				),
				array(
					'field'   => 'description',
					'label'   => $this->lang->line('admin_note_description'),
					'rules'   => 'trim'
				)
			);
			$this->form_validation->set_rules($config);
			$css_style = $this->config->item('css_style_error', 'cms');
			$this->form_validation->set_error_delimiters("<div class='$css_style'>", "</div>");
			if ($this->form_validation->run() == TRUE) {
				$data = array(
					'name_note'				=> $this->input->post('name_note'),
					'id_category_note'		=> $this->input->post('id_category_note'),
					'note_description'		=> $this->input->post('note_description')
				);
				if ($this->admin_model->add_note($data)) {
					$this->session->set_userdata('message_add_note', $this->lang->line('admin_added_note'));
					$this->session->set_userdata('alert_add_note', 'alert alert-success');
					redirect("admin/notes");
				} else {
					$this->session->set_userdata('message_add_note', $this->lang->line('admin_error_add_note'));
					$this->session->set_userdata('alert_add_note', 'alert alert-success');
					redirect("admin/notes");
				}
			} else {
				$t = array(
					'notes'					=> $this->admin_model->get_notes_category(),
					'message' 				=> FALSE,
					'alert' 				=> FALSE,
					'title' 				=> $this->lang->line('admin_add_note')
				);
				$this->layout->blok('admin/add_note', 'content', $t);
				$this->layout->make('admin');
			}
		}
	}

	function add_capacity($id_product) {
		$this->session->set_userdata('referred_from', uri_string());
		if (!$this->users->is('admin') OR $id_product === NULL) {
			redirect('admin/index');
		} else {
			$config = array(
				array(
					'field'   => 'id_product',
					'label'   => $this->lang->line('admin_id_product'),
					'rules'   => 'trim|required|numeric'
				),
				array(
					'field'   => 'ean',
					'label'   => $this->lang->line('admin_ean'),
					'rules'   => 'trim|required|numeric|is_unique[capacity.ean]'
				),
				array(
					'field'   => 'ean2',
					'label'   => $this->lang->line('admin_ean2'),
					'rules'   => 'trim|numeric'
				),
				array(
					'field'   => 'capacity_value',
					'label'   => $this->lang->line('admin_capacity'),
					'rules'   => 'trim|required|numeric'
				),
				array(
					'field'   => 'tester',
					'label'   => $this->lang->line('admin_is_tester'),
					'rules'   => 'trim|required|numeric|is_natural'
				)
			);
			$this->form_validation->set_rules($config);
			$css_style = $this->config->item('css_style_error', 'cms');
			$this->form_validation->set_error_delimiters("<div class='$css_style'>", "</div>");
			if ($this->form_validation->run() == TRUE) {
				$data = array(
					'id_product'			=> $id_product,
					'ean'					=> $this->input->post('ean'),
					'ean2'					=> $this->input->post('ean2'),
					'capacity_value'		=> $this->input->post('capacity_value'),
					'tester'				=> $this->input->post('tester')
				);
				if ($this->admin_model->add_capacity($data)) {
					$this->session->set_userdata('message_add_capacity', $this->lang->line('admin_added_capacity'));
					$this->session->set_userdata('alert_add_capacity', 'alert alert-success');
					redirect("admin/edit_product/$id_product");
				} else {
					$this->session->set_userdata('message_add_capacity', $this->lang->line('admin_error_add_capacity'));
					$this->session->set_userdata('alert_add_capacity', 'alert alert-success');
					redirect("admin/edit_product/$id_product");
				}
				
			} else {
				$t = array(
					'id_product'			=> $id_product,
					'message' 				=> '',
					'alert' 				=> '',
					'title' 				=> $this->lang->line('admin_add_new_ean')
				);
				$this->layout->blok("admin/add_capacity", 'content', $t);
				$this->layout->make('admin');
			}
		}
	}

	function add_product() {
		$this->session->set_userdata('referred_from', uri_string());
		if (!$this->users->is('admin')) {
			redirect('user/login_redirect');
		} else {
			$config = array(
				array(
					'field'		=> 'product_name',
					'label'		=> $this->lang->line('admin_product_name'),
					'rules'		=> 'trim|required|min_length[2]|max_length[150]'
				),
				array(
					'field'		=> 'id_brand',
					'label'		=> $this->lang->line('admin_name_brand'),
					'rules'		=> 'trim|required|numeric'
				),
				array(
					'field'		=> 'creation_date',
					'label'		=> $this->lang->line('admin_creation_date'),
					'rules'		=> 'trim|numeric|min_length[4]|max_length[4]'
				),
				array(
					'field'		=> 'description',
					'lebel'		=> $this->lang->line('admin_product_description'),
					'rules'		=> 'trim|min_length[2]'
				),
				array(
					'field'		=> 'id_type',
					'lebel'		=> $this->lang->line('admin_perfume_type'),
					'rules'		=> 'trim|required|numeric'
				),
				array(
					'field'		=> 'id_author',
					'lebel'		=> $this->lang->line('admin_author'),
					'rules'		=> 'trim|required|numeric'
				),
				array(
					'field'		=> 'sex',
					'lebel'		=> $this->lang->line('admin_sex'),
					'rules'		=> 'trim|numeric'
				)
			);
			$this->form_validation->set_rules($config);
			$css_style = $this->config->item('css_style_error', 'cms');
			$this->form_validation->set_error_delimiters("<div class='$css_style'>", "</div>");
			if ($this->form_validation->run() == TRUE) {
				$data = array(
					'product_name'			=> $this->input->post('product_name'),
					'id_brand'				=> $this->input->post('id_brand'),
					'creation_date'			=> $this->input->post('creation_date'),
					'description'			=> $this->input->post('description'),
					'id_type'				=> $this->input->post('id_type'),
					'id_author'				=> $this->input->post('id_author'),
					'sex'					=> $this->input->post('sex'),
				);

				if ($this->admin_model->add_product($data)) {
					$this->session->set_userdata('message_add_product', $this->lang->line('admin_added_product'));
					$this->session->set_userdata('alert_add_product', 'alert alert-success');
					redirect("admin/products");
				} else {
					$this->session->set_userdata('message_add_product', $this->lang->line('admin_error_add_product'));
					$this->session->set_userdata('alert_add_note', 'alert alert-success');
					redirect("admin/products");
				}
				
			} else {
				$t = array(
					'title' 				=> $this->lang->line('admin_admin_panel').' - '.$this->lang->line('admin_add_product'),
					'category'				=> $this->admin_model->get_notes_category(),
					'brands'				=> $this->admin_model->get_brands_to_form(),
					'types'					=> $this->admin_model->get_types(),
					'authors'				=> $this->admin_model->get_authors(),
				);
				$this->layout->blok('admin/add_product', 'content', $t);
				$this->layout->make('admin');
			}		
		}
	}

	function delete_brand($id=FALSE) {
		$this->session->set_userdata('referred_from', uri_string());
		if (!$this->users->is('admin')) {
			redirect('user/login_redirect');
		} else {
			if ($id === FALSE) {
				show_404();
			} else {
				if ($this->admin_model->delete_brand($id)) {
					$this->session->set_userdata('message_delete_brand', $this->lang->line('admin_deleted_brand'));
					$this->session->set_userdata('alert_delete_brand', 'alert alert-success');
					redirect('admin/brand');
				} else {
					$this->session->set_userdata('message_delete_brand', $this->lang->line('admin_deleted_error'));
					$this->session->set_userdata('alert_delete_brand', 'alert alert-danger');
					redirect('admin/brand');
				}
			}
		}
	}

	function delete_author($id=FALSE) {
		$this->session->set_userdata('referred_from', uri_string());
		if (!$this->users->is('admin')) {
			redirect('user/login_redirect');
		} else {
			if ($id === FALSE) {
				show_404();
			} else {
				if ($this->admin_model->delete_author($id)) {
					$this->session->set_userdata('message_delete_brand', $this->lang->line('admin_deleted_author'));
					$this->session->set_userdata('alert_delete_brand', 'alert alert-success');
					redirect('admin/authors');
				} else {
					$this->session->set_userdata('message_delete_brand', $this->lang->line('admin_deleted_author'));
					$this->session->set_userdata('alert_delete_brand', 'alert alert-danger');
					redirect('admin/authors');
				}
			}
		}
	}

	function delete_product($id=FALSE) {
		$this->session->set_userdata('referred_from', uri_string());
		if (!$this->users->is('admin')) {
			redirect('user/login_redirect');
		} else {
			if ($id === FALSE) {
				show_404();
			} else {
				if ($this->admin_model->delete_product($id)) {
					$this->session->set_userdata('message_delete_product', $this->lang->line('admin_deleted_product'));
					$this->session->set_userdata('alert_delete_product', 'alert alert-success');
					redirect('admin/products');
				} else {
					$this->session->set_userdata('message_delete_product', $this->lang->line('admin_deleted_error'));
					$this->session->set_userdata('alert_delete_product', 'alert alert-danger');
					redirect('admin/products');
				}
			}
		}
	}

	function delete_note($id=FALSE) {
		$this->session->set_userdata('referred_from', uri_string());
		if (!$this->users->is('admin')) {
			redirect('user/login_redirect');
		} else {
			if ($id === FALSE) {
				show_404();
			} else {
				if ($this->admin_model->delete_note($id)) {
					$this->session->set_userdata('message_delete_note', $this->lang->line('admin_deleted_note'));
					$this->session->set_userdata('alert_delete_note', 'alert alert-success');
					redirect('admin/notes');
				} else {
					$this->session->set_userdata('message_delete_note', $this->lang->line('admin_deleted_error'));
					$this->session->set_userdata('alert_delete_note', 'alert alert-danger');
					redirect('admin/notes');
				}
			}
		}
	}

	function delete_page($id=FALSE) {
		$this->session->set_userdata('referred_from', uri_string());
		if (!$this->users->is('admin')) {
			redirect('user/login_redirect');
		} else {
			if ($id === FALSE) {
				show_404();
			} else {
				if ($this->admin_model->delete_page($id)) {
					$this->session->set_userdata('message_delete_page', $this->lang->line('admin_deleted_page'));
					$this->session->set_userdata('alert_delete_page', 'alert alert-success');
					redirect('admin/pages');
				} else {
					$this->session->set_userdata('message_delete_page', $this->lang->line('admin_deleted_error'));
					$this->session->set_userdata('alert_delete_page', 'alert alert-danger');
					redirect('admin/pages');
				}
			}
		}
	}

	function delete_product_note($id=FALSE, $id_product=FALSE) {
		$this->session->set_userdata('referred_from', uri_string());
		if (!$this->users->is('admin')) {
			redirect('user/login_redirect');
		} else {
			if ($id === FALSE OR $id_product===FALSE) {
				show_404();
			} else {
				if ($this->admin_model->delete_note_product($id)) {
					$this->session->set_userdata('message_delete_note2', $this->lang->line('admin_deleted_note'));
					$this->session->set_userdata('alert_delete_note2', 'alert alert-success');
					redirect("admin/edit_product/".$id_product);
				} else {
					$this->session->set_userdata('message_delete_note2', $this->lang->line('admin_deleted_error'));
					$this->session->set_userdata('alert_delete_note2', 'alert alert-danger');
					redirect("admin/edit_product/".$id_product);
				}
			}
		}
	}

	function delete_capacity($id_capacity=FALSE, $id_product) {
		$this->session->set_userdata('referred_from', uri_string());
		if (!$this->users->is('admin')) {
			redirect('user/login_redirect');
		} else {
			if ($id_capacity === FALSE OR $id_product === FALSE)  {
				show_404();
			} else {
				if ($this->admin_model->delete_capacity($id_capacity)) {
					$this->session->set_userdata('message_delete_capacity', $this->lang->line('admin_deleted_ean'));
					$this->session->set_userdata('alert_delete_capacity', 'alert alert-success');
					redirect("admin/edit_product/$id_product");
				} else {
					$this->session->set_userdata('message_delete_capacity', $this->lang->line('admin_deleted_ean_error'));
					$this->session->set_userdata('alert_delete_capacity', 'alert alert-danger');
					redirect("admin/edit_product/$id_product");
				}
			}
		}
	}

	function delete_review($id=FALSE) {
		$this->session->set_userdata('referred_from', uri_string());
		if (!$this->users->is('admin')) {
			redirect('user/login_redirect');
		} else {
			if ($id === FALSE) {
				show_404();
			} else {
				if ($this->admin_model->delete_review($id)) {
					$this->session->set_userdata('message_delete_review', $this->lang->line('admin_deleted_review'));
					$this->session->set_userdata('alert_delete_review', 'alert alert-success');
					redirect('admin/reviews');
				} else {
					$this->session->set_userdata('message_delete_review', $this->lang->line('admin_deleted_error'));
					$this->session->set_userdata('alert_delete_review', 'alert alert-danger');
					redirect('admin/reviews');
				}
			}
		}
	}

	public function search_brand($start=0) {
		$this->session->set_userdata('referred_from', uri_string());
		if (!$this->users->is('admin')) {
			redirect('user/login_redirect');
		} else {
			$config = array(
				array(
					'field'   => 'search',
					'label'   => $this->lang->line('admin_search_keyword'),
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
				redirect('admin/search_brand');
			}


			$t = array (
				'brand' => $this->admin_model->search_brand($search, $start, 10),
				'title' => $this->lang->line('admin_search')
			);
		
			$howmany = $this->admin_model->howmany_search_brand($search);
			$config['base_url'] = base_url().'admin/search_brands';
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
			if ($this->session->userdata('message_delete_brand') !== FALSE) {
				$t['message'] 	= $this->session->userdata('message_delete_brand');
				$t['alert'] 	= $this->session->userdata('alert_delete_brand');
				$this->session->unset_userdata('message_delete_brand');
				$this->session->unset_userdata('alert_delete_brand');
			} else {
				$t['message'] 	= FALSE;
				$t['alert'] 	= FALSE;
			}
			$this->layout->blok('admin/admin_search_brand', 'content', $t);
			$this->layout->make('admin');
		}
	}

	public function search_review($start=0) {
		$this->session->set_userdata('referred_from', uri_string());
		if (!$this->users->is('admin')) {
			redirect('user/login_redirect');
		} else {
			$config = array(
				array(
					'field'   => 'search',
					'label'   => $this->lang->line('admin_search_keyword'),
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
				redirect('admin/search_review');
			}


			$t = array (
				'review' => $this->admin_model->search_review($search, $start, 10),
				'title' => $this->lang->line('admin_search')
			);
		
			$howmany = $this->admin_model->howmany_search_review($search);
			$config['base_url'] = base_url().'admin/search_review';
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
			if ($this->session->userdata('message_delete_brand') !== FALSE) {
				$t['message'] 	= $this->session->userdata('message_delete_review');
				$t['alert'] 	= $this->session->userdata('alert_delete_review');
				$this->session->unset_userdata('message_delete_review');
				$this->session->unset_userdata('alert_delete_review');
			} else {
				$t['message'] 	= FALSE;
				$t['alert'] 	= FALSE;
			}
			$this->layout->blok('admin/admin_search_review', 'content', $t); 
			$this->layout->make('admin');
		}
	}

	public function search_note($start=0) {
		$this->session->set_userdata('referred_from', uri_string());
		if (!$this->users->is('admin')) {
			redirect('user/login_redirect');
		} else {
			$config = array(
				array(
					'field'   => 'search',
					'label'   => $this->lang->line('admin_search_keyword'),
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
				redirect('admin/search_note');
			}

			$t = array (
				'notes' => $this->admin_model->search_note($search, $start, 10),
				'title' => $this->lang->line('admin_search')
			);
		
			$howmany = $this->admin_model->howmany_search_note($search);
			$config['base_url'] = base_url().'admin/search_brand';
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
			if ($this->session->userdata('message_delete_note') !== FALSE) {
				$t['message'] 	= $this->session->userdata('message_delete_note');
				$t['alert'] 	= $this->session->userdata('alert_delete_note');
				$this->session->unset_userdata('message_delete_note');
				$this->session->unset_userdata('alert_delete_note');
			} else {
				$t['message'] 	= FALSE;
				$t['alert'] 	= FALSE;
			}
			$this->layout->blok('admin/admin_search_note', 'content', $t);
			$this->layout->make('admin');
		}
	}

	public function search_product($start=0) {
		$this->session->set_userdata('referred_from', uri_string());
		if (!$this->users->is('admin')) {
			redirect('user/login_redirect');
		} else {
			$config = array(
				array(
					'field'   => 'search',
					'label'   => $this->lang->line('admin_search_keyword'),
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
				redirect('admin/search_product');
			}


			$t = array (
				'products' => $this->admin_model->search_product($search, $start, 10),
				'title' => $this->lang->line('admin_search')
			);
		
			$howmany = $this->admin_model->howmany_search_product($search);
			$config['base_url'] = base_url().'admin/search_product';
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
			
				$t['message'] 	= FALSE;
				$t['alert'] 	= FALSE;

			$this->layout->blok('admin/admin_search_product', 'content', $t);
			$this->layout->make('admin');
		}
	}

	/** AJAX Functions */

	function edit_capacity() {
		$this->session->set_userdata('referred_from', uri_string());
		if (!$this->users->is('admin')) {
			redirect('user/login_redirect');
		} else {
			$t['id_capacity']		= $this->input->post('id_capacity');
			$t['ean']				= $this->input->post('ean');
			$t['capacity_value']	= $this->input->post('capacity_value');
				
			if ($this->admin_model->edit_capacity($t)) {
				if ($this->admin_model->is_ean($this->input->post('ean'), $this->input->post('id_capacity'))) { 
					echo json_encode(
						array(
							'status' 			=> FALSE,
							'value'				=> $this->lang->line('admin_ean_exist_in_database')
						)
					);
				} else {
					echo json_encode(
						array(
							'status' 			=> TRUE,
							'value'				=> $this->admin_model->get_capacity_by_id($t['id_capacity'])
						)
					);
				}
			} else {
				echo json_encode(
					array(
						'status' 			=> FALSE,
					)
				);
			}		
		}
	}

	function get_note_by_category() {
		$this->session->set_userdata('referred_from', uri_string());
		if (!$this->users->is('admin')) {
			redirect('user/login_redirect');
		} else {
			if ($this->admin_model->get_note_by_id_category($this->input->post('id_note_category'))) { 
				echo json_encode(
					array(
						'status' 			=> TRUE,
						'value'				=> $this->admin_model->get_note_by_id_category($this->input->post('id_note_category')),
					)
				);
			} else {
				echo json_encode(
					array(
						'status' 			=> FALSE,
					)
				);
			}
		}
	}

	function get_note_by_product($id_product, $where) {
		$this->session->set_userdata('referred_from', uri_string());
		if (!$this->users->is('admin')) {
			redirect('user/login_redirect');
		} else {
			
		}
	}

	function add_note_to_product() {
		$this->session->set_userdata('referred_from', uri_string());
		if (!$this->users->is('admin')) {
			redirect('user/login_redirect');
		} else {
			if ($this->admin_model->is_note($this->input->post('id_note')) == FALSE) {
				echo json_encode(
					array(
						'status' 	=> FALSE,
						'value'		=> $this->lang->line('admin_note_not_exist_in_database')
					)
				);
			} else if  ($this->admin_model->is_note_in_product($this->input->post('id_note'), $this->input->post('id_product')) == TRUE) {
					echo json_encode(
						array(
							'status' 	=> FALSE,
							'value'		=> $this->lang-line('admin_note_exist_in_this_product')
						)
					);
			} else {
				if ($this->input->post('typeform') == "base") 
				{
					$t['is_base_note'] = 1;
					$t['is_head_note'] = 0;
					$t['is_heart_note'] = 0;
					$what = 1;
				} 
				else if ($this->input->post('typeform') == "head") 
				{
					$t['is_base_note'] = 0;
					$t['is_head_note'] = 1;
					$t['is_heart_note'] = 0;
					$what = 2;
				} 
				else if ($this->input->post('typeform') == "heart") 
				{
					$t['is_base_note'] = 0;
					$t['is_head_note'] = 0;
					$t['is_heart_note'] = 1;
					$what = 3;
				}
				$t['id_product']	= $this->input->post('id_product');
				$t['id_note']		= $this->input->post('id_note');
				if ($this->admin_model->add_note_by_product($t)) {
					echo json_encode(
						array(
							'status' 		=> TRUE,
							'value'			=> $this->lang->line('admin_added'),
							'base_note'		=> $this->admin_model->get_product_notes($this->input->post('id_product'), $what),
							'head_note'		=> $this->admin_model->get_product_notes($this->input->post('id_product'), $what),
							'heart_note'	=> $this->admin_model->get_product_notes($this->input->post('id_product'), $what),
						)
					);
				} else {
					echo json_encode(
						array(
							'status' 	=> FALSE,
							'value'		=> $this->lang->line('admin_database_error')		
						)
					);
				}
			}
		}
	}
}
/* End of file Admin.php */
/* Location: ./system/application/controllers/Admin.php */