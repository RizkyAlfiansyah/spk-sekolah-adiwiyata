<?php

/**
 * Created by PhpStorm.
 * User: sankester
 * Date: 11/05/2017
 * Time: 15:43
 */

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Rangking extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('MKriteria');
        $this->load->model('MNilai');
        $this->load->model('MDasar');
        $this->load->model('MSAW');
    }

    public function index()
    {
        $this->page->setTitle('Rangking SD');
        $data = $this->tabelSaw();

        $this->load->view('menu/index', $data);
        $this->load->view('saw/dashboard', $data);
    }

    public function tabelSaw()
    {

        $sekolah = $this->MDasar->getAllData();
        //dd($sekolah);
        $data['kriteria'] = $this->MKriteria->getAll();

        if ($sekolah == null) {
            redirect('rangking/noData');
        }
        /**
         * Menghapus table SAW jika ada
         */
        $this->MSAW->dropTable();

        /**
         * $kriteria data dari table kriteria
         */
        $kriteria = $this->MKriteria->getAll();

        /**
         * membuat table SAW berdasarkan data dari table kriteria
         * menginputkan semua data nilai
         */
        $this->MSAW->createTable($kriteria);

        /**
         * Ambil data dari table SAW untuk perhitungan awal
         */
        $table1 = $this->initialTableSAW($sekolah);
        // $totalrows['total'] = $this->$table1->total_rows();
        //dd($table1);


        $this->page->setData('table1', $table1);


        /**
         * mengambil sifat kriteria
         * @var $dataSifat array
         */
        $dataSifat = $this->getDataSifat();
        $this->page->setData('dataSifat', $dataSifat);

        /**
         * Mengambil nilai maksimal dan minimal berdasarkan sifat
         */
        $dataValueMinMax = $this->getVlueMinMax($dataSifat);
        $this->page->setData('valueMinMax', $dataValueMinMax);

        /**
         * Proses 1 ubah data berdasarkan sifat
         */

        $table2 = $this->getCountBySifat($dataSifat, $dataValueMinMax);
        $this->page->setData('table2', $table2);

        /**
         * Hitung perkalian bobot dengan nilai kriteria
         */
        $bobot = $this->MKriteria->getBobotKriteria();
        $this->page->setData('bobot', $bobot);
        $table3 = $this->getCountByBobot($bobot);
        $this->page->setData('table3', $table3);

        /**
         * Add kolom total dan rangking
         */
        $this->MSAW->addColumnTotalRangking();

        /**
         * Menghitung nilai total
         */
        $this->countTotal();

        /**
         * Mengambil data yang sudah di rangking
         */
        $tableFinal = $this->getDataRangking();
        $this->page->setData('tableFinal', $tableFinal);
    }

    public function noData()
    {
        $this->load->view('menu/index');
        $this->load->view('saw/noData');
    }

    public function nilaiawal()
    {
        $this->page->setTitle('Nilai Awal Sekolah Dasar');

        $data = $this->tabelSaw();
        $this->load->view('menu/index', $data);
        $this->load->view('saw/nilaiawal', $data);
    }

    public function nilaiBobot()
    {
        $this->page->setTitle('Nilai Bobot');


        $data = $this->tabelSaw();
        $this->load->view('menu/index', $data);
        $this->load->view('saw/nilaibobot', $data);
    }

    public function weight()
    {
        $this->page->setTitle('Weight');
        $data = $this->tabelSaw();
        $this->load->view('menu/index', $data);
        $this->load->view('saw/weight', $data);
    }

    public function nilaiRangking()
    {
        $this->page->setTitle('Rangking SD');
        $data = $this->tabelSaw();
        $data['kriteria'] = $this->MKriteria->getAll();


        // dd($data['saw']);

        // // /**
        // //  * Menghapus table SAW
        // //  */
        $this->MSAW->dropTable();

        $this->load->view('menu/index', $data);
        $this->load->view('saw/rangking', $data);
    }

    private function tabelnilaiawal($limit, $start)
    {
        $sekolah = $this->MDasar->getAllData();
        $tabel = $this->initialTableSAW($sekolah);
        dd($tabel);
    }

    private function initialTableSAW($sekolah)
    {
        $nilai = $this->MNilai->getNilaiSekolah();

        //dd($nilai);

        $dataInput = array();
        $no = 0;
        foreach ($sekolah as $item => $itemsekolah) {
            foreach ($nilai as $index => $itemNilai) {
                if ($itemsekolah->kdSekolah == $itemNilai->kdSekolah) {
                    $dataInput[$no]['sekolah'] = $itemsekolah->sekolah;
                    $dataInput[$no][$itemNilai->kriteria] = $itemNilai->nilai;
                }
            }
            $no++;
        }


        foreach ($dataInput as $data => $item) {
            $this->MSAW->insert($item);
        }

        return $this->MSAW->getAlldata();
    }

    private function getDataSifat()
    {
        $sawData = $this->MSAW->getAlldata();
        $dataSifat = array();
        foreach ($sawData as $item => $value) {
            foreach ($value as $x => $z) {
                if ($x == 'Sekolah') {
                    continue;
                }
                $dataSifat[$x] = $this->MSAW->getStatus($x);
            }
        }
        return $dataSifat;
    }

    private function getVlueMinMax($dataSifat)
    {
        $sawData = $this->MSAW->getAlldata();
        $dataValueMinMax = array();
        foreach ($sawData as $point => $value) {
            foreach ($value as $x => $z) {
                if ($x == 'Sekolah') {
                    continue;
                }
                foreach ($dataSifat as $item => $itemX) {
                    if ($x == $item) {

                        if ($x == $item && $itemX->sifat == 'B') {
                            if (!isset($dataValueMinMax['max' . $x])) {
                                $dataValueMinMax['kriteria' . $x] = $x;
                                $dataValueMinMax['max' . $x] = $z;
                                $dataValueMinMax['sifat' . $x] = 'Benefit';
                            } elseif ($z > $dataValueMinMax['max' . $x]) {
                                $dataValueMinMax['max' . $x] = $z;
                            }
                        } else {
                            if (!isset($dataValueMinMax['min' . $x])) {
                                $dataValueMinMax['kriteria' . $x] = $x;
                                $dataValueMinMax['min' . $x] = $z;
                                $dataValueMinMax['sifat' . $x] = 'Cost';
                            } elseif ($z < $dataValueMinMax['min' . $x]) {
                                $dataValueMinMax['min' . $x] = $z;
                            }
                        }
                    }
                }
            }
        }

        return $dataValueMinMax;
    }

    private function getCountBySifat($dataSifat, $dataValueMinMax)
    {
        $sawData = $this->MSAW->getAlldata();
        foreach ($sawData as $point => $value) {
            foreach ($value as $x => $z) {
                if ($x == 'Sekolah') {
                    continue;
                }
                foreach ($dataSifat as $item => $sifat) {
                    if ($x == $item) {
                        if ($sifat->sifat == 'B') {

                            $newData = $z / $dataValueMinMax['max' . $x];
                            $dataUpdate = array(
                                $x => $newData
                            );
                            $where = array(

                                'Sekolah' => $value->Sekolah
                            );

                            $this->MSAW->update($dataUpdate, $where);
                        } else {
                            $newData = $dataValueMinMax['min' . $x] / $z;
                            $dataUpdate = array(
                                $x => $newData
                            );
                            $where = array(

                                'Sekolah' => $value->Sekolah
                            );

                            $this->MSAW->update($dataUpdate, $where);
                        }
                    }
                }
            }
        }

        return $this->MSAW->getAlldata();
    }

    private function countTotal()
    {
        $sawData = $this->MSAW->getAlldata();

        foreach ($sawData as $item => $value) {
            $total = 0;
            foreach ($value as $item => $itemData) {
                if ($item == 'Sekolah') {
                    continue;
                } elseif ($item == 'Total') {
                    $dataUpdate = array(
                        'Total' => $total
                    );

                    $where = array(
                        'Sekolah' => $value->Sekolah
                    );

                    $this->MSAW->update($dataUpdate, $where);
                } else {
                    $total = $total + $itemData;
                }
            }
        }
    }

    private function getCountByBobot($bobot)
    {

        $sawData = $this->MSAW->getAlldata();
        foreach ($sawData as $point => $value) {
            foreach ($value as $x => $z) {
                if ($x == 'Sekolah') {
                    continue;
                }
                foreach ($bobot as $item => $itemKriteria) {

                    if ($x == $itemKriteria->kriteria) {

                        $sawData[$point]->$x =  $z * $itemKriteria->bobot;
                        $newData = $z * $itemKriteria->bobot;
                        $dataUpdate = array(
                            $x => $newData
                        );
                        $where = array(
                            'Sekolah' => $value->Sekolah
                        );

                        $this->MSAW->update($dataUpdate, $where);
                    }
                }
            }
        }

        return $this->MSAW->getAlldata();
    }

    private function getDataRangking()
    {
        $config['base_url'] = 'http://localhost/spksekolah/Rangking/nilairangking';
        $config['total_rows'] = $this->MSAW->countAll();
        // dd($config['total_rows']);
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


        $this->pagination->initialize($config);
        // dd($config['total_rows']);

        $data['start'] = $this->uri->segment(3);
        // $data['sekolah'] = $this->MDasar->getAll($config['per_page'], $data['start']);

        $sawData = $this->MSAW->getSortTotalByDesc($config['per_page'], $data['start']);
        //dd($sawData);

        $no = 1;
        $start = $this->uri->segment(3) + $no;
        foreach ($sawData as $item => $value) {
            $dataUpdate = array(
                'Rangking' => $start
            );
            $where = array(
                'Sekolah' => $value->Sekolah
            );

            $this->MSAW->update($dataUpdate, $where);
            $start++;
        }

        $sortData = $this->MSAW->getSortTotalByDesc($config['per_page'], $data['start']);
        //dd($sortData);

        return $sortData;
    }
}
