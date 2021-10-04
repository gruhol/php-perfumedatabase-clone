<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * @author Wojciech Dabrowski <dabrowskiw@gmail.com>
 * @version 1.0
 * @access public
 *
 */
class Sitemap_model extends CI_Model {
	
	/**
	 * Prepare the class variables for storing items and checking valid changefreq values
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct() {
		parent::__construct();
	}

	function get_products() {
		$this->db->select(
			'products.id_product'
		);
		$this->db->order_by('id_product', 'DESC');
		$query = $this->db->get('products'); //pobiera wartosci z tabeli dla id
		if (!$query->num_rows()) return FALSE; // zwraca False jak nie znalazł
		return $query->result();
	}

	function get_brands() {
		$this->db->select(
			'brands.id_brand'
		);
		$this->db->order_by('id_brand', 'DESC');
		$query = $this->db->get('brands'); //pobiera wartosci z tabeli dla id
		if (!$query->num_rows()) return FALSE; // zwraca False jak nie znalazł
		return $query->result();
	}

	function get_notes() {
		$this->db->select(
			'notes.id_note'
		);
		$this->db->order_by('id_note', 'DESC');
		$query = $this->db->get('notes'); //pobiera wartosci z tabeli dla id
		if (!$query->num_rows()) return FALSE; // zwraca False jak nie znalazł
		return $query->result();
	}

}