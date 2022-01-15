<?php

/**
 * Created by PhpStorm.
 * User: sankester
 * Date: 11/05/2017
 * Time: 15:42
 */

if (!defined('BASEPATH')) exit('No direct script access allowed');

class SekolahDasar extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->page->setTitle('Sekolah Dasar (SD)');
        $this->load->model('MKriteria');
        $this->load->model('MSubKriteria');
        $this->load->model('MDasar');
        $this->load->model('MNilai');
        $this->page->setLoadJs('assets/js/sekolah');
    }

    public function index()
    {

        if ($this->input->post('generate')) {
            $data['keyword'] = $this->input->post('keyword');
            $this->session->set_userdata('keyword', $data['keyword']);
            $this->session->set_flashdata('message', 'Hasil Pencarian');
        } else {
            $data['keyword'] = $this->session->userdata('keyword');
        }

        $this->db->like('sekolah', $data['keyword']);
        $this->db->from('datasd');

        $config['base_url'] = 'http://localhost/spksekolah/SekolahDasar/index';
        $config['total_rows'] = $this->db->count_all_results();
        $config['per_page'] = 10;
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
        $data['sekolah'] = $this->MDasar->getAll($config['per_page'], $data['start'], $data['keyword']);
        //dd($data['sekolah']);
        $this->load->view('menu/index', $data);
        $this->load->view('sd/index', $data);
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

                    $this->MDasar->sekolah = $sekolah;
                    $this->MDasar->alamat = $alamat;
                    if ($this->MDasar->insert() == true) {
                        $success = false;
                        $kdSekolah = $this->MDasar->getLastID()->kdSekolah;
                        foreach ($nilai as $item => $value) {
                            $this->MNilai->kdSekolah = $kdSekolah;
                            $this->MNilai->kdKriteria = $item;
                            $this->MNilai->nilai = $value;
                            if ($this->MNilai->insert()) {
                                $success = true;
                            }
                        }
                        if ($success == true) {
                            $this->session->set_flashdata('message', 'sukses');
                            redirect('SekolahDasar');
                        } else {
                            echo 'gagal';
                        }
                    }
                }
                //-----
            } else {
                $data['dataView'] = $this->getDataInsert();
                $this->load->view('menu/index', $data);
                $this->load->view('sd/tambah', $data);
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

                    $this->MDasar->alamat = $alamat;
                    $this->MDasar->sekolah = $sekolah;
                    dump($sekolah);
                    if ($this->MDasar->update($where) == true) {
                        $success = false;
                        foreach ($nilai as $item => $value) {
                            $this->MNilai->kdSekolah = $kdSekolah;
                            $this->MNilai->kdKriteria = $item;
                            $this->MNilai->nilai = $value;
                            if ($this->MNilai->update()) {
                                $success = true;
                            }
                        }
                        if ($success == true) {
                            $this->session->set_flashdata('message', 'Sukses');
                            redirect('SekolahDasar');
                        } else {
                            echo 'Tidak Ada yang di Ubah';
                            redirect('SekolahDasar');
                        }
                    }
                }
            }
            $data['dataView'] = $this->getDataInsert();
            $data['nilaiSekolah'] = $this->MNilai->getNilaiBySekolah($id);
            $where = array('kdSekolah' => $id);
            $data['alamat'] = $this->MDasar->editData($where, 'datasd')->result();

            $this->load->view('menu/index', $data);
            $this->load->view('sd/ubah', $data);
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
        if ($this->MNilai->delete($id) == true) {
            if ($this->MDasar->delete($id) == true) {
                $this->session->set_flashdata('message', 'Berhasil menghapus data :)');
                redirect('SekolahDasar/index');
            }
        }
    }

    public function detail($kode)
    {
        $this->MDasar->kdSekolah = $kode;
        $data['sekolah'] = $this->MDasar->getById();
        $this->MNilai->kdSekolah = $kode;
        $data['nilai'] = $this->MNilai->getById();

        echo json_encode($data);
    }
}
