<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Sitemaps Class
* @package     Perfume Base
* @category    Sitemap
* @author      Wojciech Dąbrowski <dabrowskiw@gmail.com>
* @link        http://example.com
*/

class Sitemap extends CI_Controller {

	function __construct() {
		parent::__construct();
        $this->load->library('Sitemaps');
        $this->load->helper('url');
        $this->load->model(array('sitemap_model'));
    }
 
    function create_sitemaps() {
        //$this->sitemaps->add(base_url("database"), $time, 'monthly', 0.8);
		//$this->sitemaps->add(base_url("database/brands"), $time, 'monthly', 0.8);
        //$this->sitemaps->add(base_url("page/showpage/3"), $time, 'monthly', 0.8);
        $this->sitemaps->add_item(
            array(
            "loc" => base_url(),
            "lastmod" => date('c',time()),
            "changefreq" => "weekly",
            "priority" => "1.0"
            )
        );

        $this->sitemaps->add_item(
            array(
            "loc" => base_url("database"),
            "lastmod" => date('c',time()),
            "changefreq" => "weekly",
            "priority" => "0.9"
            )
        );
        $this->sitemaps->add_item(
            array(
            "loc" => base_url("database/brands"),
            "lastmod" => date('c',time()),
            "changefreq" => "weekly",
            "priority" => "0.9"
            )
        );
        $this->sitemaps->add_item(
            array(
            "loc" => base_url("database/notes"),
            "lastmod" => date('c',time()),
            "changefreq" => "weekly",
            "priority" => "0.9"
            )
        );

		foreach ($this->sitemap_model->get_products() as $products) {
            $item = array(
                "loc" => base_url("database/product/".$products->id_product),
                "lastmod" => date('c',time()),
                "changefreq" => "weekly",
                "priority" => "0.7"
            );
            $this->sitemaps->add_item($item);
		}
		foreach ($this->sitemap_model->get_brands() as $brands) {
            $item2 = array(
                "loc" => base_url("database/brand/".$brands->id_brand),
                "lastmod" => date('c',time()),
                "changefreq" => "monthly",
                "priority" => "0.6"
            );
            $this->sitemaps->add_item($item2);
		}
		foreach ($this->sitemap_model->get_notes() as $notes) {
            $item3 = array(
                "loc" => base_url("database/note/".$notes->id_note),
                "lastmod" => date('c',time()),
                "changefreq" => "monthly",
                "priority" => "0.6"
            );
            $this->sitemaps->add_item($item3);
		}

        // file name may change due to compression
        $file_name = $this->sitemaps->build("sitemap.xml");

        $reponses = $this->sitemaps->ping(site_url($file_name));
    }
}