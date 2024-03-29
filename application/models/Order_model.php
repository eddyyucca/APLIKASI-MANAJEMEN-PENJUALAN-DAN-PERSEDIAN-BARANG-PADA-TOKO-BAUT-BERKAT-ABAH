<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Order_model extends CI_Model
{
    public function getDataJoin()
    {
        $this->db->select('*');
        $this->db->from('order_status');
        $this->db->join('bidang', 'bidang.id_bidang = order_status.id_bidang');
        $this->db->where('status', 2);
        $query = $this->db->get();

        return $query->result();
    }

    public function order_selesai($tanggal)
    {
        $this->db->select('*');
        $this->db->from('order_status');
        $this->db->join('bidang', 'bidang.id_bidang = order_status.id_bidang');
        $this->db->where('status', 1);
        $this->db->where('tanggal', $tanggal);

        $query = $this->db->get();

        return $query->result();
    }

    public function order_ditolak()
    {
        $this->db->select('*');
        $this->db->from('order_status');
        $this->db->join('bidang', 'bidang.id_bidang = order_status.id_bidang');
        $this->db->where('status', 4);

        $query = $this->db->get();

        return $query->result();
    }

    public function cari_order_selesai($cari)
    {
        $this->db->select('*');
        $this->db->from('order_status');
        $this->db->join('bidang', 'bidang.id_bidang = order_status.id_bidang');
        $this->db->where('status', 1);

        $this->db->like('tanggal', $cari);

        $query = $this->db->get();

        return $query->result();
    }


    public function getData()
    {
        $query = $this->db->get('order_status');
        return $query->result();
    }

    public function where($id)
    {
        $this->db->select('*');
        $this->db->from('data_order');
        $this->db->join('data_barang', 'data_barang.id_barang = data_order.id_barang');
        $this->db->where('id_keranjang', $id);
        return $this->db->get()->result();
    }

    public function delorder($id)
    {
        $this->db->where('id_keranjang', $id);
        $this->db->delete('data_order');
    }

    public function delkeranjang($id)
    {
        $this->db->where('id_usr', $id);
        $this->db->delete('order_status');
    }

    public function get()
    {
        $data = $this->db->get('data_barang');
        return $data->result();
    }

    public function update_qty($data, $id_k)
    {
        $this->db->where('id_barang', $id_k);
        $this->db->update('data_barang', $data);
    }

    public function update_status($data_status, $id)
    {
        $this->db->where('id_peg', $id);
        $this->db->update('order_status', $data_status);
    }

    public function dep($x)
    {
        $this->db->where('id', $x);
        $query = $this->db->get('bidang');
        return $query->row();
    }

    public function alerts_3()
    {
        $this->db->select('*');
        $this->db->from('order_status');
        $this->db->join('akun', 'akun.username = order_status.user');
        $this->db->where('status', 3);
        $query = $this->db->get();

        return $query->result();
    }
    public function ditolak()
    {
        $this->db->select('*');
        $this->db->from('order_status');
        $this->db->join('akun', 'akun.username = order_status.user');
        $this->db->where('status', 4);
        $query = $this->db->get();

        return $query->result();
    }
    public function diterima()
    {
        $this->db->select('*');
        $this->db->from('order_status');
        $this->db->join('akun', 'akun.username = order_status.user');
        $this->db->where('status', 2);
        $query = $this->db->get();

        return $query->result();
    }

    public function status($id)
    {
        $this->db->where('id_peg', $id);
        $x = $this->db->get('order_status');
        return $x->row();
    }

    public function cari_bulan($tahun, $bulan)
    {
        $this->db->select('*');
        $this->db->from('order_status as bulan');
        $this->db->join('bidang', 'bidang.id_bidang = bulan.id_bidang');
        $this->db->where('YEAR(bulan.tanggal)', $tahun);
        $this->db->where('MONTH(bulan.tanggal)', $bulan);
        $query = $this->db->get();
        return $query->result();
    }
    public function cari_bulan_ditolak($tahun, $bulan)
    {
        $this->db->select('*');
        $this->db->from('order_status as bulan');
        $this->db->join('bidang', 'bidang.id_bidang = bulan.id_bidang');
        $this->db->where('YEAR(bulan.tanggal)', $tahun);
        $this->db->where('MONTH(bulan.tanggal)', $bulan);
        $this->db->where('status', "4");
        $query = $this->db->get();
        return $query->result();
    }
}

/* End of file Order_model.php */
