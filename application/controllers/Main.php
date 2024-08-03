<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Main extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->database();

		//models
		$this->load->model('Common_model');

		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');


		$this->data['active_left_menu'] = '';

		$this->data['csrf'] = array(
			'name' => $this->security->get_csrf_token_name(),
			'hash' => $this->security->get_csrf_hash()
		);

		//assuming we are using currency and country to make sure that website has default india as country and default rupee as currency
		$this->session->set_userdata('application_sess_currency_id', 1);
		$this->session->set_userdata('application_sess_country_id', __const_country_id__);

		// $app_sess_currency_id = $this->session->userdata('application_sess_currency_id');

	}


	public function getHeader($pageName, $data)
	{
		$this->data = $data;
		if (empty($this->data['js'])) {
			$this->data['js'] = array();
		}
		// $this->data['check_screen'] = $this->Common_model->checkScreen();
		$this->load->view("inc/$pageName", $this->data);
	}

	public function getFooter($pageName, $data)
	{
		$this->data = $data;
		$this->load->view("inc/$pageName", $this->data);
	}

	public function setCurrency($params = array())
	{
		if (empty($this->data['setCurency'])) {
			$this->data['setCurency'] = $this->Common_model->setCurency();
		}
		return $this->data['setCurency'];
	}


	public function getCurrencyPrice($params = array())
	{
		//return $params['obj']['setCurency']->currency_rate*$params['amount'];
		return round($params['amount']);
		//echo $params['obj']['setCurency']->currency_rate;
		//echo $params['amount'];
	}



}
