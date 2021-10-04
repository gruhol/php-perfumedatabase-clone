<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Database_model extends CI_Model {

	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

	function get_category_notes() {
		$query = $this->db->get('category_notes');
		if (!$query->num_rows()) return FALSE;
		return $query->result();
	}

	function get_notes_by_category($id)
	{
		$this->db->where('id_category_note', $id);
		$query = $this->db->get('notes'); //pobiera wartosci z tabeli dla id
		if (!$query->num_rows()) return FALSE; // zwraca False jak nie znalazł
		return $query->result_array();
	}

	function get_note($id_note)
	{
		$this->db->where('id_note', $id_note);
		$query = $this->db->get('notes'); //pobiera wartosci z tabeli dla id
		if (!$query->num_rows()) return FALSE; // zwraca False jak nie znalazł
		return $query->result();
	}
	
	function get_brands($char = 'A')
	{
		$this->db->like('name_brand', $char, 'after');
		$query = $this->db->get('brands'); //pobiera wszystkie wartosci z tabeli
		if (!$query->num_rows()) return FALSE; // zwraca False jak nie znalazł
		return $query->result();
	}
	
	function get_brands_to_from()
	{
		$this->db->select(
			'id_brand,
			name_brand'
		);
		$query = $this->db->get('brands'); //pobiera wszystkie wartosci z tabeli
		if (!$query->num_rows()) return FALSE; // zwraca False jak nie znalazł
		return $query->result();
	}

	function get_brand($id)
	{
		$this->db->where('id_brand', $id);
		$query = $this->db->get('brands'); //pobiera wartosci z tabeli dla id
		if (!$query->num_rows()) return FALSE; // zwraca False jak nie znalazł
		return $query->result();
	}

	function get_authors($char = 'A')
	{
		$this->db->like('author_name', $char, 'after');
		$query = $this->db->get('authors'); //pobiera wszystkie wartosci z tabeli
		if (!$query->num_rows()) return FALSE; // zwraca False jak nie znalazł
		return $query->result();
	}

	function get_author($id)
	{
		$this->db->where('id_author', $id);
		$query = $this->db->get('authors'); //pobiera wartosci z tabeli dla id
		if (!$query->num_rows()) return FALSE; // zwraca False jak nie znalazł
		return $query->result();
	}

	function get_products($where = FALSE, $sex = FALSE, $brands_input = FALSE, $start, $limit) {
		$this->db->select(
			'products.id_product,
			products.product_name,
			products.id_brand,
			brands.id_brand,
			brands.name_brand,
			products.creation_date,
			products.sex,
			types.name_type,
			types.short_type,
			products_images.url_image,
			products_images.alt_image'
		);
		$this->db->limit($limit, $start);
		$this->db->join('types', 'types.id_type = products.id_type', 'left');
		$this->db->join('authors', 'authors.id_author = products.id_author', 'left');
		$this->db->join('products_images', 'products_images.id_product = products.id_product', 'left');
		$this->db->join('brands', 'brands.id_brand = products.id_brand', 'left');
		
		if ($where !== FALSE) {
			$this->db->where_in('types.short_type', $where);
		}
		if ($sex !== FALSE) {
			$this->db->where_in('products.sex', $sex);
		}
		if ($brands_input !== FALSE) {
			$this->db->where_in('brands.id_brand', $brands_input);
		}
		//$this->db->distinct('products.id_product');
		$this->db->group_by('products.id_product');
		$this->db->order_by('products.id_product', 'DESC');
		$query = $this->db->get('products');
		if (!$query->num_rows()) return FALSE;
		return $query->result();
	}

	function howmany2($where = FALSE, $sex = FAlSE, $brands_input = FALSE) {
		$this->db->select(
			'products.id_product'
		);
		$this->db->join('types', 'types.id_type = products.id_type', 'left');
		$this->db->join('authors', 'authors.id_author = products.id_author', 'left');
		$this->db->join('products_images', 'products_images.id_product = products.id_product', 'left');
		$this->db->join('brands', 'brands.id_brand = products.id_brand', 'left');

		if ($where !== FALSE) {
			$this->db->where_in('types.short_type', $where);
		}
		if ($sex !== FALSE) {
			$this->db->where_in('products.sex', $sex);
		}
		if ($brands_input !== FALSE) {
			$this->db->where_in('brands.id_brand', $brands_input);
		}
		$this->db->group_by('products.id_product');
		//$this->db->distinct('products.id_product');
		$this->db->order_by('products.id_product', 'ASC');
		$query = $this->db->get('products');
		if (!$query->num_rows()) return FALSE;
		return $query->num_rows();
	}

	function get_products_by_brand($id_brand, $where = FALSE, $sex = FALSE, $start, $limit) {
		$this->db->select(
			'products.id_product,
			products.product_name,
			products.id_brand,
			brands.name_brand,
			products.creation_date,
			products.sex,
			types.name_type,
			types.short_type,
			products_images.url_image,
			products_images.alt_image'
			
		);
		$this->db->limit($limit, $start);
		$this->db->where('products.id_brand', $id_brand);
		if ($where !== FALSE) {
			$this->db->where_in('types.short_type', $where);
		}
		if ($sex !== FALSE) {
			$this->db->where_in('products.sex', $sex);
		}
		$this->db->join('types', 'types.id_type = products.id_type', 'left');
		$this->db->join('authors', 'authors.id_author = products.id_author', 'left');
		$this->db->join('products_images', 'products_images.id_product = products.id_product', 'left');
		$this->db->join('brands', 'brands.id_brand = products.id_brand', 'left');
		$this->db->group_by('products.id_product');
		$this->db->order_by('products.id_product', 'DESC');
		$query = $this->db->get('products');
		if (!$query->num_rows()) return FALSE;
		return $query->result();
	}

	function get_product($id) {
		$this->db->select(
			'products.id_product,
			products.product_name,
			products.id_brand,
			brands.name_brand,
			products.creation_date,
			products.description,
			products.id_author,
			authors.author_name,
			products.sex,
			types.name_type,
			types.short_type'
			);
		$this->db->where('id_product', $id);
		$this->db->join('types', 'types.id_type = products.id_type', 'left');
		$this->db->join('authors', 'authors.id_author = products.id_author', 'left');
		$this->db->join('brands', 'brands.id_brand = products.id_brand', 'left');
		$query = $this->db->get('products');
		if (!$query->num_rows()) return FALSE;
		return $query->result();
	}

	function get_capacity($id)
	{
		$this->db->where('id_product', $id);
		$query = $this->db->get('capacity'); //pobiera wartosci z tabeli dla id
		if (!$query->num_rows()) return FALSE; // zwraca False jak nie znalazł
		return $query->result();
	}

	function get_vote_stats($id, $votename)
	{
		$this->db->where('id_product', $id);
		$query = $this->db->select_sum($votename);
		$query = $this->db->get('vote_stats');
		$query->result();
		if  ($query->row($votename) !== NULL) {
			return $query->row($votename);
		} else {
			return 0;
		}
		
	}

	function get_vote_user($id_user, $id_product, $votename) {
		$this->db->where('id_user', $id_user);
		$this->db->where('id_product', $id_product);
		$query = $this->db->get('vote_stats');
		$query->result();
		return $query->row($votename);
	}

	function get_notes($id, $type)
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

	function get_notes2($id, $type, $id_user)
	{
		$this->db->select(
			'notes.id_note,
			notes.name_note,
			vote_notes.vote_value'
		);
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
		$this->db->where('products_notes.id_product', $id);
		$this->db->where('id_user', $id_user);
		$this->db->join('notes', 'notes.id_note = products_notes.id_note');
		$this->db->join('vote_notes', 'vote_notes.id_note = products_notes.id_note');
		$query = $this->db->get('products_notes'); //pobiera wartosci z tabeli dla id
		if (!$query->num_rows()) return FALSE; // zwraca False jak nie znalazł
		return $query->result();
	}

	function save_vote($data, $id_user, $id_product) {
		$this->db->where('id_user', $id_user);
		$this->db->where('id_product', $id_product);
		$query = $this->db->get('vote_stats');
		if (!$query->num_rows()) {
			$this->db->where('id_user', $id_user);
			$this->db->where('id_product', $id_product);
			if ($this->db->insert('vote_stats', $data)) {
				return TRUE;
			} else {
				return FALSE;
			}
		} else {
			$this->db->where('id_user', $id_user);
			$this->db->where('id_product', $id_product);
			if ($this->db->update('vote_stats', $data)) {
				return TRUE;
			} else {
				return FALSE;
			}
		}
	}
	function get_user_vote_review($id_user, $id_product, $what) {
		$this->db->where('id_user', $id_user);
		$this->db->where('id_product', $id_product);
		$query = $this->db->get('vote_review');
		$query->result();
		return $query->row($what);
	}

	function get_score_average($id_product, $what) {
		//$this->db->where('id_user', $id_user);
		$this->db->where('id_product', $id_product);
		$query = $this->db->get('vote_review');
		$query->result();
		return $query->row($what);
	}

	function get_all_vote_reviews($id_product) {
		$this->db->select(
			'users.login,
			vote_review.textreview,
			vote_review.score,
			vote_review.data_review'
			);
		$this->db->where('id_product', $id_product);
		$this->db->join('users', 'users.id = vote_review.id_user');
		$query = $this->db->get('vote_review');
		if (!$query->num_rows()) return FALSE;
		return $query->result();
	}

	function get_staruserint($id_product) {
		$this->db->where('id_product', $id_product);
		$query = $this->db->get('vote_review');
		if (!$query->num_rows()) return 1;
		return $query->num_rows();
	}

	function save_review($record) {
		$insert = array (
			'id_user'		=> $record['id_user'],
			'id_product' 	=> $record['id_product'],
			'score'			=> $record['score'],
			'textreview'	=> $record['textreview'],
		);
		$this->db->where('id_product', $record['id_product']);
		$this->db->where('id_user', $record['id_user']);
		$query = $this->db->get('vote_review');
		// check user send review before on this product
		if (!$query->num_rows()) {
			// if not then save this review
			$this->db->set($insert);
			$this->db->where('id_product', $record['id_product']);
			$this->db->where('id_user', $record['id_user']);
			if (!$this->db->insert('vote_review')) return FALSE;
			return TRUE;
		} else {
			//if yes update this records
			$this->db->where('id_product', $record['id_product']);
			$this->db->where('id_user', $record['id_user']);
			if (!$this->db->update('vote_review', $insert))  return FALSE;
			return TRUE;
		}
	}

	function get_score_product($id_product) {
		$this->db->select('AVG(score) avg_score');
		$this->db->where('id_product', $id_product);
		$result=$this->db->get('vote_review')->row();
		return round($result->avg_score, 2);
	}

	function del_review($id_product, $id_user) {
		$this->db->where('id_user', $id_user);
		$this->db->where('id_product', $id_product);
		if($this->db->delete('vote_review')) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	function save_note_stats($record) {
		$insert = array (
			'id_user'		=> $record['id_user'],
			'id_product' 	=> $record['id_product'],
			'id_note'		=> $record['id_note'],
			'vote_value'	=> $record['vote_value'],
		);
		$this->db->where('id_product', $record['id_product']);
		$this->db->where('id_user', $record['id_user']);
		$this->db->where('id_note', $record['id_note']);
		$query = $this->db->get('vote_notes');
		// check user send review before on this product
		if (!$query->num_rows()) {
			// if not then save this review
			$this->db->set($insert);
			$this->db->where('id_product', $record['id_product']);
			$this->db->where('id_user', $record['id_user']);
			$this->db->where('id_note', $record['id_note']);
			if (!$this->db->insert('vote_notes')) return FALSE;
			return TRUE;
		} else {
			//if yes update this records
			$this->db->where('id_product', $record['id_product']);
			$this->db->where('id_user', $record['id_user']);
			$this->db->where('id_note', $record['id_note']);
			if (!$this->db->update('vote_notes', $insert))  return FALSE;
			return TRUE;
		}
	}
	/* Get vote for note from product
	* @param	   $id_user intiger
	* @param	   $id_product intiger
	* @return      array
	*/
	function get_user_vote_notes($id_user, $id_product) {
		$this->db->where('id_user', $id_user);
		$this->db->where('id_product', $id_product);
		$query = $this->db->get('vote_notes');
		if (!$query->num_rows()) return FALSE;
		return $query->result();
	}

	function get_ranking_note($id) {
		$this->db->select(
			'vote_notes.id_note,
			notes.name_note,
			SUM(vote_notes.vote_value) as total_value'
			);
		$this->db->where('vote_notes.id_product', $id);
		$this->db->join('notes', 'notes.id_note = vote_notes.id_note');
		$this->db->group_by('notes.id_note');
		$this->db->order_by('total_value', 'DESC'); 
		$query = $this->db->get('vote_notes');
		if (!$query->num_rows()) return FALSE;
		return $query->result();
	}

	function get_image_of_product($id_product) {
		$this->db->where('id_product', $id_product);
		$this->db->where('main_image', 1);
		$query = $this->db->get('products_images');
		if (!$query->num_rows()) return FALSE;
		return $query->result();
	}

	function howmany($table, $id_brand, $where = FALSE, $sex = FALSE) {
		if ($where !== FALSE) {
			$this->db->where_in('types.short_type', $where);
		}
		if ($sex !== FALSE) {
			$this->db->where_in('products.sex', $sex);
		}
		$this->db->where("id_brand", $id_brand);
		$this->db->join('types', 'types.id_type = products.id_type', 'left');
		$this->db->group_by('products.id_product');
		$this->db->order_by('products.id_product', 'DESC');
		$query = $this->db->get("$table");
		if (!$query->num_rows()) return FALSE;
		return $query->num_rows();
	}

	function get_types() {
		$query = $this->db->get('types');
		if (!$query->num_rows()) return FALSE;
		return $query->result();
	}

	function get_types_by_filter($where = FALSE, $what = FALSE) {
		$this->db->select(
			'types.name_type,
			types.short_type,
			products.id_brand'
			);
		$this->db->join('products', 'products.id_type = types.id_type');
		$this->db->group_by('types.name_type');

		if ($where !== FALSE AND $what !== FALSE) {
			$this->db->where("$where", "$what");
		}
		$query = $this->db->get('types');
		if (!$query->num_rows()) return FALSE;
		return $query->result();
	}

	function get_sex_by_filter($where = FALSE, $what = FALSE) {
		$this->db->select(
			'products.sex'
			);
		$this->db->group_by('products.sex');

		if ($where !== FALSE AND $what !== FALSE) {
			$this->db->where("$where", "$what");
		}
		$query = $this->db->get('products');
		if (!$query->num_rows()) return FALSE;
		return $query->result_array();
	}
}
