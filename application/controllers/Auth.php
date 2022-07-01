<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('auth_m');
    }

    public function index()
    {
        $data['data'] = false;
        $data['pesan'] = $this->session->flashdata('pesan');
        $data['judul'] = 'Login';
        $this->load->view('auth/template_auth/header', $data);
        $this->load->view('auth/index', $data);
        $this->load->view('auth/template_auth/footer', $data);
    }
    public function user_login()
    {
        $data['data'] = false;
        $data['pesan'] = $this->session->flashdata('pesan');
        $data['judul'] = 'Login User';
        $this->load->view('auth/template_auth/header', $data);
        $this->load->view('auth/user_login', $data);
        $this->load->view('auth/template_auth/footer', $data);
    }

    public function login()
    {
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        if ($this->form_validation->run() == FALSE) {
            $data['data'] = false;
            $data['judul'] = 'Login';
            $this->load->view('auth/template_auth/header', $data);
            $this->load->view('auth/index', $data);
            $this->load->view('auth/template_auth/footer');
        } else {
            $username = $this->input->post('username');
            $password =  md5($this->input->post('password'));
            $cek = $this->auth_m->login($username, $password);
            if ($cek == true) {
                foreach ($cek as $row);
                $this->session->set_userdata('nama', $row->username);
                $this->session->set_userdata('id_akun', $row->id_akun);
                $this->session->set_userdata('level', $row->level);
                if ($row->level == "admin") {
                    redirect('admin');
                } elseif ($row->level == "user") {
                    redirect('user');
                }
            } else {
                $data['data'] = '<div class="alert alert-danger" role="alert">Password Salah !
            </div>';
                $data['judul'] = 'Login';
                $this->load->view('auth/template_auth/header', $data);
                $this->load->view('auth/index', $data);
                $this->load->view('auth/template_auth/footer');
            }
        }
    }
    public function auth_user()
    {
        $this->form_validation->set_rules('nip', 'NIP Pegawai', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        if ($this->form_validation->run() == FALSE) {
            $data['data'] = false;

            $data['judul'] = 'Login';
            $this->load->view('auth/template/header', $data);
            $this->load->view('auth/user_login', $data);
            $this->load->view('auth/template/footer');
        }

        $nip = $this->input->post('nip');
        $password =  md5($this->input->post('password'));
        $cek = $this->auth_m->login($nip, $password);
        if ($cek == true) {
            foreach ($cek as $row);
            $this->session->set_userdata('nip', $row->nip);
            $this->session->set_userdata('nama_lengkap', $row->nama_lengkap);
            $this->session->set_userdata('id_pegawai', $row->id_pegawai);
            $this->session->set_userdata('bidang', $row->bidang);
            $this->session->set_userdata('level', $row->level);
            if ($row->level == "user") {
                redirect('user');
            } elseif ($row->level == "admin") {
                $this->session->set_Flashdata('pesan', "<div class='alert alert-danger' role='alert'>Password Salah !
        </div>");
                redirect("auth/user_login");
            }
        } else {
            $data['data'] = '<div class="alert alert-danger" role="alert">Password Salah !
            </div>';
            $data['judul'] = 'Login';
            $this->load->view('auth/template_auth/header', $data);
            $this->load->view('auth/user_login', $data);
            $this->load->view('auth/template_auth/footer');
        }
    }

    public function keluar()
    {
        $this->session->sess_destroy();
        redirect('auth');
    }

    public function daftar()
    {
        $data['judul'] = 'Daftar Penerima Vaksin';
        $this->load->view('auth/template_auth/header', $data);
        $this->load->view('auth/daftar', $data);
        $this->load->view('auth/template_auth/footer');
    }

    public function proses_daftar()
    {
        $this->form_validation->set_rules('no_ktp', 'Nomor KTP', 'required|is_unique[warga.nik]');
        $this->form_validation->set_rules('telpon', 'Nomor Telpon', 'required|is_unique[warga.telpon]');
        if ($this->form_validation->run() == FALSE) {

            $data['nama'] = $this->session->userdata('nama');
            // $data['jurusan'] = $this->jurusan_m->get_all_jurusan();

            $data['judul'] = 'Daftar Penerima Vaksin';
            $this->load->view('auth/template_auth/header', $data);
            $this->load->view('auth/daftar', $data);
            $this->load->view('auth/template_auth/footer');
        } else {


            $data = array(
                'nik' => $this->input->post('no_ktp'),
                'nama' => $this->input->post('nama_lengkap'),
                'jk' => $this->input->post('jk'),
                'tempat' => $this->input->post('tempat'),
                'ttl' => $this->input->post('ttl'),
                'alamat' => $this->input->post('alamat'),
                'telpon' => $this->input->post('telpon'),
                'status' => "0",
            );
            $akun = array(
                'nik' => $this->input->post('no_ktp'),
                'password' => md5($this->input->post('telpon')),
                'level' => "user",
                'status' => "aktif",
            );
            $this->db->insert('warga', $data);
            $this->db->insert('akun', $akun);
            return redirect('auth/daftar');
        }
    }

    public function daftar_akun()
    {
        $this->form_validation->set_rules('telpon', 'Telpon', 'required|is_unique[akun.telpon]');
        $this->form_validation->set_rules('email', 'Email', 'required|is_unique[akun.email]');
        $this->form_validation->set_rules('username', 'Username', 'required|is_unique[akun.username]');
        if ($this->form_validation->run() == FALSE) {
            $data['judul'] = 'Daftar';
            // $data['nama'] = $this->session->userdata('nama_alumni');


            $this->load->view('auth/template_auth/header', $data);
            $this->load->view('auth/daftar', $data);
            $this->load->view('auth/template_auth/footer');
        } else {

            $userkey = 'f70595dcb94f';
            $passkey = 'da5d1066b8f2e8343646fb16';
            $telepon = $this->input->post('telpon');
            $message = 'Akun anda sudah aktif,silahkan login ' . $this->input->post('nama');
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

            $data = array(
                'username' => $this->input->post('username'),
                'nama' => $this->input->post('nama'),
                'email' => $this->input->post('email'),
                'telpon' => $this->input->post('telpon'),
                'alamat' => $this->input->post('alamat'),
                'password' => md5($this->input->post('password')),
                'level' => 'user',
            );


            $this->db->insert('akun', $data);
            return redirect('auth/index');
        }
    }
}
