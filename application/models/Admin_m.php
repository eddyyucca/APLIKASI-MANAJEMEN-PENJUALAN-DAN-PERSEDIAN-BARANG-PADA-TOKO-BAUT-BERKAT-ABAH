<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_m extends CI_Model
{
    public function data_baut()
    {
        return $this->db->get('data_barang')->result();
    }
    public function get_row_barang($id_barang)
    {
        $this->db->where('id_barang', $id_barang);
        $query = $this->db->get('data_barang');
        return $query->row();
    }

    public function rekap_barang_masuk($id_barang)
    {

        $this->db->join('data_barang', 'stok_masuk.id_barang = data_barang.id_barang');
        $this->db->from('stok_masuk');
        $query = $this->db->get();
        return $query->result();
    }
}

/* End of file alumni_m.php */
