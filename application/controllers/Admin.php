<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('pagination');
        $this->load->library('cart');
        $this->load->model('admin_m');
        $this->load->model('user_m');

        // $level_akun = $this->session->userdata('level');
        // if ($level_akun != "admin") {
        //     return redirect('auth');
        // }
    }

    public function index()
    {
        //page
        $config['base_url'] = site_url('user/index'); //site url
        $config['total_rows'] = $this->db->count_all('data_barang'); //total row
        $config['per_page'] = 3;  //show record per halaman
        $config["uri_segment"] = 3;  // uri parameter
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = floor($choice);

        // Membuat Style pagination untuk BootStrap v4
        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';

        $this->pagination->initialize($config);
        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $data['data'] = $this->user_m->penomoran($config["per_page"], $data['page']);

        $data['pagination'] = $this->pagination->create_links();


        //end


        $data['judul'] = 'Tabel Data ATK';
        $data['databarang'] = $this->user_m->get_barang();
        $data['keranjang'] = $this->cart->contents();
        $data['nama'] = $this->session->userdata('nama');

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
        $data['id'] = $id_barang;
        $this->load->view('template/header', $data);
        $this->load->view('admin/barang/rekap_barang_masuk_item', $data);
        $this->load->view('template/footer');
    }
    public function cetak_rekap_barang_masuk_item($id_barang)
    {
        $data['judul'] = 'Admin';
        $data['nama'] = $this->session->userdata('nama');

        $data['data'] = $this->admin_m->rekap_barang_masuk($id_barang);
        // $this->load->view('template/header', $data);
        $this->load->view('admin/barang/cetak_rekap_barang_masuk_item', $data);
        // $this->load->view('template/footer');
    }
    public function laporan_bm()
    {
        $data['judul'] = 'Admin';
        $data['nama'] = $this->session->userdata('nama');

        $data['data'] = $this->admin_m->laporan_bm();
        $this->load->view('template/header', $data);
        $this->load->view('admin/barang/laporan_bm', $data);
        $this->load->view('template/footer');
    }
    public function laporan_bm2()
    {
        $tgl1 = $this->input->post('tgl1');
        $tgl2 = $this->input->post('tgl2');

        $data['judul'] = 'Admin';
        $data['nama'] = $this->session->userdata('nama');

        $data['data'] = $this->admin_m->cari_tanggal($tgl1, $tgl2);
        $this->load->view('template/header', $data);
        $this->load->view('admin/barang/laporan_bm', $data);
        $this->load->view('template/footer');
    }
    public function cetak_laporan_bm()
    {
        $data['judul'] = 'Admin';
        $data['nama'] = $this->session->userdata('nama');

        $data['data'] = $this->admin_m->laporan_bm();
        // $this->load->view('template/header', $data);
        $this->load->view('admin/barang/cetak_laporan_bm', $data);
        // $this->load->view('template/footer');
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
    public function edit_barang($id_barang)
    {
        $data['judul'] = 'Admin';
        $data['nama'] = $this->session->userdata('nama');
        $data['data'] = $this->admin_m->get_row_barang($id_barang);

        $this->load->view('template/header', $data);
        $this->load->view('admin/barang/edit_barang', $data);
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
    public function proses_edit_barang($id_barang)
    {
        $data = array(
            'nama_barang' => $this->input->post('nama_barang'),
            'lokasi' => $this->input->post('lokasi'),
            'harga' => $this->input->post('harga'),


        );

        $this->db->where('id_barang', $id_barang);

        $update = $this->db->update('data_barang', $data);
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
            'waktu' => date('H:i:s a'),


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
