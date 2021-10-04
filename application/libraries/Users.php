<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users {
	var $CI;
	var $logged = FALSE;
	var $user = FALSE;

	function __construct()  {
		$this->CI =& get_instance();
		$this->CI->load->helper('cookie');
		$this->CI->load->database();
		$this->CI->load->library('session');
		// odczytujemy dane uzytkownika
		if (get_cookie('cookie_login') && get_cookie('cookie_session')) {
			$this->CI->db->where('session_id', get_cookie('cookie_session'));
			$this->CI->db->where('login', get_cookie('cookie_login'));
			$query = $this->CI->db->get('users');

			if ($query->num_rows()) {
				$user = $query->row();
				$this->logged = TRUE;
				$this->user = $user->login;
			}
		} else {
			$this->CI->db->where('session_id', session_id());
			$this->CI->db->where('login', $this->CI->session->userdata('login'));
			$query = $this->CI->db->get('users');

			if ($query->num_rows()) {
				$user = $query->row();
				$this->logged = TRUE;
				$this->user = $user->login;
			}
		}
	}

	function print_user() {
		return $this->user;
	}

	function logged() {
		return $this->logged;
	}

	function print_id_user() {
		$this->CI->db->where('login', $this->user);
		$query = $this->CI->db->get('users');
		if ($query->num_rows()) {
			$dane = $query->row();
			return $dane->id;
		} else {
			return FALSE;
		}
	}

	/*
	 * Weryfikuje czy potwiedzony
	*/
	public function is_registration($login) {
		$this->CI->db->where('login', $login);
		$query = $this->CI->db->get('users');
		foreach ($query->result() as $row) {
			if ($row->confirmed == 0) {
				return FALSE;
			} else {
				return TRUE;
			}
		}
	}

	/*
	 * Loguje użytkownika
	*/
	function login($login, $autologin) {
		if ($autologin == 'ok') {
			$session = session_id();
			$this->CI->session->set_userdata('login', $login);
			$cookie_session = array(
                   'name'   => 'cookie_session',
                   'value'  => $session,
                   'expire' => '15552000'
               );
			set_cookie($cookie_session);
			$cookie_login = array(
                   'name'   => 'cookie_login',
                   'value'  => $login,
                   'expire' => '15552000'
               );
			set_cookie($cookie_login);
			$this->CI->db->where('login', $login);
			$this->CI->db->update('users', array('session_id' => $session));
		} else {
			$session = session_id();
			$this->CI->session->set_userdata('login', $login);
			$this->CI->db->where('login', $login);
			$this->CI->db->update('users', array('session_id' => $session));
		}
	}


	function logout() {
		$this->CI->session->sess_destroy();
		delete_cookie('cookie_session');
		delete_cookie('cookie_login');
		$this->logged = FALSE;
		$this->user = FALSE;
	}

	function add_groups($group) {
		if ($this->is($group)) return FALSE; // sprawdza czy nale�y do grupy
		$groups = $this->groups();
		$groups[] = $group;
		$groups = serialize($groups);
		return $this->save_groups($groups);
	}

	function is($group) {
		$groups = $this->groups(); // zapisuje groupe do zmiennej w postaci tablicy
		return in_array($group, $groups); // przeszukuje tablie aby znales $group
	}

	function del_groups($group) {
		if (!$this->is($group)) return FALSE;
		$groups = $this->groups();
		$n = array();
		for ($i=0; $i < count($group); $i++) {
			if ($groups[$i] != $group) $n = $groups[$i];
		}
		$n = serialize($n);
		$this->save_groups($n);
	}

	function save_groups($groups) {
		$g = array (
				'groups' => $groups
		);
		$this->CI->db->where('login', $this->user);
		if ($this->CI->db->update('users', $g)) return TRUE;
		return FALSE;
	}

	function groups() { // zawsze zwraca tablice, je�li nie nale�y to zwraca FALSE
		if ($this->user == FALSE) return array();
		$this->CI->db->where('login', $this->user);
		$query = $this->CI->db->get('users'); // wybiera jednego u�ytkownika

		if ($query->num_rows() == 0) {
			return array(); // jesli brak zwaraca pusta tablice
		} else {
			$user = $query->row(); // zwraca u�ytkownika
			$groups = @unserialize($user->groups); // pobiera z bazy wartosc i ja odeserializuje
			if ($groups == FALSE) return array(); // jesli nie ma nic w bazei to zwraca pusta tablice
			return $groups; // jesli jest zwraca wartosc grupy z bazy
		}
	}
}

/* End of file users.php */
/* Location: ./application/libraries/users.php */
