<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {

	function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    function get_brands($start, $limit) {
		$this->db->limit($limit, $start);
		$this->db->order_by('id_brand', 'DESC');
		$query = $this->db->get('brands'); //pobiera wartosci z tabeli dla id
		if (!$query->num_rows()) return FALSE; // zwraca False jak nie znalazł
		return $query->result();
	}

	function get_brands_to_form() {
		$query = $this->db->get('brands');
		if (!$query->num_rows()) return FALSE;
		return $query->result();
	}

	function get_types() {
		$query = $this->db->get('types');
		if (!$query->num_rows()) return FALSE;
		return $query->result();
	}

	function get_authors() {
		$query = $this->db->get('authors');
		if (!$query->num_rows()) return FALSE;
		return $query->result();
	}

	function get_authors2($start, $limit) {

		$this->db->limit($limit, $start);
		$this->db->order_by('id_author', 'ACS');
		$query = $this->db->get('authors'); //pobiera wartosci z tabeli dla id
		if (!$query->num_rows()) return FALSE; // zwraca False jak nie znalazł
		return $query->result();
	}

	function get_notes_category() {
		$query = $this->db->get('category_notes'); //pobiera wartosci z tabeli dla id
		if (!$query->num_rows()) return FALSE; // zwraca False jak nie znalazł
		return $query->result();
	}

	function get_note_by_id_category($id_category) {
		$this->db->where('id_category_note', $id_category);
		$query = $this->db->get('notes'); //pobiera wartosci z tabeli dla id
		if (!$query->num_rows()) return FALSE; // zwraca False jak nie znalazł
		return $query->result();
	}

	function get_notes($start, $limit) {
		$this->db->select(
			'notes.id_note,
			notes.id_category_note,
			category_notes.name_category,
			notes.name_note,
			notes.note_description'
		);

		$this->db->limit($limit, $start);
		$this->db->join('category_notes', 'notes.id_category_note = category_notes.id_category_note', 'left');
		$this->db->order_by('id_note', 'DESC');
		$query = $this->db->get('notes'); //pobiera wartosci z tabeli dla id
		if (!$query->num_rows()) return FALSE; // zwraca False jak nie znalazł
		return $query->result();
	}

	function get_product_notes($id, $type)
	{
		if ($type == 1)
		{
			$this->db->where('is_base_note', 1);
		} elseif ($type == 2)
		{
			$this->db->where('is_head_note', 1);
		} elseif ($type == 3)
		{
			$this->db->where('is_heart_note', 1);
		}
		$this->db->where('id_product', $id);
		$this->db->join('notes', 'notes.id_note = products_notes.id_note');
		$query = $this->db->get('products_notes'); //pobiera wartosci z tabeli dla id
		if (!$query->num_rows()) return FALSE; // zwraca False jak nie znalazł
		return $query->result();
	}

	function get_products($start, $limit) {
		$this->db->select(
			'products.id_product,
			products.product_name,
			products.id_brand,
			brands.name_brand,
			products.id_type,
			types.name_type,
			types.short_type'
		);
		$this->db->limit($limit, $start);
		$this->db->join('brands', 'products.id_brand = brands.id_brand', 'left');
		$this->db->join('types', 'products.id_type = types.id_type', 'left');
		$this->db->order_by('id_product', 'DESC');
		$query = $this->db->get('products'); //pobiera wartosci z tabeli dla id
		if (!$query->num_rows()) return FALSE; // zwraca False jak nie znalazł
		return $query->result();
	}

	function get_pages($start, $limit) {
		$this->db->limit($limit, $start);
		$this->db->order_by('id_page', 'DESC');
		$query = $this->db->get('pages'); //pobiera wartosci z tabeli dla id
		if (!$query->num_rows()) return FALSE; // zwraca False jak nie znalazł
		return $query->result();
	}

	function get_reviews($start, $limit) {
		$this->db->select(
			'vote_review.id_review,
			vote_review.id_user,
			users.login,
			vote_review.id_product,
			products.product_name,
			vote_review.score,
			vote_review.textreview,
			vote_review.data_review'
		);
		$this->db->limit($limit, $start);
		$this->db->join('users', 'users.id = vote_review.id_user', 'left');
		$this->db->join('products', 'products.id_product = vote_review.id_product', 'left');
		$this->db->order_by('data_review', 'DESC');
		$query = $this->db->get('vote_review'); //pobiera wartosci z tabeli dla id
		if (!$query->num_rows()) return FALSE; // zwraca False jak nie znalazł
		return $query->result();
	}

	function get_brand($id) {
		$this->db->where('id_brand', $id);
		$query = $this->db->get('brands'); //pobiera wartosci z tabeli dla id
		if (!$query->num_rows()) return FALSE; // zwraca False jak nie znalazł
		return $query->result();
	}

	function get_author($id) {
		$this->db->where('id_author', $id);
		$query = $this->db->get('authors'); //pobiera wartosci z tabeli dla id
		if (!$query->num_rows()) return FALSE; // zwraca False jak nie znalazł
		return $query->result();
	}

	/** Function get all data form capacity table for id
	*
	* @access public
	* @param number
	* @return object
	*/
	function get_capacity($id) {
		$this->db->where('id_product', $id);
		$query = $this->db->get('capacity');
		if (!$query->num_rows()) return FALSE;
		return $query->result();
	}

	function get_note($id) {
		$this->db->select(
			'notes.id_note,
			notes.id_category_note,
			category_notes.name_category,
			notes.name_note,
			notes.note_description'
		);
		$this->db->join('category_notes', 'notes.id_category_note = category_notes.id_category_note', 'left');
		$this->db->where('id_note', $id);
		$query = $this->db->get('notes'); //pobiera wartosci z tabeli dla id
		if (!$query->num_rows()) return FALSE; // zwraca False jak nie znalazł
		return $query->result();
	}

	function get_page($id) {
		$this->db->where('id_page', $id);
		$query = $this->db->get('pages');
		if (!$query->num_rows()) return FALSE;
		return $query->result();
	}

	function get_product($id) {
		$this->db->where('id_product', $id);
		$query = $this->db->get('products');
		if (!$query->num_rows()) return FALSE;
		return $query->result();
	}

	function edit_brand($data) {
		$insert = array (
			'name_brand'		=> $data['name_brand'],
			'description_brand' => $data['description_brand'],
		);
		$this->db->where('id_brand', $data['id_brand']);
		if ($this->db->update('brands', $insert)) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	function edit_author($data) {
		$insert = array (
			'author_name'			=> $data['author_name'],
			'author_description' 	=> $data['author_description'],
		);
		$this->db->where('id_author', $data['id_author']);
		if ($this->db->update('authors', $insert)) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	function edit_note($data) {
		$insert = array (
			'name_note'			=> $data['name_note'],
			'id_category_note'	=> $data['id_category_note'],
			'note_description' 	=> $data['note_description'],
		);
		$this->db->where('id_note', $data['id_note']);
		if ($this->db->update('notes', $insert)) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	function edit_page($data) {
		$insert = array (
			'page_name' 		=> 	$data['page_name'],
			'page_title' 		=> 	$data['page_title'],
			'page_content' 		=> $data['page_content']
		);
		$this->db->where('id_page', $data['id_page']);
		if ($this->db->update('pages', $insert)) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	function edit_product($data) {
		$insert = array (
			'id_product'			=> $data['id_product'],
			'product_name' 			=> $data['product_name'],
			'id_brand'				=> $data['id_brand'],
			'creation_date' 		=> $data['creation_date'],
			'description' 			=> $data['description'],
			'id_type' 				=> $data['id_type'],
			'id_author' 			=> $data['id_author'],
			'sex' 					=> $data['sex']
		);
		$this->db->where('id_product', $data['id_product']);
		if ($this->db->update('products', $insert)) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	function add_brand($data) {
		$insert = array (
			'name_brand'		=> $data['name_brand'],
			'description_brand' => $data['description_brand'],
		);
		if ($this->db->insert('brands', $insert)) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	function add_author($data) {
		$insert = array (
			'author_name'		=> $data['author_name'],
			'author_description' => $data['author_description'],
		);
		if ($this->db->insert('authors', $insert)) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	function add_note($data) {
		$insert = array (
			'name_note'			=> $data['name_note'],
			'id_category_note' 	=> $data['id_category_note'],
			'note_description' 	=> $data['note_description'],
		);
		if ($this->db->insert('notes', $insert)) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	function add_page($data) {
		$insert = array (
			'page_name'			=> $data['page_name'],
			'page_content'		=> $data['page_content'],
			'page_title'		=> $data['page_title'],
		);
		if ($this->db->insert('pages', $insert)) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	function add_capacity($data) {
		$insert = array (
			'id_product'		=> $data['id_product'],
			'ean'				=> $data['ean'],
			'ean2'				=> $data['ean2'],
			'capacity_value'	=> $data['capacity_value'],
			'tester'			=> $data['tester'],
		);
		if ($this->db->insert('capacity', $insert)) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	function add_note_by_product($data) {
		$insert = array (
			'id_product'		=> $data['id_product'],
			'id_note'			=> $data['id_note'],
			'is_base_note'		=> $data['is_base_note'],
			'is_head_note'		=> $data['is_head_note'],
			'is_heart_note'		=> $data['is_heart_note'],
		);
		if ($this->db->insert('products_notes', $insert)) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	function add_product($data) {
		$insert = array (
			'product_name'		=> $data['product_name'],
			'id_brand'			=> $data['id_brand'],
			'creation_date'		=> $data['creation_date'],
			'description'		=> $data['description'],
			'id_type'			=> $data['id_type'],
			'id_author'			=> $data['id_author'],
			'sex'				=> $data['sex'],
		);
		if ($this->db->insert('products', $insert)) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	function howmany($table) {
		$query = $this->db->get("$table");
		if (!$query->num_rows()) return FALSE;
		return $query->num_rows();
	}

	function delete_brand($id=FALSE) {
		$this->db->where('id_brand', $id);
		if (!$this->db->delete('brands')) return FALSE;
		return TRUE;
		
	}

	function delete_author($id=FALSE) {
		$this->db->where('id_author', $id);
		if (!$this->db->delete('authors')) return FALSE;
		return TRUE;
		
	}

	function delete_product($id=FALSE) {
		$this->db->where('id_product', $id);
		if (!$this->db->delete('vote_stats')) return FALSE;
		$this->db->where('id_product', $id);
		if (!$this->db->delete('vote_review')) return FALSE;
		$this->db->where('id_product', $id);
		if (!$this->db->delete('vote_notes')) return FALSE;
		$this->db->where('id_product', $id);
		if (!$this->db->delete('capacity')) return FALSE;
		$this->db->where('id_product', $id);
		if (!$this->db->delete('products_notes')) return FALSE;
		$this->db->where('id_product', $id);
		if (!$this->db->delete('products')) return FALSE;
		return TRUE;
		
	}

	function delete_note($id=FALSE) {
		$this->db->where('id_note', $id);
		if (!$this->db->delete('notes')) return FALSE;
		return TRUE;
		
	}

	function delete_page($id=FALSE) {
		$this->db->where('id_page', $id);
		if (!$this->db->delete('pages')) return FALSE;
		return TRUE;
		
	}

	function delete_review($id=FALSE) {
		$this->db->where('id_review', $id);
		if (!$this->db->delete('vote_review')) return FALSE;
		return TRUE;
		
	}

	function delete_capacity($id=FALSE) {
		$this->db->where('id_capacity', $id);
		if (!$this->db->delete('capacity')) return FALSE;
		return TRUE;
		
	}

	function delete_note_product($id=FALSE) {
		$this->db->where('id_product_notes', $id);
		if (!$this->db->delete('products_notes')) return FALSE;
		return TRUE;
		
	}

	function search_brand($char, $start, $limit) {
		if ($char == '') {
			return FALSE;
		}
		$this->db->limit($limit, $start);
	
		$this->db->like('name_brand', $char, 'before');
		$this->db->or_like('name_brand', $char, 'after');
			
		$this->db->group_by('brands.id_brand');
		$query = $this->db->get('brands');
		if (!$query->num_rows()) return FALSE;
		return $query->result();
	}

	function howmany_search_brand($char) {
		if ($char == '') {
			return FALSE;
		}
	
		$this->db->like('name_brand', $char, 'before');
		$this->db->or_like('name_brand', $char, 'after');
			
		$this->db->group_by('brands.id_brand');
		$query = $this->db->get('brands');
		if (!$query->num_rows()) return FALSE;
		return $query->num_rows();
	}

	function search_product($char, $start, $limit) {
		if ($char == '') {
			return FALSE;
		}
		$this->db->select(
			'products.id_product,
			products.product_name,
			products.id_brand,
			brands.name_brand,
			products.id_type,
			types.name_type,
			types.short_type'
		);
		$this->db->limit($limit, $start);
		$this->db->join('brands', 'products.id_brand = brands.id_brand', 'left');
		$this->db->join('types', 'products.id_type = types.id_type', 'left');
		$this->db->like('products.product_name', $char, 'before');
		$this->db->or_like('products.product_name', $char, 'after');
		$this->db->or_like('brands.name_brand', $char, 'before');
		$this->db->or_like('brands.name_brand', $char, 'after');
		$this->db->or_like('products.id_product', $char, 'after');
		$this->db->or_like('products.id_product', $char, 'before'); 
			
		$this->db->group_by('products.id_product');
		$query = $this->db->get('products');
		if (!$query->num_rows()) return FALSE;
		return $query->result();
	}

	function howmany_search_product($char) {
		if ($char == '') {
			return FALSE;
		}
		$this->db->select(
			'products.id_product,
			products.product_name,
			products.id_brand,
			brands.name_brand,
			products.id_type,
			types.name_type'
		);
		$this->db->join('brands', 'products.id_brand = brands.id_brand', 'left');
		$this->db->join('types', 'products.id_type = types.id_type', 'left');
	
		$this->db->like('products.product_name', $char, 'before');
		$this->db->or_like('products.product_name', $char, 'after');
		$this->db->or_like('brands.name_brand', $char, 'before');
		$this->db->or_like('brands.name_brand', $char, 'after');
		$this->db->or_like('products.id_product', $char, 'after'); 
			
		$this->db->group_by('products.id_product');
		$query = $this->db->get('products');
		if (!$query->num_rows()) return FALSE;
		return $query->num_rows();
	}

	function search_note($char, $start, $limit) {
		if ($char == '') {
			return FALSE;
		}
		$this->db->limit($limit, $start);
	
		$this->db->like('name_note', $char, 'before');
		$this->db->or_like('name_note', $char, 'after');
			
		$this->db->group_by('notes.id_note');
		$query = $this->db->get('notes');
		if (!$query->num_rows()) return FALSE;
		return $query->result();
	}

	function search_review($char, $start, $limit) {
		if ($char == '') {
			return FALSE;
		}
		$this->db->select(
			'vote_review.id_review,
			vote_review.id_user,
			users.login,
			vote_review.id_product,
			products.product_name,
			vote_review.score,
			vote_review.textreview,
			vote_review.data_review'
		);
		$this->db->limit($limit, $start);
	
		$this->db->like('product_name', $char, 'before');
		$this->db->or_like('product_name', $char, 'after');

		$this->db->or_like('textreview', $char, 'before');
		$this->db->or_like('textreview', $char, 'after');

		$this->db->or_like('login', $char, 'before');
		$this->db->or_like('login', $char, 'after');
			
		$this->db->group_by('vote_review.id_review');
		$this->db->join('users', 'users.id = vote_review.id_user', 'left');
		$this->db->join('products', 'products.id_product = vote_review.id_product', 'left');
		$query = $this->db->get('vote_review');
		if (!$query->num_rows()) return FALSE;
		return $query->result();
	}

	function howmany_search_note($char) {
		if ($char == '') {
			return FALSE;
		}
	
		$this->db->like('name_note', $char, 'before');
		$this->db->or_like('name_note', $char, 'after');
			
		$this->db->group_by('notes.id_note');
		$query = $this->db->get('notes');
		if (!$query->num_rows()) return FALSE;
		return $query->num_rows();
	}

	function howmany_search_review($char) {
		if ($char == '') {
			return FALSE;
		}
		$this->db->select(
			'vote_review.id_review,
			vote_review.id_user,
			users.login,
			vote_review.id_product,
			products.product_name,
			vote_review.score,
			vote_review.textreview,
			vote_review.data_review'
		);
		$this->db->like('product_name', $char, 'before');
		$this->db->or_like('product_name', $char, 'after');

		$this->db->or_like('textreview', $char, 'before');
		$this->db->or_like('textreview', $char, 'after');

		$this->db->or_like('login', $char, 'before');
		$this->db->or_like('login', $char, 'after');
			
		$this->db->group_by('vote_review.id_review');
		$this->db->join('users', 'users.id = vote_review.id_user', 'left');
		$this->db->join('products', 'products.id_product = vote_review.id_product', 'left');
		$query = $this->db->get('vote_review');
		if (!$query->num_rows()) return FALSE;
		return $query->num_rows();
	}

	function edit_capacity($t) {
		$insert = array (
			//'id_capacity'		=> $t['id_capacity'],
			'ean' 				=> $t['ean'],
			'capacity_value'	=> $t['capacity_value']
		);
		$this->db->where('id_capacity', $t['id_capacity']);
		if (!$this->db->update('capacity', $insert))  return FALSE;
		return TRUE; 
	}

	function get_capacity_by_id($id) {
		$this->db->where('id_capacity', $id);
		$query = $this->db->get('capacity');
		if (!$query->num_rows()) return FALSE;
		return $query->result();
	}

	function is_ean($ean, $id) {
		$this->db->where('ean', $ean);
		$this->db->where('id_capacity !=', $id);
		$query = $this->db->get('capacity');
		if ($query->num_rows()) {
			return TRUE;
		} else {
			return FALSE;
		}
		
	}

	function is_note($id_note) {
		$this->db->where('id_note', $id_note);
		$query = $this->db->get('notes');
		if ($query->num_rows()) {
			return TRUE;
		} else {
			return FALSE;
		}
		
	}

	function is_note_in_product($id_note, $id_product) {
		$this->db->where('id_note', $id_note);
		$this->db->where('id_product', $id_product);
		$query = $this->db->get('products_notes');
		if ($query->num_rows()) {
			return TRUE;
		} else {
			return FALSE;
		}
		
	}
}