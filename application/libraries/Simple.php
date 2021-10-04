<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
/**
* User Class
* @package	pearsystem
* @subpackage	pearsystem
* @category	pearsystem
* @author	Author gruha - dabrowskiw@gmail.com
* @link	http://www.wojciechdabrowski.pl
*/
class Simple {
	var $CI = FALSE;
	
	function Simple() {
		$this->CI =& get_instance(); 
	}
	
	function convert_title($title) {
		return "=?UTF-8?B?".base64_encode($title)."?=";
	}
	
	function pagination_config() {
		//pierwszy
		$config['first_link'] = 'First';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		//ostatni
		$config['last_link'] = 'Last';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		//następny
		$config['next_link'] = '&gt;';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		//poprzedni
		$config['prev_link'] = '&lt;';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		//obecny
		$config['cur_tag_open'] = '<li><a style="background: #f16325; color: #ffffff; border: 1px solid #f16325;">';
		$config['cur_tag_close'] = '</a></li>';
		//strony
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
	}
}

/* End of file myfile.php */
/* Location: ./system/modules/mymodule/myfile.php */