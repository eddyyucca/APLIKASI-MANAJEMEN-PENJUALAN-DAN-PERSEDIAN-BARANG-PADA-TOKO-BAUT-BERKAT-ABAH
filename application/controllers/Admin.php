<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        // $this->load->model('jabatan_m');
        // $this->load->model('lowongan_m');
        $this->load->model('admin_m');
        // $this->load->model('alumni_m');

        // $level_akun = $this->session->userdata('level');
        // if ($level_akun != "admin") {
        //     return redirect('auth');
        // }
    }

    public function index()
    {
        $data['nama'] = $this->session->userdata('nama');

        $data['judul'] = 'Dashboard';

        $this->load->view('template/header', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('template/footer', $data);
    }
    public function data_baut()
    {
        $data['judul'] = 'Admin';
        $data['nama'] = $this->session->userdata('nama');

        $data['data'] = $this->admin_m->data_baut();
        $this->load->view('template/header', $data);
        $this->load->view('admin/barang/data_barang', $data);
        $this->load->view('template/footer');
    }
    public function cetak_data_baut()
    {
        $data['judul'] = 'Data Baut';
        $data['nama'] = $this->session->userdata('nama');

        $data['data'] = $this->admin_m->data_baut();
        // $this->load->view('template/header', $data);
        $this->load->view('admin/barang/data_barang_cetak', $data);
        // $this->load->view('template/footer');
    }
    public function data_barang_masuk()
    {
        $data['judul'] = 'Admin';
        $data['nama'] = $this->session->userdata('nama');

        $data['data'] = $this->admin_m->data_baut();
        $this->load->view('template/header', $data);
        $this->load->view('admin/barang/barang_masuk', $data);
        $this->load->view('template/footer');
    }
    public function rekap_barang_masuk_item($id_barang)
    {
        $data['judul'] = 'Admin';
        $data['nama'] = $this->session->userdata('nama');

        $data['data'] = $this->admin_m->rekap_barang_masuk($id_barang);
        $this->load->view('template/header', $data);
        $this->load->view('admin/barang/rekap_barang_masuk_item', $data);
        $this->load->view('template/footer');
    }
    public function tambah_item()
    {
        $data['judul'] = 'Admin';
        $data['nama'] = $this->session->userdata('nama');


        $this->load->view('template/header', $data);
        $this->load->view('admin/barang/input_barang', $data);
        $this->load->view('template/footer');
    }
    public function tambah_stok_barang($id_barang)
    {
        $data['judul'] = 'Admin';
        $data['nama'] = $this->session->userdata('nama');
        $data['data'] = $this->admin_m->get_row_barang($id_barang);

        $this->load->view('template/header', $data);
        $this->load->view('admin/barang/tambah_stok_barang', $data);
        $this->load->view('template/footer');
    }
    public function edit_akun($id_akun)
    {
        $data['judul'] = 'Admin';
        $data['nama'] = $this->session->userdata('nama');

        $data['data'] = $this->admin_m->get_row_akun($id_akun);
        $this->load->view('template/header', $data);
        $this->load->view('admin/akun/edit_akun', $data);
        $this->load->view('template/footer');
    }
    public function proses_tambah_barang()
    {
        $data = array(
            'nama_barang' => $this->input->post('nama_barang'),
            'jumlah_stok' => $this->input->post('jumlah_stok'),
            'lokasi' => $this->input->post('lokasi'),
            'harga' => $this->input->post('harga'),


        );

        $this->db->insert('data_barang', $data);
        return redirect('admin/data_baut');
    }
    public function proses_update_stok_barang($id_barang)
    {
        $stok_awal = $this->input->post('stok_gudang');
        $stok_masuk = $this->input->post('stok_masuk');

        $hasil = $stok_awal + $stok_masuk;
        $data = array(
            'barang' => $id_barang,
            'stok_masuk' => $stok_masuk,
            'date' => $this->input->post('date'),


        );
        $data2 = array(
            'jumlah_stok' => $hasil
        );
        $this->db->where('id_barang', $id_barang);
        $update = $this->db->update('data_barang', $data2);

        $this->db->insert('stok_masuk', $data);
        return redirect('admin/data_baut');
    }
    public function hapus_barang($id_barang)
    {
        $this->db->where('id_barang', $id_barang);
        $this->db->delete('data_barang');
        $this->db->where('barang', $id_barang);
        $this->db->delete('stok_masuk');
        return redirect('admin/data_baut');
    }
}

/* End of file Admin.php */
