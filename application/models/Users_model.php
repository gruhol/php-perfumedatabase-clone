<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends CI_Model {

	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
	
	function get_user($login) 
	{
		$this->db->where('login', $login);
		$query = $this->db->get('user'); //pobiera wszystkie warto�ci z tabeli
		if (!$query->num_rows()) return array(); // zwraca pust� tablic�
		return $query->result();
	}
	
	function get_user_id($login) 
	{
		$this->db->where('login', $login);
		$query = $this->db->get('users'); //pobiera wszystkie warto�ci z tabeli
		if (!$query->num_rows()) return FALSE; // zwraca pust� tablic�
		foreach ($query->result() as $row)
		{
			return $row->id;
		}
	}
	
	function email_exist($email) 
	{
		$this->db->where('email', $email);
		$query = $this->db->get('users');
		if (!$query->num_rows()) return FALSE;
		foreach ($query->result() as $row)
		{
			return TRUE;
		}
	}
	
	function get_user_login($email) 
	{
		$this->db->where('email', $email);
		$query = $this->db->get('users'); //pobiera wszystkie warto�ci z tabeli
		if (!$query->num_rows()) return FALSE; // zwraca pust� tablic�
		foreach ($query->result() as $row)
		{
			return $row->login;
		}
	}
	
	function change_password($password, $login) 
	{
		$new_link = md5(time());
		$id = $this->users_model->get_user_id($login);
		$data = array (
			'link'	=> $new_link
		);
		$this->db->where('id_user', $id);
		if ($this->db->update('confirmation_users', $data)) 
		{
			$hashpassword = password_hash($password, PASSWORD_BCRYPT);
			$insert = array (
					'password'	=> $hashpassword
			);
			$this->db->where('login', $login);
			if (!$this->db->update('users', $insert)) return FALSE;
			return TRUE;
		} else 
		{
			return FALSE;
		}
	}
	
	
	function adduser($record) 
	{
		$insert = array (
				'login'			=> $record['login'],
				'email' 		=> $record['email'],
				'confirmed'		=> $record['confirmed']
		);
		
		if (!$this->db->insert('users', $insert)) return FALSE;
		return TRUE;
	}
	
	function check($login, $password) 
	{
		//pobieramy dane uzytkownika
		$this->db->where('login', $login); // jedno zapytanie
		$query = $this->db->get('users'); // jedno zapytanie
		
		if (!$query->num_rows()) return FALSE;
		
		$user = $query->row();
		
		if (password_verify($password, $user->password)) return TRUE;
		return FALSE;
	}
	
	function add_link($link, $id) 
	{
		$insert = array ( 
			'id_user' 	=> $id,
			'link' => $link
		);
		if (!$this->db->insert('confirmation_users', $insert)) return FALSE;
		return TRUE;
	}
	
	function code_check($number, $login)  
	{
		$id = $this->users_model->get_user_id($login);
		$this->db->where('link', $number);
		$this->db->where('id_user', $id);
		$query = $this->db->get('confirmation_users');
		if (empty($query->num_rows())) {
			return FALSE;
		} else {
			return TRUE;
		}
	}
	
	function validation_update($rekord) 
	{
		$timestamp = time();
		$linkdate = date("Y-m-d H:i:s", $timestamp);
		$this->db->where('login', $rekord['login']);
		if ($this->db->update('users', array('confirmed' => $rekord['confirmed'])) AND $this->db->update('confirmation_users', array('date' => $linkdate))) return TRUE;
		return FALSE;
	}
	
	function is_registration($login) 
	{ 
		$id = $this->users_model->get_user_id($login);
		$this->db->where('id_user', $id);
		$query = $this->db->get('confirmation_users');
		foreach ($query->result() as $row) {
			if (!$row->date) 
			{
				return FALSE;
			} else {
				return TRUE;
			}
		}
	}
	
	public function get_user_link($email)
	{
		$this->db->where('email', $email);
		$query = $this->db->get('users'); //pobiera wszystkie wartosci z tabeli
		if (!$query->num_rows()) return FALSE; // zwraca pusta tablic�
		foreach ($query->result() as $row)
		{
			$id = $row->id;
			$this->db->where('id_user', $id);
			$query2 = $this->db->get('confirmation_users');
			if (!$query2->num_rows()) return FALSE;
			foreach ($query2->result() as $row2) {
				return $row2->link;
			}
			
		}
	}
}

/* End of file myfile.php */
/* Location: ./system/modules/mymodule/myfile.php */