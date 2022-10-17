<?php
use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
class tbl_service extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        //inisialisasi model Produk_model.php dengan nama produk
        $this->load->model('M_service', 'tbl_service');
    }
    public function index_get()
    {
       $id = $this->get('id');
        if ($id == '') {
            $tbl_service = $this->db->get('tbl_service')->result();
        } else {
            $this->db->where('id', $id);
            $tbl_service = $this->db->get('tbl_service')->result();
        }
        $this->response($tbl_service, REST_Controller::HTTP_OK);
    }


    function index_post()
    {
        $data = array(
            'nama'        => $this->post('nama'),
            'alamat'        => $this->post('alamat'),
            'jeniskndrn'               => $this->post('jeniskndrn'),
            'jumlah_tkns'              => $this->post('jumlah_tkns'),
            'biaya'              => $this->post('biaya'),
            'gambar'              => $this->post('gambar'),
        );
        $insert = $this->db->insert('tbl_service', $data);
        if ($insert) {
            $this->response($data, REST_Controller::HTTP_OK);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
}