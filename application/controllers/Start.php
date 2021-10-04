<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Start extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('html');
		$this->load->helper('url');
	}
	
	public function index()
	{
		$dataout = array(
	        'title' => 'Baza perfum - Strona główna',
    	);
		$this->load->view('main-site', $dataout);
	}
	
}