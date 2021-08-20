<?php

/**
 * Created by PhpStorm.
 * User: sankester
 * Date: 11/05/2017
 * Time: 15:53
 */
class MNilai extends CI_Model
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
        return 'nilai';
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
            'select u.kdSekolah, u.sekolah, k.kdKriteria, n.nilai from datasd u, nilai n, kriteria k, subkriteria sk where u.kdSekolah = n.kdSekolah AND k.kdKriteria = n.kdKriteria and k.kdKriteria = sk.kdKriteria and u.kdSekolah = ' . $id . ' GROUP by n.nilai '
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
            'select u.kdSekolah, u.sekolah, k.kdKriteria, k.kriteria ,n.nilai from datasd u, nilai n, kriteria k where u.kdSekolah = n.kdSekolah AND k.kdKriteria = n.kdKriteria '
        );

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $nilai[] = $row;
            }

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
