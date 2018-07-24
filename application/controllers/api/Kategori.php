<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class kategori extends CI_Controller{

  function __construct() {
      parent::__construct();
      $this->load->model('model_kategori');
  }

  function index(){
    $dt['data'] = $this->model_kategori->tampilkan_data()->result_array();
    $this->load->view('api' , $dt );
  }

}
