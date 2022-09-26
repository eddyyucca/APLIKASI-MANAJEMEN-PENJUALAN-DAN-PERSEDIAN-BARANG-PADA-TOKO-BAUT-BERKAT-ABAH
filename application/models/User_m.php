<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_m extends CI_Model
{
    public function get_barang()
    {
        return $this->db->get('data_barang')->result();
    }
    function penomoran($limit, $start)
    {
        $query = $this->db->get('data_barang', $limit, $start);
        return $query;
    }

    public function cari($cari)
    {
        $this->db->like('nama_barang', $cari);
        $x = $this->db->get('data_barang');
        return $x->result();
    }
    public function get_user($username)
    {
        $this->db->where('username', $username);
        return $this->db->get('akun')->row();
    }
    public function getDataBarangById($id_barang)
    {
        $this->db->where('id_barang', $id_barang);
        $query = $this->db->get('data_barang');
        return $query->row();
    }

    public function insert($data)
    {
        $this->db->insert('data_order', $data);
    }

    public function insert_result($keranjang)
    {
        $this->db->insert('order_status', $keranjang);
    }

    public function status($id_usr)
    {
        $this->db->where('id_usr', $id_usr);
        $x = $this->db->get('order_status');
        return $x->result();
    }

    public function cek_pass($password, $username)
    {
        $this->db->where('username', $username);
        $this->db->where('password', $password);
        $this->db->limit(1);
        $query = $this->db->get('akun');

        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }
}
