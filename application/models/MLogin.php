<?php

class MLogin extends CI_Model
{
    public function cek_user($data) {
        $query = $this->db->get_where('admin', $data);
        return $query;
    }

    public function get($username)
    {
        $this->db->where('username', $username); // Untuk menambahkan Where Clause : username='$username'
        $result = $this->db->get('admin')->row(); // Untuk mengeksekusi dan mengambil data hasil query
        return $result;
    }
}
