<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	/*
	* Konstruktor funkcji User
	*
	* @package     Perfume Base
	* @category    Użytkownik
	* @author      Wojciech Dąbrowski <dabrowskiw@gmail.com>
	* @link        http://example.com
	*/

	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url', 'language'));
		$this->load->library(array('layout', 'form_validation', 'session', 'users', 'recaptcha'));
		$this->config->load('cms', TRUE);
		$this->config->load('recaptcha', TRUE);
		$this->load->model('users_model');
		$this->lang->load(array('users', 'database'));
		//$this->output->enable_profiler(TRUE);
	}

	/** Funkcja do testow
	*
	* @access	public
	* @param	none
	* @return	none
	*/
	public function test()
	{
		echo '<br>';
		if ($this->users->is('admin')) {
			echo 'Nalezy';
		} else {
			echo 'chuj';
		}

	}	

	public function tajne()
	{
		$this->session->set_userdata('referred_from', uri_string());
		if (!$this->users->logged())
		{
			redirect('user/login_redirect');
		} else {
			echo 'Bardzo tajne dane';
		}
	}

	/** Funkcja przekierowująca po zalogowaniu na stronę z brakiem dostępu.
	*
	* @access public
	* @param string
	* @return object
	*/
	public function login_redirect()
	{
		$t = array
			(
				'title' => $this->lang->line('access denied'),
			);
			$this->layout->blok('user/is_login_user', 'content', $t);
			$this->layout->make('theme');
	}

	public function index()
	{
		$this->session->set_userdata('referred_from', uri_string());
		if (!$this->users->logged())
		{
			redirect('/user/login_redirect');
		}
		else
		{
			$t = array (
				'title'			=> 'Zalogowany',
				'msg_info'		=> 'Zalogowany',
				'session_id'	=> session_id(),
				'session_login'	=> $this->session->userdata('login'),
				'cookie_sesion' => get_cookie('cookie_session'),
				'cookies_login'	=> get_cookie('cookie_login')

			);
			$this->layout->blok('user/users_logged', 'content', $t);
			$this->layout->make('theme');
		}
	}

	/** Funkcja rejestraująca użytkownika
	 * @access public
	 * @param none
	 * @return mix
	 */
	public function add_user()
	{
		$config = array(
               array(
                     'field'   => 'login',
                     'label'   => $this->lang->line('users_login'),
                     'rules'   => 'trim|required|alpha_numeric|min_length[3]|max_length[50]|is_unique[users.login]'
			   ),
               array(
                     'field'   => 'email',
                     'label'   => $this->lang->line('users_adres_email'),
                     'rules'   => 'trim|required|valid_email|min_length[7]|max_length[150]|is_unique[users.email]'
			   ),
			   array(
                     'field'   => 'g-recaptcha-response',
                     'label'   => 'Captcha',
                     'rules'   => 'required|callback_recaptcha'
			   )
		);

    	$this->form_validation->set_rules($config);
		$css_style = $this->config->item('css_style_error', 'cms');
    	$this->form_validation->set_error_delimiters("<div class=\"$css_style\">", "</div>");
		if ($this->form_validation->run() == FALSE)
		{
			$t = array (
				'title'			=> $this->lang->line('users_registration_title'),
				'widget' 		=> $this->recaptcha->getWidget(),
				'script' 		=> $this->recaptcha->getScriptTag(),
				'recaptchasite' => $this->config->item('recaptcha_site_key'),
				'dupa'			=> "dupa",
			);
			$this->layout->blok('user/registration_user', 'content', $t);
			$this->layout->make('theme');
		}
		else
		{
			$datauser = array
			(
				'login'				=> set_value('login'),
				'email' 			=> set_value('email'),
				'confirmed'			=> 0,
				'link' 				=> md5(time())
			);

			if ($this->users_model->adduser($datauser))
			{
				if ($this->users_model->add_link($datauser['link'], $this->users_model->get_user_id($datauser['login'])))
				{
					$link = base_url();
					// content on email
					$message = $this->lang->line('users_email_line1').$this->config->item('site_name', 'cms').',<br><br>';
					$message .= $this->lang->line('users_email_line2').' '.$this->config->item('site_name', 'cms').'.<br>';
					$message .= $this->lang->line('users_email_line3');
					$message .= '<a href="'.$link.'user/validation/'.$datauser['link'].'/'.$datauser['login'].'/">'.$this->lang->line('users_click_here').'</a>';
					$message .= '<br><br>'.$this->lang->line('users_best_wisches').'<br>'.$this->lang->line('users_team').' '.$this->config->item('site_name', 'cms');

					$content = '<html><head><title>'.$this->lang->line('users_registration_conform').'</title></head><body>';
					$content .= $message;
					$content .= '</body></html>';

					$this->load->library('email');
					$config['protocol'] = 'smtp';
					$config['smtp_host'] = $this->config->item('smtp_host', 'cms');
					$config['smtp_user'] = $this->config->item('smtp_user', 'cms');
					$config['smtp_pass'] = $this->config->item('smtp_pass', 'cms');
					$config['smtp_port'] = $this->config->item('smtp_port', 'cms');
					$config['charset'] = 'utf-8';
					$config['wordwrap'] = TRUE;
					$config['mailtype'] = 'html';
					$config['useragent'] = $this->config->item('site_name', 'cms');

					$this->email->initialize($config);
					$this->email->from($this->config->item('admin_email', 'cms'), $this->config->item('site_name', 'cms'));
					$this->email->to($datauser['email']);
					$this->email->subject($this->lang->line('users_registration_conform'));
					$this->email->message($content);

					if ($this->email->send() == TRUE) {
						$t = array (
							'msg_info' 		=> $this->lang->line('users_registration_finish_and_send_email').set_value('email'),
							'title'			=> $this->lang->line('users_registration_title'),
							'widget' 		=> $this->recaptcha->getWidget(),
							'script' 		=> $this->recaptcha->getScriptTag(),
							'recaptchasite' 	=> $this->config->item('recaptcha_site_key')
						);
						$this->layout->blok('user/registration_info', 'content', $t);
						$this->layout->make('theme');
					} else
					{
						$t = array (
							'msg_info' 		=> $this->lang->line('users_email_error'),
							'title'			=> $this->lang->line('users_registration_title'),
							'widget' 		=> $this->recaptcha->getWidget(),
							'script' 		=> $this->recaptcha->getScriptTag(),
							'recaptchasite' 	=> $this->config->item('recaptcha_site_key')
						);
						log_message('error', 'Same error with sending registration email with link. Error SMTP');
						$this->layout->blok('user/registration_info', 'content', $t);
						$this->layout->make('theme');
					}
					//echo $this->email->print_debugger(array('headers'));
				}


			} else
			{
				log_message('error', 'Error registration. Cant add login and email to the database.');
				$t = array (
					'msg_info' 		=> $this->lang->line('users_registration_add_database_error'),
					'title'			=> $this->lang->line('users_registration_title'),
					'widget' 		=> $this->recaptcha->getWidget(),
					'script' 		=> $this->recaptcha->getScriptTag(),
					'recaptchasite' 	=> $this->config->item('recaptcha_site_key')
				);
				$this->layout->blok('user/registration_info', 'content', $t);
				$this->layout->make('theme');
			}
		}

	}

	/** Funkcja weryfikująca email na który wysłany został kod html
	 * @access public
	 * @param string
	 * @return boolen
	 */
	public function validation($number=FALSE, $login=FALSE)
	{
		if (($number===FALSE) OR ($login===FALSE))
		{
			show_404();
		}
		if ($this->users_model->code_check($number, $login))
		{
			if ($this->users_model->is_registration($login) == TRUE)
			{
				$t = array (
					'errors' 	=> $this->lang->line('users_registration_conform_again').'<br><br>',
					'title'		=> $this->lang->line('error')
				);
				$this->layout->blok('user/registration_error', 'content', $t);
				$this->layout->make('theme');
			} else
			{
				$wpisy = array (
					'login'				=> $login,
					'confirmed'			=> 1
				);
				if ($this->users_model->validation_update($wpisy))
				{

					$this->session->set_tempdata('login_first_password', $login, 300);
					redirect('/user/set_first_password/');
				}
			}
		} else
		{
			show_404();
		}
	}

	/** Function send email with link to change password
	 * @access public
	 * @param none
	 * @return boolen
	 */
	public function remember_password()
	{
		$config = array(
               array(
                     'field'   => 'email',
                     'label'   => $this->lang->line('users_adres_email'),
                     'rules'   => 'trim|required|valid_email|min_length[7]|max_length[150]|callback_email_exist'
			   )
		);

        $this->form_validation->set_rules($config);
		$css_style = $this->config->item('css_style_error', 'cms');
        $this->form_validation->set_error_delimiters("<div class=\"$css_style\">", "</div>");
		if ($this->form_validation->run() == FALSE)
		{
			$t = array (
				'title'		=> $this->lang->line('users_remember_password')
			);
			$this->layout->blok('user/send_pass', 'content', $t);
			$this->layout->make('theme');
		} else
		{

			$url_page = base_url();
			$login = $this->users_model->get_user_login(set_value('email'));
			$link = $this->users_model->get_user_link(set_value('email'));
			// content on email
			$message = $this->lang->line('users_remember_pass_email_line1').$login.',<br /><br />';
			$message .= $this->lang->line('users_remember_pass_email_line2').'<br />';
			$message .= $this->lang->line('users_remember_pass_email_line3').'<br /><br />';
			$message .= '<a href="'.$url_page.'user/change_password/'.$link.'/'.$login.'/">'.$this->lang->line('users_click_here').'</a><br /><br />';
			$message .= $this->lang->line('users_remember_pass_email_line4').'<br /><br />';
			$message .= '<br><br>'.$this->lang->line('users_best_wisches').'<br>'.$this->lang->line('users_team').' '.$this->config->item('site_name', 'cms');

			$content = '<html><head><title>'.$this->lang->line('users_email_remember_password').'</title></head><body>';
			$content .= $message;
			$content .= '</body></html>';
			$subject = $this->lang->line('users_email_remember_pass_subject').$this->config->item('site_name', 'cms');

			$this->load->library('email');
			$config['protocol'] = 'smtp';
			$config['smtp_host'] = $this->config->item('smtp_host', 'cms');
			$config['smtp_user'] = $this->config->item('smtp_user', 'cms');
			$config['smtp_pass'] = $this->config->item('smtp_pass', 'cms');
			$config['smtp_port'] = $this->config->item('smtp_port', 'cms');
			$config['charset'] = 'utf-8';
			$config['wordwrap'] = TRUE;
			$config['mailtype'] = 'html';
			$config['useragent'] = $this->config->item('site_name', 'cms');

			$this->email->initialize($config);
			$this->email->from($this->config->item('admin_email', 'cms'), $this->config->item('site_name', 'cms'));
			$this->email->to(set_value('email'));
			$this->email->subject($subject);
			$this->email->message($content);

			if ($this->email->send() == TRUE)
			{
				$t = array (
					'msg_info' 	=> $this->lang->line('users_email_remeber_send').set_value('email'),
					'title'		=> $this->lang->line('users_remember_password')
				);
				$this->layout->blok('user/registration_info', 'content', $t);
				$this->layout->make('theme');
			} else
			{
				$t = array (
					'msg_info' 	=> $this->lang->line('users_email_remeber_send_error'),
					'title'		=> $this->lang->line('users_remember_password')
				);
				log_message('error', 'Same error with sending remember password. Error SMTP');
				$this->layout->blok('user/registration_info', 'content', $t);
				$this->layout->make('theme');
			}
		}
	}

	/* Funkcja ustawiająca pierwsze hasło
	 * Przekierowywana jest z user/validation
	 * @access public
	 * @param $_SESSION
	 * @return boolen
	 */
	public function set_first_password()
	{
		if (!isset($_SESSION['login_first_password'])) show_404();
		$config = array(
               array(
                     'field'   => 'password',
                     'label'   => $this->lang->line('users_password'),
                     'rules'   => 'required|min_length[6]|max_length[25]'
			   ),
               array(
                     'field'   => 'passconf',
                     'label'   => $this->lang->line('users_passconf'),
                     'rules'   => 'required|matches[password]|min_length[6]|max_length[25]'
			   )
		);

        $this->form_validation->set_rules($config);
		$css_style = $this->config->item('css_style_error', 'cms');
        $this->form_validation->set_error_delimiters("<div class='$css_style'>", "</div>");
		if ($this->form_validation->run() == FALSE)
		{
			$t = array (
				'title'		=> $this->lang->line('users_registration_finish')
			);
			$this->layout->blok('user/set_user_password', 'content', $t);
			$this->layout->make('theme');
		} else
		{
			if ($this->users_model->change_password(set_value('password'), $_SESSION['login_first_password']))
			{
				$t = array (
					'errors' 	=> $this->lang->line('users_password_add').'<br><br>',
					'title'		=> $this->lang->line('users_registration_finish')
				);
				$this->layout->blok('user/registration_error', 'content', $t);
				$this->layout->make('theme');
			} else
			{
				$t = array (
					'errors' 	=> $this->lang->line('users_password_add_error').'<br><br>',
					'title'		=> $this->lang->line('users_registration_finish')
				);
				$this->layout->blok('user/registration_error', 'content', $t);
				$this->layout->make('theme');
			}

		}

	}

	/* Funkcja ustawiająca pierwsze hasło
	 * Przekierowywana jest z user/validation
	 * @access public
	 * @param strings
	 * @return boolen
	 */
	public function change_password($link = FALSE, $login = FALSE)
	{
		if (($link===FALSE) OR ($login===FALSE))
		{
			show_404();
		}
		if ($this->users_model->code_check($link, $login))
		{
			$config = array(
	               array(
	                     'field'   => 'password',
	                     'label'   => $this->lang->line('users_password'),
	                     'rules'   => 'required|min_length[6]|max_length[25]'
				   ),
	               array(
	                     'field'   => 'passconf',
	                     'label'   => $this->lang->line('users_passconf'),
	                     'rules'   => 'required|matches[password]|min_length[6]|max_length[25]'
				   )
			);

	        $this->form_validation->set_rules($config);
			$css_style = $this->config->item('css_style_error', 'cms');
	        $this->form_validation->set_error_delimiters("<div class='$css_style'>", "</div>");
			if ($this->form_validation->run() == FALSE)
			{
				$t = array (
					'title'		=> $this->lang->line('users_change_password'),
					'link'		=> $link,
					'login'		=> $login,
				);
				$this->layout->blok('user/change_user_password.php', 'content', $t);
				$this->layout->make('theme');
			} else
			{
				if ($this->users_model->change_password(set_value('password'), $login))
				{
					$t = array (
						'errors' 	=> $this->lang->line('users_password_changed').'<br><br>',
						'title'		=> $this->lang->line('users_registration_finish')
					);
					$this->layout->blok('user/registration_error', 'content', $t);
					$this->layout->make('theme');
				} else
				{
					$t = array (
						'errors' 	=> $this->lang->line('users_password_add_error').'<br><br>',
						'title'		=> $this->lang->line('users_registration_finish')
					);
					$this->layout->blok('user/registration_error', 'content', $t);
					$this->layout->make('theme');
				}

			}
		} else
		{
			show_404();
		}
	}

	/** Funkcja sprawdzająca warunek recaptcha
	 * @access public
	 * @param string
	 * @return boolen
	 */
	public function recaptcha($str)
	{
	    $recaptcha = $str;
        if (!empty($recaptcha)) {
            $response = $this->recaptcha->verifyResponse($recaptcha);
            if (isset($response['success']) and $response['success'] === true) {
                return TRUE;
            } else {
				$this->form_validation->set_message('recaptcha', 'The reCAPTCHA field is telling me that you are a robot. Shall we give it another try?');
				return FALSE;
			}
		} else {
			return FALSE;
			$this->form_validation->set_message('recaptcha', 'The reCAPTCHA field is telling me that you are a robot. Shall we give it another try?');
		}
	}

	/** Funkcja logująca użytkowniak
	 * @access public
	 * @param string
	 * @return boolen
	 */
	public function login()
	{
		if ($this->users->logged()) // if user logged
		{
			// trzeba zniszczyc zmienna w sesji i ustawic start url !!!!!!!!!!!!!!!!!!
			$this->session->unset_userdata('referred_from');
			redirect('/user/index');
		}
		else {
			$config = array(
				array(
					'field'   => 'login',
					'label'   => $this->lang->line('users_login'),
					'rules'   => 'trim|required|min_length[5]|max_length[20]|alpha_numeric'
				),
				array(
					'field'   => 'password',
					'label'   => $this->lang->line('users_password'),
					'rules'   => 'required|min_length[8]|max_length[30]'
				),
				array(
					'field'	  => 'autologin',
					'label'	  => 'Autologin',
					'rules'	  => ''
				)
			);

			$this->form_validation->set_rules($config);
			$css_style = $this->config->item('css_style_error', 'cms');
			$this->form_validation->set_error_delimiters("<div class='$css_style'>", "</div>");
			if ($this->form_validation->run() == FALSE) {
				$t = array (
					'title' => $this->lang->line('users_login_in'),
				);

				$this->layout->blok('user/login_user', 'content', $t);
				$this->layout->make('theme');
			} else {
				if ($this->users_model->check(set_value('login'), set_value('password'))) {
					if ($this->users->is_registration(set_value('login'))) {
						$this->users->login(set_value('login'), set_value('autologin'));
						$this->load->helper('url');
						redirect($this->session->referred_from);
						//redirect(set_value('start_url'));
					} else {
						$t = new stdClass();
						$t->title = $this->lang->line('users_login_incorrect');
						$t->message = $this->lang->line('users_registration_not_finish');
						//$t->start_url = set_value('start_url');
						$this->layout->blok('user/login_user', 'content', $t);
						$this->layout->make('theme');
					}
				} else {
					$t = array (
						'title' 	=> $this->lang->line('users_login_incorrect'),
						'message' 	=> $this->lang->line('users_worse_login_or_password')
					);
					$this->layout->blok('user/login_user', 'content', $t);
					$this->layout->make('theme');
				}
			}
		}
	}

	/** Funkcja wylogowujaca
	*
	* @access	public
	* @param	none
	* @return	none
	*/
	public function logout()
	{
		$this->users->logout();
		redirect($this->session->referred_from);
	}

	/** Funkcja Callbacks - weryfikacja czy adres email istnieje
	*
	* @access	public
	* @param	none
	* @return	none
	*/
	public function email_exist($email)
	{
		if ($this->users_model->email_exist($email))
		{
			return TRUE;
		}
		else
		{
			$this->form_validation->set_message('email_exist', $this->lang->line('users_email_not_exist'));
			return FALSE;
		}
	}
}

/* End of file User.php */
/* Location: ./system/application/controllers/User.php */
