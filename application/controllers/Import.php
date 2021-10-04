<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Import extends CI_Controller
{
	/*
	* Konstruktor z funkcjami do operacji na bazie produktów
	*
	* @package     Perfume Base
	* @category    Database
	* @author      Wojciech Dąbrowski <dabrowskiw@gmail.com>
	* @link        http://example.com
	*/
	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url', 'language'));
		$this->load->library(array('layout', 'form_validation', 'session', 'users'));
		$this->config->load('cms', TRUE);
		$this->load->model(array('import_model', 'database_model'));
		$this->lang->load(array('users', 'database'));

		//$this->output->enable_profiler(TRUE);
	}

	public function test2() {
		echo "cipa";
	}

	public function test() {
		$notes = $this->import_model->get_notes();
		echo '<table width="100%" border="1">';
		foreach ($notes as $value)
		{
			$wyrazy_base = explode(",", $value->base_note);
			$wyrazy_head = explode(",", $value->head_note);
			$wyrazy_heart = explode(",", $value->heart_note);
			
			echo "<tr>";
			echo "<td>".$value->id_product."</td>";
			echo "<td>".$value->base_note."</td><td>";
			//echo 'Ile wierszy ma tablica:'.count($wyrazy_base).'<br>ID:';
			foreach ($wyrazy_base as $wartosc) {
				if ($this->import_model->show_id_note($wartosc) !== FALSE) {
					echo $this->import_model->show_id_note($wartosc).", ";
					//$this->import_model->insert_note($value->id_product, $this->import_model->show_id_note($wartosc), '1');
				}
			}
			echo "</td>";
			echo "<td>".$value->head_note."</td><td>";
			//echo 'Ile wierszy ma tablica:'.count($wyrazy_base).'<br>ID:';
			foreach ($wyrazy_head as $wartosc) {
				if ($this->import_model->show_id_note($wartosc) !== FALSE) {
					echo $this->import_model->show_id_note($wartosc).", ";
					//$this->import_model->insert_note($value->id_product, $this->import_model->show_id_note($wartosc), '2');
				}
			}
			echo "</td>";
			echo "<td>".$value->heart_note."</td><td>";
			//echo 'Ile wierszy ma tablica:'.count($wyrazy_base).'<br>ID:';
			foreach ($wyrazy_heart as $wartosc) {
				if ($this->import_model->show_id_note($wartosc) !== FALSE) {
					echo $this->import_model->show_id_note($wartosc).", ";
					//$this->import_model->insert_note($value->id_product, $this->import_model->show_id_note($wartosc), '3');
				}
			}
			echo "</td>";
			echo "</tr>";
			
		}
		echo "</table>";
	}

	/*$obrazek="http://37.59.55.59/pm/images/34218951529016875.jpg";
		$context = stream_context_create(array(
			'http' => array(
				'method' => 'POST',
				'header' => 'Content-Type: application/json'
				//'content' => $encryptedEncodedData,
				),
			'ssl' => array(
				'verify_peer'      => false,
				'verify_peer_name' => false,
				),
			)
		);
		
		$nazwa = substr(strrchr($obrazek, "/"), 1); // lokalna nazwa obrazka
		$f = fopen($nazwa, "wb");
		fwrite($f, file_get_contents($obrazek, false, $context));
		fclose($f);
		echo "pobrany: $nazwa<br />";
		*/
		
	/*
	function images_import() {
		$context = stream_context_create(array(
			'http' => array(
				'method' => 'POST',
				'header' => 'Content-Type: application/json'
				//'content' => $encryptedEncodedData,
				),
			'ssl' => array(
				'verify_peer'      => false,
				'verify_peer_name' => false,
				),
			)
		);
		echo '<table>';
		foreach ($this->import_model->import_images() as $data) {
			echo '<tr>';
			echo '<td>'.$data->id_image.'</td>';
			echo '<td>'.$data->id_capacity.'</td>';
			$data2 = $this->database_model->get_product($data->id_product);
			//echo '<td>'.print_r($data2).'</td>';
			foreach ($data2 as $product) {
				$name_product = $data->id_capacity.' '.$product->name_brand.' '.$product->product_name;
			}
			$name_product = $this->friendly_name($name_product);
			echo '<td>'.$name_product.'</td>';
			$koncowka = substr(strrchr($data->url_img, "."), 1);

			$nazwa = 'img/temp/'.$name_product.'.'.$koncowka; // lokalna nazwa obrazka
			$sort_nazwa = $name_product.'.'.$koncowka;
			$f = fopen($nazwa, "wb");
			fwrite($f, file_get_contents($data->url_img, false, $context));
			fclose($f);
			$rozmiar = filesize($nazwa);
			if ($rozmiar > 13) {
				$nazwa2 = 'img/products/'.$name_product.'.'.$koncowka; // lokalna nazwa obrazka
				$f2 = fopen($nazwa2, "wb");
				fwrite($f2, file_get_contents($data->url_img, false, $context));
				fclose($f2);
				$this->import_model->put_image($data->id_product, $data->id_capacity, $sort_nazwa, $name_product);

			}
			echo '<td>'.$nazwa.'</td>';
			echo '<td>'.$rozmiar.'</td>';
			echo '</tr>';
		}
		echo '</table>';
	}
	*/

	function friendly_name($string){
		$string = str_replace(array('[\', \']'), '', $string);
		$string = preg_replace('/\[.*\]/U', '', $string);
		$string = preg_replace('/&(amp;)?#?[a-z0-9]+;/i', '-', $string);
		$string = htmlentities($string, ENT_COMPAT, 'utf-8');
		$string = preg_replace('/&([a-z])(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig|quot|rsquo);/i', '\\1', $string );
		$string = preg_replace(array('/[^a-z0-9]/i', '/[-]+/') , '-', $string);
		return strtolower(trim($string, '-'));
	}
}
