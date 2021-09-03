<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends MY_Controller
{


	public function index()
	{
		$this->page->setTitle('Dashboard');
		$this->load->view('menu/index');
		$this->load->view('dashboard/index');
	}
}
