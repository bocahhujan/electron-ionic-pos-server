<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Controller{

  function __construct() {
      parent::__construct();
      $this->load->model('model_transaksi');
  }

  function index(){
    $dt['record'] = $this->model_transaksi->get_order();
    $this->template->load('template','order/list' , $dt);
  }

  function detail($id){
    $dt['recordbarang'] = $this->model_transaksi->list_barang_order($id);
    $dt['order'] = $this->model_transaksi->deteil_order($id)->row_array();
    //var_dump($dt);
    $this->template->load('template','order/detail' , $dt);
  }

  function proses($id){
    $this->model_transaksi->update_status_order($id);
    redirect('order');
  }

}
