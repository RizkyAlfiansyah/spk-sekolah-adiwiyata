<?php

/**
 * Created by PhpStorm.
 * User: sankester
 * Date: 11/05/2017
 * Time: 15:55
 */
class MSAW extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->dbforge();
    }

    private function getTable()
    {
        return 'saw';
    }
    public function createTable($field)
    {
        $fields = array(
            'Sekolah VARCHAR(120) not null'
        );


        foreach ($field as $item => $value) {
            $fields[] = $value->kriteria . ' DECIMAL(13,2) not null ';
        }

        $this->dbforge->add_field($fields);
        $this->dbforge->create_table('saw');
    }

    public function deleteTable()
    {
        $this->dbforge->drop_table('saw');
    }

    public function insert($data)
    {
        $status = $this->db->insert($this->getTable(), $data);
        return $status;
    }

    public function getAll()
    {
        $query = $this->db->get($this->getTable());
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $saw[] = $row;
            }
            return $saw;
        }
    }
    public function getAlldata()
    {
        $query = $this->db->get($this->getTable());
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $saw[] = $row;
            }
            return $saw;
        }
    }

    public function getStatus($key)
    {
        $this->db->select('sifat');
        $this->db->where('kriteria', $key);
        $query = $this->db->get('kriteria');
        return $query->row();
    }

    public function update($data, $where)
    {
        $this->db->update($this->getTable(), $data, $where);
    }

    public function addColumnTotalRangking()
    {
        $fields = array(
            'Total  DECIMAL(13,2)',
            'Rangking  INT(11)'
        );
        $this->dbforge->add_column($this->getTable(), $fields);
    }

    public function getSortTotalByDesc($limit, $start)
    {

        $this->db->order_by('Total', 'desc');
        $dataSaw = array();
        $query = $this->db->get($this->getTable(), $limit, $start);
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $dataSaw[] = $row;
            }
            return $dataSaw;
        }
        $this->db->order_by('Rangking', 'asc');
    }

    public function dropTable()
    {
        $this->dbforge->drop_table($this->getTable(), TRUE);
    }

    public function countAll()
    {
        return $this->db->get($this->getTable())->num_rows();
    }
}
