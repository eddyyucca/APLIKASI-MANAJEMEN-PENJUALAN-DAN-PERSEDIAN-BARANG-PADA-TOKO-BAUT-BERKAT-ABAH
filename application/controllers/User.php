<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
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
        // if ($level_akun != "user") {
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
        $this->load->view('template_user/header', $data);
        $this->load->view('user/index', $data);
        $this->load->view('template_user/footer', $data);
    }

    public function cari()
    {
        $cari = $this->input->post('cari');

        $data['judul'] = 'Order Baut';
        $data['databarang'] = $this->user_m->cari($cari);
        $data['keranjang'] = $this->cart->contents();
        $data['nama'] = $this->session->userdata('nama');
        $this->load->view('template_user/header', $data);
        $this->load->view('user/cari', $data);
        $this->load->view('template_user/footer');
    }

    public function data_pengguna()
    {
        $data['judul'] = 'User';
        $data['nama'] = $this->session->userdata('nama');

        $data['data'] = $this->admin_m->get_all_akun();
        $this->load->view('template_user/header', $data);
        $this->load->view('user/akun/data_akun', $data);
        $this->load->view('template_user/footer');
    }

    public function edit_akun($id_akun)
    {
        $data['judul'] = 'User';
        $data['nama'] = $this->session->userdata('nama');

        $data['data'] = $this->admin_m->get_row_akun($id_akun);
        $this->load->view('template_user/header', $data);
        $this->load->view('user/akun/edit_akun', $data);
        $this->load->view('template_user/footer');
    }
    public function proses_tambah_akun()
    {
        $data = array(
            'nama' => $this->input->post('nama'),
            'nama' => $this->input->post('nama'),
            'password' => md5($this->input->post('password')),
            'bidang' => $this->input->post('bidang'),
            'jabatan' => $this->input->post('jabatan'),
            'level' => "user",

        );

        $this->db->insert('akun', $data);
        return redirect('user/data_pengguna');
    }

    public function insert()
    {
        $userkey = 'f70595dcb94f';
        $passkey = 'da5d1066b8f2e8343646fb16';
        $telepon = '081250653005';
        $message = 'Ada order baru, silahkan cek dan lakukan proses order';
        $url = 'https://console.zenziva.net/wareguler/api/sendWA/';
        $curlHandle = curl_init();
        curl_setopt($curlHandle, CURLOPT_URL, $url);
        curl_setopt($curlHandle, CURLOPT_HEADER, 0);
        curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curlHandle, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($curlHandle, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curlHandle, CURLOPT_TIMEOUT, 30);
        curl_setopt($curlHandle, CURLOPT_POST, 1);
        curl_setopt($curlHandle, CURLOPT_POSTFIELDS, array(
            'userkey' => $userkey,
            'passkey' => $passkey,
            'to' => $telepon,
            'message' => $message
        ));
        $results = json_decode(curl_exec($curlHandle), true);
        curl_close($curlHandle);

        $x = $this->db->get('data_order')->result();
        $id_x = count($x) + 1;
        $cart = $this->cart->contents();
        foreach ($cart as $item) {
            $data = array(
                'id_order' => '',
                'id_keranjang' => $id_x,
                'id_barang' => $item['id'],
                'qty_order' => $item['qty'],
                'harga_barang' => $item['price'],
                'user_id' => $item['name'],
                'tanggal' => $item['tanggal']
            );
            $this->user_m->insert($data);
        }

        $keranjang = array(
            'id_usr' => $id_x,
            'user' => $item['name'],
            'status' => '3',
            'tanggal' => $item['tanggal']
        );
        $this->user_m->insert_result($keranjang);
        $this->cart->destroy();
        redirect('user/status');
    }


    public function proses_edit_akun($id_akun)
    {
        $data = array(
            'nama' => $this->input->post('nama'),
            'nama' => $this->input->post('nama'),
            'password' => md5($this->input->post('password')),
            'bidang' => $this->input->post('bidang'),
            'jabatan' => $this->input->post('jabatan'),

        );
        $this->db->where('id_akun', $id_akun);
        $this->db->update('akun', $data);
        return redirect('user/data_pengguna');
    }
    public function order($id_barang)
    {
        $data['judul'] = 'View Order';
        $data['data'] = $this->user_m->getDataBarangById($id_barang);
        $data['keranjang'] = $this->cart->contents();
        $data['nama'] = $this->session->userdata('nama');
        $this->load->view('template_user/header', $data);
        $this->load->view('user/view_order', $data);
        $this->load->view('template_user/footer');
    }

    public function ProsesOrder($id_barang)
    {
        $data_barang = array(
            'id' => $id_barang,
            'price' => $this->input->post('harga'),
            'item' => $this->input->post('nama_barang'),
            'name' => $this->session->userdata('nama'),
            'qty' => $this->input->post('jumlah_stok'),
            // 'bidang' => $this->session->userdata('bidang'),
            // 'satuan' =>  $this->input->post('satuan'),
            'tanggal' => date('Y-m-d')
        );
        $this->cart->insert($data_barang);

        var_dump($data_barang);
        redirect('user/keranjang');
    }
    public function hapus($rowid)
    {
        if ($rowid == "semua") {
            $this->cart->destroy();
        } else {
            $data = array(
                'rowid' => $rowid,
                'qty' => 0
            );
            $this->cart->update($data);
        }
        redirect('user/keranjang');
    }


    public function status()
    {
        $data['judul'] = 'Status Order';
        $data['nama'] = $this->session->userdata('nama');
        $id_usr = $this->session->userdata('id_akun');
        $data['data'] = $this->user_m->status($id_usr);
        $data['keranjang'] = $this->cart->contents();
        $this->load->view('template_user/header', $data);
        $this->load->view('user/status', $data);
        $this->load->view('template_user/footer');
    }

    public function keranjang()
    {
        $data['judul'] = 'View Order';

        $data['nama'] = $this->session->userdata('nama');
        $data['keranjang'] = $this->cart->contents();

        $this->load->view('template_user/header', $data);
        $this->load->view('user/keranjang', $data);
        $this->load->view('template_user/footer');
    }
}

/* End of file User.php */
