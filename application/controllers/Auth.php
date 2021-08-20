<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('MLogin');
        $this->page->setTitle('Selamat Datang di SPK Sekolah Adiwiyata');
    }
    public function index()
    {
        // Jika user sudah login (Session authenticated ditemukan)

        if ($this->session->userdata('authenticated')) {
            redirect('Welcome'); // Redirect ke page welcome
        } else {
            $this->session->set_flashdata('msg', 'Anda Telah Logout ! Silahkan Login Terlebih Dahulu'); // Buat session flashdata
            $this->load->view('login/login'); // Load view login.php
        }
    }

    public function login()
    {
        $username = $this->input->post('username'); // Ambil isi dari inputan username pada form login
        $password = md5($this->input->post('password')); // Ambil isi dari inputan password pada form login dan encrypt dengan md5
        $user = $this->MLogin->get($username); // Panggil fungsi get yang ada di UserModel.php
        if (empty($user)) { // Jika hasilnya kosong / user tidak ditemukan
            $this->session->set_flashdata('message', 'Username tidak ditemukan'); // Buat session flashdata
            redirect('Auth'); // Redirect ke halaman login
        } else {
            if ($password == $user->password) { // Jika password yang diinput sama dengan password yang didatabase
                $session = array(
                    'authenticated' => true, // Buat session authenticated dengan value true
                    'username' => $user->username,  // Buat session username
                    'nama' => $user->nama // Buat session authenticated
                );
                $this->session->set_userdata($session); // Buat session sesuai $session
                redirect('Welcome'); // Redirect ke halaman welcome
            } else {
                $this->session->set_flashdata('message', 'Password salah'); // Buat session flashdata
                redirect('Auth'); // Redirect ke halaman login
            }
        }
    }
    public function logout()
    {
        $this->session->sess_destroy(); // Hapus semua session
        redirect('Auth'); // Redirect ke halaman login
    }
}
