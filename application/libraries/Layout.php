<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 
/**
* User Class
* @package	Perfume Base
* @category	Layout
* @author	Wojciech Dąbrowski <dabrowskiw@gmail.com>
* @link	http://example.com
*/
class Layout {
	var $CI = FALSE;
	var $blok = array();
	
	function __construct() {
		$this->CI =& get_instance(); 
	}
	
	function make($template='szablon') {
		
		//odzytujemy katog z blokami
		$dir = opendir(APPPATH.'/block');
		while ($d = readdir($dir)) {
		// sprawdzamy czy plik posiada rozrzezenie php
			if (substr($d, -4) == '.php') {
				include(APPPATH.'/block/'.$d);
				// tworzymy instancje klasy ktora znajduje sie w tym bloku
				$classname = str_replace('.php', '', $d);
				$classname = ucfirst($classname);
				$klasa = new $classname();
				
				//odczytujemy do ktorej zmienej glownego widoku mamy wczytac jego zawartosc
				$nazwa = $klasa->blok();
				
				// tworzymy zmienna blow ktora nie istnieje aby zapobiedz errorom
				if (!isset($this->blok[$nazwa])) {
					$this->blok[$nazwa] = NULL;
				}
				// zapisujemy zawartosc bloku do zmiennej
				$this->blok[$nazwa].= $klasa->wyswietl();
			}
		}
		closedir($dir);
		
		$this->CI->load->view("$template", $this->blok);
	}
	
	function blok($widok, $nazwa="content", $zmienne = array()) {
		if (!isset($this->blok[$nazwa])) {
			$this->blok[$nazwa] = NULL;
		}
		$this->blok[$nazwa].= $this->CI->load->view($widok, $zmienne, TRUE);
	}
}

/* End of file myfile.php */
/* Location: ./system/modules/mymodule/myfile.php */