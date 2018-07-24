<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Controller{

  function __construct() {
      parent::__construct();
      $this->load->model('model_barang');
  }

  public function index(){
    $br = $this->model_barang->tampil_data()->result_array();
    foreach ($br as $brd) {
      if($brd['img'] == "" )
        $brd['img'] = base_url('assets/upload/food.jpg');
      else
        $brd['img'] = base_url('assets/upload/'.$brd['img']);


      $pd[] = $brd;
    }
    $dt['data'] = $pd;
    $this->load->view('api' , $dt );
  }

  function kategori(){
    $post = json_decode($this->input->raw_input_stream,TRUE);

    $br = $this->model_barang->get_barang_by_kategori($post['id'])->result_array();
    $pd = array();
    foreach ($br as $brd) {
      if($brd['img'] == "" )
        $brd['img'] = base_url('assets/upload/food.jpg');
      else
        $brd['img'] = base_url('assets/upload/'.$brd['img']);

      $pd[] = $brd;
    }

    $dt['data'] = $pd;
    $this->load->view('api' , $dt);
  }

  function search(){
    $post = json_decode($this->input->raw_input_stream,TRUE);
    $br = $this->model_barang->cariBarangApi($post['search'])->result_array();
    $pd = array();
    foreach ($br as $brd) {
      if($brd['img'] == "" )
        $brd['img'] = base_url('assets/upload/food.jpg');
      else
        $brd['img'] = base_url('assets/upload/'.$brd['img']);

      $pd[] = $brd;
    }

    $dt['data'] = $pd;
    $this->load->view('api' , $dt);
  }

}
