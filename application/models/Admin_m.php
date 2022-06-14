<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_m extends CI_Model
{
    public function data_baut()
    {
        return $this->db->get('data_barang')->result();
    }
}

/* End of file alumni_m.php */
