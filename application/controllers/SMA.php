<?php

/**
 * Created by PhpStorm.
 * User: sankester
 * Date: 11/05/2017
 * Time: 15:42
 */

if (!defined('BASEPATH')) exit('No direct script access allowed');

class SMA extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->page->setTitle('Sekolah Menengah Atas (SMA)');
        $this->load->model('MKriteria');
        $this->load->model('MSubKriteria');
        $this->load->model('MAtas');
        $this->load->model('MNilaiSma');
        //$this->page->setLoadJs('assets/js/sekolah');
    }

    public function index()
    {
        if ($this->input->post('submit')) {
            $data['keyword'] = $this->input->post('keyword');
            $this->session->set_userdata('keyword', $data['keyword']);
            $this->session->set_flashdata('message', 'Hasil Pencarian');
        } else {
            $data['keyword'] = $this->session->userdata('keyword');
        }

        $this->db->like('sekolah', $data['keyword']);
        $this->db->from('datasma');

        $config['base_url'] = 'http://localhost/spksekolah/SMA/index';
        $config['total_rows'] = $this->db->count_all_results();
        $config['per_page'] = 5;
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';

        $data['total_rows'] = $config['total_rows'];

        $this->pagination->initialize($config);
        // dd($config['total_rows']);

        $data['start'] = $this->uri->segment(3);
        $data['sekolah'] = $this->MAtas->getAll($config['per_page'], $data['start'], $data['keyword']);
        $this->load->view('menu/index', $data);
        $this->load->view('sma/index', $data);
    }

    public function tambah($id = null)
    {

        if ($id == null) {
            if (count($_POST)) {
                $this->form_validation->set_rules('sekolah', '', 'trim|required');
                $this->form_validation->set_rules('alamat', '', 'trim|required');
                if ($this->form_validation->run() == false) {
                    $errors = $this->form_validation->error_array();
                    $this->session->set_flashdata('errors', $errors);
                    redirect(current_url());
                } else {

                    $sekolah = $this->input->post('sekolah');
                    $alamat = $this->input->post('alamat');
                    $nilai = $this->input->post('nilai');

                    $this->MAtas->sekolah = $sekolah;
                    $this->MAtas->alamat = $alamat;

                    if ($this->MAtas->insert() == true) {
                        $success = false;
                        $kdSekolah = $this->MAtas->getLastID()->kdSekolah;

                        foreach ($nilai as $item => $value) {
                            $this->MNilaiSma->kdSekolah = $kdSekolah;
                            $this->MNilaiSma->kdKriteria = $item;
                            $this->MNilaiSma->nilai = $value;
                            if ($this->MNilaiSma->insert()) {
                                $success = true;
                            }
                        }
                        if ($success == true) {
                            $this->session->set_flashdata('message', 'sukses');
                            redirect('SMA');
                        } else {
                            echo 'gagal';
                        }
                    }
                }
                //-----
            } else {
                $data['dataView'] = $this->getDataInsert();
                $this->load->view('menu/index', $data);
                $this->load->view('sma/tambah', $data);
            }
        } else {
            if (count($_POST)) {
                $kdSekolah = $this->uri->segment(3, 0);
                dump($kdSekolah);
                if ($kdSekolah > 0) {
                    $sekolah = $this->input->post('sekolah');
                    $alamat = $this->input->post('alamat');
                    $nilai = $this->input->post('nilai');
                    $where = array('kdSekolah' => $kdSekolah);

                    $this->MAtas->alamat = $alamat;
                    $this->MAtas->sekolah = $sekolah;
                    dump($sekolah);
                    if ($this->MAtas->update($where) == true) {
                        $success = false;
                        foreach ($nilai as $item => $value) {
                            $this->MNilaiSma->kdSekolah = $kdSekolah;
                            $this->MNilaiSma->kdKriteria = $item;
                            $this->MNilaiSma->nilai = $value;
                            if ($this->MNilaiSma->update()) {
                                $success = true;
                            }
                        }
                        if ($success == true) {
                            $this->session->set_flashdata('message', 'Sukses');
                            redirect('SMA');
                        } else {
                            echo 'Tidak Ada yang di Ubah';
                            redirect('SMA');
                        }
                    }
                }
            }
            $data['dataView'] = $this->getDataInsert();
            $data['nilaiSekolah'] = $this->MNilaiSma->getNilaiBySekolah($id);
            $where = array('kdSekolah' => $id);
            $data['alamat'] = $this->MAtas->editData($where, 'datasma')->result();
            $this->load->view('menu/index', $data);
            $this->load->view('sma/ubah', $data);
        }
    }

    private function getDataInsert()
    {
        $dataView = array();
        $kriteria = $this->MKriteria->getAll();
        foreach ($kriteria as $item) {
            $this->MSubKriteria->kdKriteria = $item->kdKriteria;
            $dataView[$item->kdKriteria] = array(
                'nama' => $item->kode,
                'data' => $this->MSubKriteria->getById()
            );
        }

        return $dataView;
    }

    public function delete($id)
    {
        if ($this->MNilaiSma->delete($id) == true) {
            if ($this->MAtas->delete($id) == true) {
                $this->session->set_flashdata('message', 'Berhasil menghapus data :)');
                redirect('SMA/index');
            }
        }
    }

    public function detail($kode)
    {
        $this->MAtas->kdSekolah = $kode;
        $data['sekolah'] = $this->MAtas->getById();
        $this->MNilaiSma->kdSekolah = $kode;
        $data['nilai'] = $this->MNilaiSma->getById();
        //dd($data['nilai']);

        echo json_encode($data);
    }
}
