<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Search_model extends CI_Model {

	function __construct()
    {
        // Call the Model constructor
		parent::__construct();
		//$this->output->enable_profiler(TRUE);
    }

    function search($char, $start, $limit) {
		if ($char == '') {
			return FALSE;
		}
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

		$this->db->like('products.product_name', $char, 'before');
		$this->db->or_like('products.product_name', $char, 'after');
		$this->db->or_like('brands.name_brand', $char, 'before');
		$this->db->or_like('brands.name_brand', $char, 'after'); 
		
		$this->db->group_by('products.id_product');
		$query = $this->db->get('products');
		if (!$query->num_rows()) return FALSE;
		return $query->result();
    }

    function howmany_search($char) {
		if ($char == '') {
			return 0;
		}
		$this->db->select(
			'products.id_product'
		);
		$this->db->join('types', 'types.id_type = products.id_type', 'left');
		$this->db->join('authors', 'authors.id_author = products.id_author', 'left');
		$this->db->join('products_images', 'products_images.id_product = products.id_product', 'left');
		$this->db->join('brands', 'brands.id_brand = products.id_brand', 'left');
        
		//$this->db->or_like('products.product_name', $char);
		//$this->db->or_like('brands.name_brand', $char); 
		
		$this->db->like('products.product_name', $char, 'before');
		$this->db->or_like('products.product_name', $char, 'after');
		$this->db->or_like('brands.name_brand', $char, 'before');
		$this->db->or_like('brands.name_brand', $char, 'after'); 
		
		$this->db->group_by('products.id_product');
		$query = $this->db->get('products');
		if (!$query->num_rows()) return FALSE;
		return $query->num_rows();
	}
}