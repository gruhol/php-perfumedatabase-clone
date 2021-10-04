<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Import_model extends CI_Model {

	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
	function get_notes()
	{
		$query = $this->db->get('notes_temp_import'); //pobiera wartosci z tabeli dla id

		if (!$query->num_rows()) return FALSE; // zwraca False jak nie znalazł
		return $query->result();
	}

	function show_id_note($name) {
		$this->db->where('name_note', $name);
		$query = $this->db->get('notes'); //pobiera wartosci z tabeli dla id
		if (!$query->num_rows()) return FALSE; // zwraca False jak nie znalazł
		$data =  $query->row();
		if ($data->id_note !== 0) {
			return $data->id_note;
		} else {
			return FALSE;
		}
		/*foreach($query->num_rows() as $data) {
			return $data->id_note;
		}*/
		//return $query->result();
	}
	/*
	function insert_note($id_product, $id_note, $iswhere) {
		if ($iswhere == 1) {
			$insert = array (
				'id_product'		=> $id_product,
				'id_note' 			=> $id_note,
				'is_base_note'		=> 1,
				'is_head_note'		=> 0,
				'is_heart_note'		=> 0
			);
		} elseif ($iswhere == 2) {
			$insert = array (
				'id_product'		=> $id_product,
				'id_note' 			=> $id_note,
				'is_base_note'		=> 0,
				'is_head_note'		=> 1,
				'is_heart_note'		=> 0
			);
		} elseif ($iswhere == 3) {
			$insert = array (
				'id_product'		=> $id_product,
				'id_note' 			=> $id_note,
				'is_base_note'		=> 0,
				'is_head_note'		=> 0,
				'is_heart_note'		=> 1
			);
		}
		
		if (!$this->db->insert('products_notes', $insert)) return FALSE;
		return TRUE;
	}
	*/

	function import_images () {
		$query = $this->db->get('images_temp_import', 1000, 8509); //pobiera wartosci z tabeli dla id
		if (!$query->num_rows()) return FALSE; // zwraca False jak nie znalazł
		return $query->result();
	}

	/*
	function put_image($id_product, $id_capacity, $url_image, $alt_image) {
		$this->db->where('id_product', $id_product);
		$query = $this->db->get('products_images');
		if (!$query->num_rows()) {
			$insert = array (
				'id_product'		=> $id_product,
				'id_capacity' 		=> $id_capacity,
				'main_image'		=> 1,
				'url_image'			=> $url_image,
				'alt_image'			=> $alt_image
			);
			$this->db->where('id_product', $id_product);
			if ($this->db->insert('products_images', $insert)) {
				return TRUE;
			} else {
				return FALSE;
			}
		} else {
			$this->db->where('id_product', $id_product);
			$insert = array (
				'id_product'		=> $id_product,
				'id_capacity' 		=> $id_capacity,
				'main_image'		=> 0,
				'url_image'			=> $url_image,
				'alt_image'			=> $alt_image
			);
			$this->db->where('id_product', $id_product);
			if ($this->db->insert('products_images', $insert)) {
				return TRUE;
			} else {
				return FALSE;
			}
		}
	}
	*/
}
