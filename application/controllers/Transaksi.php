<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends ci_controller{

    function __construct() {
        parent::__construct();
        $this->load->model(array('model_barang','model_transaksi'));
        chek_session();
    }

    function index()
    {
        if(isset($_POST['submit']))
        {
            $this->model_transaksi->simpan_barang();
            //redirect('transaksi');
        }

        $this->template->load('template','transaksi/form_transaksi');

    }

    function apicaribarang(){
      $dt['data'] = $this->model_barang->cari_barang();
      //var_dump($dt);
      $this->load->view('api', $dt);
    }

    function apiaddbarang(){
      $dt = $this->input->post('id');
      $qty = $this->input->post('qty');
      $qt = $this->model_barang->detail_barang($dt);
      $qt = $qt[0];

      $dat['data'] = array(
                    'barang_id' => $qt['barang_id'],
                    'nama_barang' => $qt['nama_barang'],
                    'harga' => $qt['harga'],
                    'qty' => $qty,
                    'sub_total' => $qt['harga'] * $qty
      );

      $this->load->view('api', $dat);
    }

    function hapusitem()
    {
        $id=  $this->uri->segment(3);
        $this->model_transaksi->hapusitem($id);
        redirect('transaksi');
    }


    function selesai_belanja()
    {
        $tanggal=date('Y-m-d');
        $user=  $this->session->userdata('username');
        $id_op=  $this->db->get_where('operator',array('username'=>$user))->row_array();
        $data=array('operator_id'=>$id_op['operator_id'],'tanggal_transaksi'=>$tanggal);
        $this->model_transaksi->selesai_belanja($data);
        redirect('transaksi');
    }


    function laporan()
    {
        if(isset($_POST['submit']))
        {
            $tanggal1=  $this->input->post('tanggal1');
            $tanggal2=  $this->input->post('tanggal2');
            $data['record']=  $this->model_transaksi->laporan_periode($tanggal1,$tanggal2);
            $this->template->load('template','transaksi/laporan',$data);
        }
        else
        {
            $data['record']=  $this->model_transaksi->laporan_default();
            $this->template->load('template','transaksi/laporan',$data);
        }
    }

    function perpordakkategori($url = ""){
        if($url == ""){

          $dt['data'] = $this->model_transaksi->laporan_transaksi_per_kategori();
          $this->template->load('template','transaksi/laporan_per_kategori',$dt);

        }elseif ($url == "excel") {

          header("Content-type=appalication/vnd.ms-excel");
          header("content-disposition:attachment;filename=laporan_transaksi_per_kategori.xls");
          $data['data']=  $this->model_transaksi->laporan_transaksi_per_kategori();
          $this->load->view('transaksi/laporan_excel_per_kategori',$data);

        }else {

          show_404();

        }
    }


    function excel()
    {
        header("Content-type=appalication/vnd.ms-excel");
        header("content-disposition:attachment;filename=laporantransaksi.xls");
        $data['record']=  $this->model_transaksi->laporan_default();
        $this->load->view('transaksi/laporan_excel',$data);
    }

    function penjualan_harian(){
      if(isset($_POST['submit'])){


        header("Content-type=appalication/vnd.ms-excel");
        header("content-disposition:attachment;filename=laporan_transaksi_per_kategori.xls");
        $data['in_out'] = $this->model_transaksi->get_in_out($_POST['start'] , $_POST['end']);
        $data['data'] =  $this->model_transaksi->laporan_penjualan_perhari( $_POST['start'] , $_POST['end'] );
        $data['start'] = $_POST['start'];
        $data['end'] = $_POST['end'];
        $this->load->view('transaksi/laporan_penjualan_perhari_exels',$data);
      }elseif(isset($_POST['print'])){
        $data['in_out'] = $this->model_transaksi->get_in_out($_POST['start'] , $_POST['end']);
        $data['data'] =  $this->model_transaksi->laporan_penjualan_perhari( $_POST['start'] , $_POST['end'] );
        $data['start'] = $_POST['start'];
        $data['end'] = $_POST['end'];
        $this->load->view('transaksi/laporan_penjualan_perhari_print',$data);
      }else {

        $this->template->load('template','transaksi/laporan_penjual_harian');

      }
    }

    function penjualan_harian_perkategori(){
      if(!isset($_POST['submit'])){

        $this->template->load('template','transaksi/laporan_penjualan_perhari_perkategori');

      }else {

        header("Content-type=appalication/vnd.ms-excel");
        header("content-disposition:attachment;filename=laporan_penjualan_perhari_perkategori.xls");
        $data['data'] =  $this->model_transaksi->laporan_penjualan_perhari_perkateogir( $_POST['start'] , $_POST['end'] );
        $data['start'] = $_POST['start'];
        $data['end'] = $_POST['end'];
        $this->load->view('transaksi/laporan_penjualan_perhari_perkategori_exels',$data);

      }
    }

    function penjualan_produk(){
      if(!isset($_POST['submit'])){

        $this->template->load('template','transaksi/penjualan_pordak');

      }else {

        header("Content-type=appalication/vnd.ms-excel");
        header("content-disposition:attachment;filename=laporan_penjualan_perprodak_perhari.xls");
        $data['data'] =  $this->model_transaksi->laporan_penjualan_perprodak_perhari( $_POST['start'] , $_POST['end'] );
        $data['start'] = $_POST['start'];
        $data['end'] = $_POST['end'];
        $this->load->view('transaksi/penjualan_pordak_exels',$data);

      }
    }

    function penjualan_detail_perhari(){
      if(!isset($_POST['submit'])){

        $this->template->load('template','transaksi/laporan_penjualan_detail_perhari');

      }else {

        header("Content-type=appalication/vnd.ms-excel");
        header("content-disposition:attachment;filename=laporan_penjualan_menu.xls");
        $data['data'] =  $this->model_transaksi->laporan_penjualan_detail_perhari( $_POST['start'] , $_POST['end'] );
        //var_dump($data);
        $data['start'] = $_POST['start'];
        $data['end'] = $_POST['end'];
        $this->load->view('transaksi/laporan_penjualan_detail_perhari_exels',$data);

      }
    }


}
