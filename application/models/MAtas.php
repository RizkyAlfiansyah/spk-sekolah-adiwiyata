<?php

/**
 * Created by PhpStorm.
 * User: sankester
 * Date: 11/05/2017
 * Time: 15:51
 */

class MAtas extends CI_Model
{

    public $kdSekolah;
    public $sekolah;

    public function __construct()
    {
        parent::__construct();
    }

    private function getTable()
    {
        return 'datasma';
    }

    private function getData()
    {
        $data = array(
            'sekolah' => $this->sekolah,
            'alamat' => $this->alamat
        );

        return $data;
    }

    public function getAll()
    {
        $sekolah = array();
        $query = $this->db->get($this->getTable());
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $sekolah[] = $row;
            }
        }
        return $sekolah;
    }


    public function insert()
    {
        $this->db->insert($this->getTable(), $this->getData());
        return $this->db->insert_id();
    }

    public function update($where)
    {
        $status = $this->db->update($this->getTable(), $this->getData(), $where);
        return $status;
    }

    public function editData($where, $table)
    {
        $status = $this->db->get_where($table, $where);
        return $status;
    }


    public function delete($id)
    {
        $this->db->where('kdSekolah', $id);
        return $this->db->delete($this->getTable());
    }

    public function getLastID()
    {
        $this->db->select('kdSekolah');
        $this->db->order_by('kdSekolah', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get($this->getTable());
        return $query->row();
    }

    public function getById()
    {

        $this->db->from($this->getTable());
        $this->db->where('kdSekolah', $this->kdSekolah);
        $query = $this->db->get();

        return $query->row();
    }
}
