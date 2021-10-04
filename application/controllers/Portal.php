<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* User Class
* @package	pearsystem
* @subpackage	pearsystem
* @category	pearsystem
* @author	Author gruha - dabrowskiw@gmail.com
* @link	http://www.wojciechdabrowski.pl
*/


class Portal extends CI_Controller {

	function Portal() {
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->library('layout');
		$this->load->library('users');
		$this->load->model('portal_model');
		$this->load->library('Pagination');
		//$this->output->enable_profiler(TRUE);
	}

	function index($start=0) {
		$t->newses = $query = $this->portal_model->get_newses($start, 5);
		$ilosc = $this->portal_model->howmany('news');
		$config['base_url'] = 'portal/show_newses';
		$config['total_rows'] = $ilosc;
		$config['per_page'] = '5';

		$this->pagination->initialize($config);
		$t->pagination = $this->pagination->create_links();

		$t->title = 'Twoje oferty pracy';
		$this->layout->blok('news/view_newses', 'content', $t);
		$this->layout->make('theme');
	}

	function show_user($id) {
		$t->user = $query = $this->portal_model->get_user($id);
		$t->title = 'Profil Użytkownika';
		$this->layout->blok('user/portal_view_user', 'content', $t);
		$this->layout->make('szablon_news');
	}

	function show_newses($start=0) {
		$t->newses = $query = $this->portal_model->get_newses($start, 5);
		$ilosc = $this->portal_model->howmany('news');
		$config['base_url'] = 'portal/show_newses';
		$config['total_rows'] = $ilosc;
		$config['per_page'] = '5';
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

		$this->pagination->initialize($config);
		$t->pagination = $this->pagination->create_links();

		$t->title = 'Wiadomości';
		$this->layout->blok('news/view_newses', 'content', $t);
		$this->layout->make('theme');
	}

	function categoryNews($category, $start=0) {
		if ($t->newses = $query = $this->portal_model->get_newsesCategory($category ,$start, 5)) {
			$ilosc = $this->portal_model->howmany('news');
			$config['base_url'] = 'portal/show_newses';
			$config['total_rows'] = $ilosc;
			$config['per_page'] = '5';

			$this->pagination->initialize($config);
			$t->pagination = $this->pagination->create_links();

			$t->title = 'Wiadomości';
			$this->layout->blok('news/view_newses', 'content', $t);
			$this->layout->make('szablon_news');
		} else {
			$t->komunikat = 'Brak wiadomości z kategorii <b>'.$category.'</b>';
			$t->title = 'Wiadomości';
			$this->layout->blok('komunikat', 'content', $t);
			$this->layout->make('theme');
		}
	}

	function show_news($id_news) {
		$t->news = $this->portal_model->get_news($id_news);
		if ($this->portal_model->isset_comment($id_news)) {
			$t->comment = $this->portal_model->get_comment($id_news);
		} else {
			$t->comment = NULL;
		}
		$t->title = 'Wiadomości';
		$this->layout->blok('news/view_news', 'content', $t);
		$this->layout->make('theme');
	}

	function add_comment($id_news, $id_user=NULL) {
		if (!$this->users->logged())
		{
			$this->login_redirect(uri_string());
		}
		else
		{
			$config = array(
	               array(
	                     'field'   => 'content_comment',
	                     'label'   => $this->lang->line('comment'),
	                     'rules'   => 'trim|max_length[1000]|min_length[3]|required|strip_tags'
	                  )
	            );
	        $this->form_validation->set_rules($config);
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			if ($this->form_validation->run()) {

				$comment_date = date("Y-m-d H:i:s");
				$wpisy = array (
					'id_news'			=> $id_news,
					'id_user' 			=> $id_user,
					'date_add' 			=> $comment_date,
					'content_comment' 	=> set_value('content_comment'),
					'date_change' 		=> $comment_date,
				);

				if ($this->portal_model->add_comment($wpisy)) {
					$t->title = 'Wiadomości';
					$t->message = 'Dodano komentarz.';
					$t->news = $this->portal_model->get_news($id_news);
					if ($this->portal_model->isset_comment($id_news)) {
						$t->comment = $this->portal_model->get_comment($id_news);
					} else {
						$t->comment = NULL;
					}
					$this->layout->blok('news/view_news', 'content', $t);
					$this->layout->make('theme');
				} else {
					$t->errors = $this->validation->error_string;
					$t->title = 'Wiadomości';
					$t->message = 'Nie można dodać komentarza do bazy spróbuj ponownie.';
					$t->news = $this->portal_model->get_news($id_news);
					if ($this->portal_model->isset_comment($id_news)) {
						$t->comment = $this->portal_model->get_comment($id_news);
					} else {
						$t->comment = NULL;
					}
					$this->layout->blok('news/view_news', 'content', $t);
					$this->layout->make('theme');
				}

			} else {
				$t->errors = $this->validation->error_string;
				$t->news = $this->portal_model->get_news($id_news);
				if ($this->portal_model->isset_comment($id_news)) {
					$t->comment = $this->portal_model->get_comment($id_news);
				} else {
					$t->comment = NULL;
				}
				$t->title = 'Wiadomości';
				$this->layout->blok('news/view_news', 'content', $t);
				$this->layout->make('theme');
			}
		}
	}



