<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sekolah extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('MDasar');
        $this->load->model('MMenengah');
        $this->load->model('MAtas');
    }



    public function index()
    {
        $data['datasd'] = $this->MDasar->countAll();
        $data['datasmp'] = $this->MMenengah->countAll();
        $data['datasma'] = $this->MAtas->countAll();

        $this->page->setTitle('Daftar Sekolah');
        $this->load->view('menu/index', $data);
        $this->load->view('sekolah/sekolah', $data);
    }
    public function rangking()
    {
        $this->page->setTitle('Daftar Sekolah');
        $this->load->view('menu/index');
        $this->load->view('sekolah/rangking');
    }
    public function rangkingGuest()
    {
        $this->page->setTitle('Daftar Sekolah');
        $this->load->view('layout/head');
        $this->load->view('sekolah/rangking');
    }
}
