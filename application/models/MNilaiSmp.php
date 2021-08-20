<?php

/**
 * Created by PhpStorm.
 * User: sankester
 * Date: 11/05/2017
 * Time: 15:53
 */
class MNilaiSmp extends CI_Model
{

    public $kdSekolah;
    public $kdKriteria;
    public $nilai;

    public function __construct()
    {
        parent::__construct();
    }

    private function getTable()
    {
        return 'nilaismp';
    }

    private function getData()
    {
        $data = array(
            'kdSekolah' => $this->kdSekolah,
            'kdKriteria' => $this->kdKriteria,
            'nilai' => $this->nilai
        );

        return $data;
    }

    public function insert()
    {
        $status = $this->db->insert($this->getTable(), $this->getData());
        return $status;
    }

    public function getNilaiBySekolah($id)
    {
        $query = $this->db->query(
            'select u.kdSekolah, u.sekolah, k.kdKriteria, n.nilai from datasmp u, nilaismp n, kriteria k, subkriteria sk where u.kdSekolah = n.kdSekolah AND k.kdKriteria = n.kdKriteria and k.kdKriteria = sk.kdKriteria and u.kdSekolah = ' . $id . ' GROUP by n.nilai '
        );
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $nilai[] = $row;
            }

            return $nilai;
        }
    }

    public function getNilaiSekolah()
    {
        $query = $this->db->query(
            'select a.kdSekolah, a.sekolah, i.kdKriteria, i.kriteria ,m.nilai from datasmp a, nilaismp m, kriteria i where a.kdSekolah = m.kdSekolah AND i.kdKriteria = m.kdKriteria '
        );

        //dump($query);
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $nilai[] = $row;
            }
            //dump($nilai);
            return $nilai;
        }
    }

    public function update()
    {
        $data = array('nilai' => $this->nilai);
        $this->db->where('kdSekolah', $this->kdSekolah);
        $this->db->where('kdKriteria', $this->kdKriteria);
        $this->db->update($this->getTable(), $data);
        return $this->db->affected_rows();
    }

    public function delete($id)
    {
        $this->db->where('kdSekolah', $id);
        return $this->db->delete($this->getTable());
    }

    public function getById()
    {

        $this->db->from($this->getTable());
        $this->db->where('kdSekolah', $this->kdSekolah);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $nilai[] = $row;
            }
            return $nilai;
        }
    }
}