	function send_message($id_company) {
		$this->load->helper('typography');
		$rules = array (
			'name'			=> 'trim|required|min_length[2]|max_length[300]',
			'email'			=> 'trim|max_length[150]|required|strip_tags|valid_email',
			'title'			=> 'trim|max_length[30]|min_length[3]|required',
			'message'		=> 'trim|max_length[1000]|min_length[3]|required',
			);
		$this->validation->set_rules($rules);

		$fields = array(
			'name'			=> 'Imię i Nazwisko',
			'email'			=> 'Adres email',
			'title'			=> 'Tytuł wiadomości',
			'message'		=> 'Wiadomości',
		);
		$this->validation->set_fields($fields);
		$this->validation->set_error_delimiters('<div class="error">', '</div>');

		if ($this->validation->run()) {

			//echo $this->validation->name.'<br><br>';
			//echo $this->validation->email.'<br><br>';
			//echo $this->validation->title.'<br><br>';
			$tresc = nl2br_except_pre($this->validation->message);
			//echo $message.'<br><br>';

			$message = '<img src="http://www.elegionowo.pl/images/logo.jpg"><br><br>';
			$message .= '<h4>Masz wiadomość</h4>';
			$message .= '<p>Witaj, dostałeś wiadomośc od użytkownika portalu www.elegionowo.pl</p>';
			$message .= '<p>Imię i nazwisko: <b>'.$this->validation->name.'</b><br>email: <b>'.$this->validation->email.'</b><br><br>';
			$message .= 'Temat: <b>'.$this->validation->title.'</b><br><br>'.$tresc;

			$headlines =  "Reply-to: ".$this->validation->email." <".$this->validation->email.">\r\n";
			$headlines .= "From: admin@elegionowo.pl <admin@elegionowo.pl>\r\n";
			$headlines .= "MIME-Version: 1.0\r\n";
			$headlines .= "Content-type: text/html; charset=utf-8\r\n";
			$content = '<html><head><title>Wiadomość</title></head><body>';
			$content .= $message;
			$content .= '</body></html>';

			$company = $this->portal_model->get_company($id_company);

			foreach($company as $row) {
				$email = $row->email;
			}

			if (mail($email, 'Uwaga masz wiadomość', $content, $headlines)) {
				// jeśli wiadomość się wyślę ładuje szablon firmy z komunikatem
				if ($this->company_model->premium_check($id_company) == 1) {
					$t->premium = $this->company_model->premium_check($id_company);
					$t->images = $this->company_model->get_images($id_company);
					$t->company = $this->portal_model->get_company($id_company);
					$t->id_company = $id_company;
					$t->errors = 'Wysłano wiadomość';
					$t->title = 'Profil firmy';
					$this->layout->blok('company/portal_show_company', 'content', $t);
					$this->layout->make('szablon_premium');
				} else {
					$t->premium = $this->company_model->premium_check($id_company);
					$t->company = $this->portal_model->get_company($id_company);
					$t->title = 'Profil firmy';
					$this->layout->blok('company/portal_show_company', 'content', $t);
					$this->layout->make('szablon_news');
				}
			} else {
				// jeśli się nie wyślę - ładuje szablon z błędem
				if ($this->company_model->premium_check($id_company) == 1) {
					$t->premium = $this->company_model->premium_check($id_company);
					$t->images = $this->company_model->get_images($id_company);
					$t->company = $this->portal_model->get_company($id_company);
					$t->id_company = $id_company;
					$t->errors = 'Bład serwerowy. Spróbuj jeszcze raz.';
					$t->title = 'Profil firmy';
					$this->layout->blok('company/portal_show_company', 'content', $t);
					$this->layout->make('szablon_premium');
				} else {
					$t->premium = $this->company_model->premium_check($id_company);
					$t->company = $this->portal_model->get_company($id_company);
					$t->title = 'Profil firmy';
					$this->layout->blok('company/portal_show_company', 'content', $t);
					$this->layout->make('szablon_news');
				}
			}

		} else {
			if ($this->company_model->premium_check($id_company) == 1) {
				$t->premium = $this->company_model->premium_check($id_company);
				$t->images = $this->company_model->get_images($id_company);
				$t->company = $this->portal_model->get_company($id_company);
				$t->id_company = $id_company;
				$t->errors = $this->validation->error_string;
				$t->title = 'Profil firmy';
				$this->layout->blok('company/portal_show_company', 'content', $t);
				$this->layout->make('szablon_premium');

			} else {
				$t->premium = $this->company_model->premium_check($id_company);
				$t->company = $this->portal_model->get_company($id_company);
				$t->title = 'Profil firmy';
				$this->layout->blok('company/portal_show_company', 'content', $t);
				$this->layout->make('szablon_news');
			}

		}
	}

}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */
?>
