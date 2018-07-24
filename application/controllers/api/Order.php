<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Controller{

  function __construct() {
      parent::__construct();
      $this->load->model('model_transaksi');
  }

  function add(){
    $post = json_decode($this->input->raw_input_stream,TRUE);
    if($post['ruang'] !== '' && $post['dt'] !== ''  ){
      $id = $this->model_transaksi->simpan_barang_api();
      $dt['data'] = array('status' => '200' , 'id' => $id );
    }else{
      $dt['data'] = array('status' => '400' , 'error' => 'Data Tidak lengkap !');
    }


    $this->load->view('api' , $dt);

  }

  function get_order_belum_bayar(){
    $dt['data'] = array('data' => $this->model_transaksi->meja_belombayar());
      $this->load->view('api' , $dt);
  }

  function detail(){
    $post = json_decode($this->input->raw_input_stream,TRUE);
    if($post['order_id'] !== '' ){
      $dt['data']['status'] = 200 ;
      $dt['data']['order'] = $this->model_transaksi->deteil_order($post['order_id'])->row_array();
      $dt['data']['detail'] = $this->model_transaksi->list_barang_order($post['order_id'])->result_array();

    }else{
      $dt['data'] = array('status' => '400' , 'error' => 'Data Tidak lengkap !');
    }
      $this->load->view('api' , $dt);
  }

  function update(){
    $post = json_decode($this->input->raw_input_stream,TRUE);
    if($post['id'] !== '' ){
      $dt = array(
            'status' => $post['status'],
            'uang_diterima' =>$post['bayar'] ,
            'tgl_update' => date('Y-m-d H:i:s')
      );
      $this->model_transaksi->update($post['id'] , $dt);
      $dt['data']['status'] = 200 ;
    }else{
      $dt['data'] = array('status' => '400' , 'error' => 'Data Tidak lengkap !');
    }
      $this->load->view('api' , $dt);
  }

  function update_detail(){
    $post = json_decode($this->input->raw_input_stream,TRUE);
    if($post['ruang'] !== '' && $post['dt'] !== ''  ){
      $this->model_transaksi->update_transaksi_api();
      $dt['data'] = array('status' => '200');
    }else{
      $dt['data'] = array('status' => '400' , 'error' => 'Data Tidak lengkap !');
    }


    $this->load->view('api' , $dt);
  }

  function transaksi_list(){
    $dt['data']['order'] = $this->model_transaksi->get_transsaksi_list();
    $this->load->view('api' , $dt);
  }

  function in_out(){
    $this->load->model('model_operator');
    $post = json_decode($this->input->raw_input_stream,TRUE);
    $this->model_transaksi->add_in_out($post);
    $user = $this->model_operator->get_one($post['id']);
    $user = $user->row_array();
    $user = $user['username'];
    $dt['data'] = array('status' => '200' , 'user' => $user);
    $this->load->view('api' , $dt);
  }

  function cek_transaksi(){
    $post = json_decode($this->input->raw_input_stream,TRUE);
    if($post['start'] !== '' && $post['end'] !== ''   ){
      $total = 0;
      $tran = array();
      $in = $this->model_transaksi->get_in_out($post['start'] , $post['end'] , 1 , $post['id']);
      foreach ($in as $tin) {
        if($tin['in_out_type'] == 1  ){
          $tran[] = array(
                  'tgl' => $tin['in_out_tgl'] ,
                  'meja' => 'Cash In' ,
                  'total' => $tin['in_out_nilai']
          );
          $total += $tin['in_out_nilai'];
        }else{
          $tran[] = array(
                  'tgl' => $tin['in_out_tgl'] ,
                  'meja' => 'Cash Out' ,
                  'total' => 0 - $tin['in_out_nilai']
          );
          $total -= $tin['in_out_nilai'];
        }

      }

      $tr = $this->model_transaksi->laporan_penjualan_perhari( $post['start'] , $post['end'] , $post['id'] );
      foreach ($tr as $k) {
        $tran[] = $k;
        $total += $k['total'] ;
      }

      $dt['data']['transaksi'] = $tran;
      $dt['data']['total'] = $total;
      $dt['data']['status']= 200 ;
    }else{
      $dt['data'] = array('status' => '400' , 'error' => 'Data Tidak lengkap !');
    }
    $this->load->view('api' , $dt);
  }

  function refund(){
    $post = json_decode($this->input->raw_input_stream,TRUE);
    if($post['barang_id'] !== '' && $post['order_id'] !== ''   ){
      $this->model_transaksi->refund_barang( $post['barang_id'] , $post['order_id'] , $post['qty'] );
      $dt['data']['status']= 200 ;
      $dt['data']['order'] = $this->model_transaksi->deteil_order($post['order_id'])->row_array();
      $dt['data']['detail'] = $this->model_transaksi->list_barang_order($post['order_id'])->result_array();
    }else{
      $dt['data'] = array('status' => '400' , 'error' => 'Data Tidak lengkap !');
    }
    $this->load->view('api' , $dt);
  }

  function refund_order(){
    $post = json_decode($this->input->raw_input_stream,TRUE);
    if( $post['order_id'] !== ''   ){
      $this->model_transaksi->refund_transaksi( $post['order_id'] );
      $dt['data']['status']= 200 ;
    }else{
      $dt['data'] = array('status' => '400' , 'error' => 'Data Tidak lengkap !');
    }
    $this->load->view('api' , $dt);
  }



}
