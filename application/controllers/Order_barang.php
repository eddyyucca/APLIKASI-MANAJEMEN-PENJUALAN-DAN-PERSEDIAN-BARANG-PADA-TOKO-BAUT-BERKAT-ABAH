<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Order_barang extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('order_model');
        $this->load->model('super_model');
        $this->load->model('akun_model');
        // $this->load->model('jabatan_m');
        // $this->load->model('pegawai_m');
        // $this->load->model('bidang_m');
        // $this->load->model('pengajuan_m');


        // $level_akun = $this->session->userdata('level');
        // if ($level_akun != ("order_barang")) {
        //     redirect('auth');
        // } elseif ($level_akun == "admin_dep") {
        //     redirect('auth');
        // }
    }


    public function order_persetujuan()
    {
        $data['judul'] = 'Order Persetujuan';
        $data['alerts_3'] = $this->order_model->alerts_3();
        $data['level_akun'] = $this->session->userdata('level');
        $data['data'] = $this->order_model->alerts_3();
        $data['nama'] = $this->session->userdata('nama');
        $this->load->view('template/header', $data);
        $this->load->view('order_barang/order_masuk', $data);
        $this->load->view('template/footer');
    }
    public function order_selesai()
    {
        $data['judul'] = 'Order Selesai';
        $data['alerts_3'] = $this->order_model->alerts_3();
        $data['level_akun'] = $this->session->userdata('level');
        $data['data'] = $this->order_model->diterima();
        $data['nama'] = $this->session->userdata('nama');
        $this->load->view('template/header', $data);
        $this->load->view('order_barang/order_masuk', $data);
        $this->load->view('template/footer');
    }
    public function order_ditolak()
    {
        $data['judul'] = 'Order Ditolak';
        $data['alerts_3'] = $this->order_model->alerts_3();
        $data['level_akun'] = $this->session->userdata('level');
        $data['data'] = $this->order_model->ditolak();
        $data['nama'] = $this->session->userdata('nama');
        $this->load->view('template/header', $data);
        $this->load->view('order_barang/order_masuk', $data);
        $this->load->view('template/footer');
    }

    public function view($id)
    {
        $data['judul'] = 'Order Persetujuan';
        $data['alerts_3'] = $this->order_model->alerts_3();
        $data['level_akun'] = $this->session->userdata('level');
        $data['data'] = $this->order_model->alerts_3();
        $data['data2'] = $this->super_model->where($id);
        $data['data3'] = $this->super_model->ket($id);
        $data['data4'] = $this->super_model->status($id);
        $data['nama'] = $this->session->userdata('nama_user');

        $this->load->view('template/header', $data);
        $this->load->view('order_barang/view', $data);
        $this->load->view('template/footer');
    }
    public function view2($id)
    {
        $data['judul'] = 'Order Persetujuan';
        $data['alerts_3'] = $this->order_model->alerts_3();
        $data['level_akun'] = $this->session->userdata('level');
        $data['data'] = $this->order_model->alerts_3();
        $data['data2'] = $this->super_model->where($id);
        $data['data3'] = $this->super_model->ket($id);
        $data['data4'] = $this->super_model->status($id);
        $data['nama'] = $this->session->userdata('nama_user');

        $this->load->view('template/header', $data);
        $this->load->view('order_barang/view2', $data);
        $this->load->view('template/footer');
    }

    public function edit($id)
    {
        $data['judul'] = 'Order Persetujuan';
        $data['alerts_3'] = $this->order_model->alerts_3();
        $data['level_akun'] = $this->session->userdata('level');
        $data['data'] = $this->order_model->alerts_3();
        $data['data2'] = $this->super_model->where_edit($id);
        $data['nama'] = $this->session->userdata('nama_user');

        $this->load->view('template/header', $data);
        $this->load->view('order_barang/edit', $data);
        $this->load->view('template/footer');
    }

    public function ket($id)
    {
        $data['judul'] = 'Order Persetujuan';
        $data['alerts_3'] = $this->order_model->alerts_3();
        $data['level_akun'] = $this->session->userdata('level');
        $data['data'] = $this->order_model->alerts_3();
        $data['data2'] = $this->super_model->where_edit($id);
        $data['data3'] = $this->super_model->ket($id);

        $data['nama'] = $this->session->userdata('nama_user');

        $this->load->view('template/header', $data);
        $this->load->view('order_barang/ket', $data);
        $this->load->view('template/footer');
    }

    public function ket_input($id)
    {
        $data = array(
            'ket' => $this->input->post('ket')
        );
        $update = $this->super_model->update_status($id, $data);

        redirect('order_barang/view/' . $id);
    }

    public function prosesedit($id)
    {
        $redirect =  $this->input->post('redirect');
        $data = array(
            'qty_order' => $this->input->post('qty_order'),

        );

        $update = $this->super_model->updatebarang($id, $data);
        redirect('super_admin/view/' . $redirect);
    }

    public function hapus($id)
    {
        $data = $this->super_model->id_keranjang($id);
        $id_redirect = $data->id_keranjang;
        $hapus = $this->super_model->hapusdata($id);
        redirect('order_barang/view/' . $id_redirect);
    }

    public function diterima($id, $telpon)
    {
        $userkey = 'f70595dcb94f';
        $passkey = 'da5d1066b8f2e8343646fb16';
        $telepon = $telpon;
        $message = 'Orderan anda sudah di proses toko baut barakat abah, barang akan tiba di tempat anda';
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
        // $results = json_decode(curl_exec($curlHandle), true);
        curl_close($curlHandle);
        $x = $this->order_model->where($id);

        foreach ($x as $xx) {
            $id_k = $xx->id_barang;
            $nilai1 = $xx->jumlah_stok;
            $nilai2 = $xx->qty_order;

            $hasil = $nilai1 - $nilai2;
            $data = array(
                'jumlah_stok' => $hasil
            );
            $update = $this->order_model->update_qty($data, $id_k);
        }
        $data2 = array(
            'status' => 2,

        );

        $update2 = $this->super_model->update_status($id, $data2);
        redirect('order_barang/order_persetujuan');
    }

    public function ditolak($id, $telpon)
    {
        $userkey = 'f70595dcb94f';
        $passkey = 'da5d1066b8f2e8343646fb16';
        $telepon = $telpon;
        $message = 'Orderan anda ditolak karna terjadi kesalahan,silahkan hubungi admin toko baut barakat abah';
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
        $data2 = array(
            'status' => 4,
        );

        $update2 = $this->super_model->update_status($id, $data2);
        redirect('order_barang/order_persetujuan');
    }

    public function akun_admin()
    {
        $data['judul'] = "Tambah User";
        $data['alerts'] = $this->order_model->getDataJoin();
        $data['alerts_3'] = $this->order_model->alerts_3();
        $data['data_departemen'] = $this->akun_model->getDataDepartemen();
        $data['nama'] = $this->session->userdata('nama_user');
        $data['level_akun'] = $this->session->userdata('level');

        $this->load->view('template/header', $data);
        $this->load->view('order_barang/input_admin', $data);
        $this->load->view('template/footer');
    }
}
