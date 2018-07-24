<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang extends CI_Controller{

    function __construct() {
        parent::__construct();
        $this->load->model('model_barang');
        chek_session();
    }


    function index()
    {
        $data['record'] = $this->model_barang->tampil_data();
        $this->template->load('template','barang/lihat_data',$data);
    }

    function post()
    {
        if(isset($_POST['submit'])){
            // proses barang
            $nama       =   $this->input->post('nama_barang');
            $kategori   =   $this->input->post('kategori');
            $harga      =   $this->input->post('harga');
            $hpp        =   $this->input->post('hpp');
            $stok       =   $this->input->post('stok');
            $des        =   $this->input->post('des_barang');
            $jenis      =   $this->input->post('jenis');
            $img        = "";


            if($_FILES['img_barang']['name'] !== "" ){

              $config['upload_path']          = 'assets/upload/';
              $config['allowed_types']        = 'gif|jpg|png|jpeg';
              $config['max_width']            = 900;
              $config['max_height']           = 900;
              $config['encrypt_name']         = true;
              $this->load->library('upload', $config);

              if ( $this->upload->do_upload('img_barang'))
                $img = $this->upload->data('file_name');

            }

            $data  = array('nama_barang'=>$nama,
                                'kategori_id'=>$kategori,
                                'harga'=>$harga ,
                                'hpp'=>$harga ,
                                'des' => $des ,
                                'img' => $img ,
                                'jenis' => $jenis
                              );

            $id = $this->model_barang->post($data);
            $this->model_barang->add_stok($id , $stok);

            redirect('barang');
        }
        else{
            $this->load->model('model_kategori');
            $data['kategori']=  $this->model_kategori->tampilkan_data()->result();
            //$this->load->view('barang/form_input',$data);
            $this->template->load('template','barang/form_input',$data);
        }
    }


    function edit()
    {
       if(isset($_POST['submit'])){
            // proses barang
            $id         =   $this->input->post('id');
            $nama       =   $this->input->post('nama_barang');
            $kategori   =   $this->input->post('kategori');
            $harga      =   $this->input->post('harga');
            $hpp        =   $this->input->post('hpp');
            $des        =   $this->input->post('des_barang');
            $jenis      =   $this->input->post('jenis');

            if($_FILES['img_barang']['name'] !== "" ){

              $config['upload_path']          = 'assets/upload/';
              $config['allowed_types']        = 'gif|jpg|png|jpeg';
              $config['max_width']            = 900;
              $config['max_height']           = 900;
              $config['encrypt_name']         = true;
              $this->load->library('upload', $config);

              if ( $this->upload->do_upload('img_barang')){
                $img = $this->upload->data('file_name');
                $data       = array('nama_barang'=>$nama,
                                    'kategori_id'=>$kategori,
                                    'hpp'=>$hpp,
                                    'harga'=>$harga ,
                                    'des'=> $des ,
                                    'img' => $img ,
                                    'jenis' => $jenis
                                  );

              }else{
                $data       = array('nama_barang'=>$nama,
                                    'kategori_id'=>$kategori,
                                    'hpp'=>$hpp,
                                    'harga'=>$harga ,
                                    'des'=> $des ,
                                    'jenis' => $jenis
                                  );

              }


            }else{

              $data       = array('nama_barang'=>$nama,
                                  'kategori_id'=>$kategori,
                                  'hpp'=>$hpp,
                                  'harga'=>$harga ,
                                  'des'=> $des ,
                                  'jenis' => $jenis
                                );
            }


            //var_dump($data);
            $this->model_barang->edit($data,$id);
            redirect('barang');
        }
        else{
            $id=  $this->uri->segment(3);
            $this->load->model('model_kategori');
            $data['kategori']   =  $this->model_kategori->tampilkan_data()->result();
            $data['record']     =  $this->model_barang->get_one($id)->row_array();
            //$this->load->view('barang/form_edit',$data);
            $this->template->load('template','barang/form_edit',$data);
        }
    }


    function delete()
    {
        $id = $this->uri->segment(3);
        $this->model_barang->delete($id);
        redirect('barang');
    }

    function stok(){
      if(isset($_POST['submit'])){
           // proses barang
           $id         =   $this->input->post('id');
           $stok      =   $this->input->post('stok');
           $this->model_barang->add_stok($id ,$stok);
           redirect('barang');
       }else{
           $id=  $this->uri->segment(3);
           $this->load->model('model_kategori');
           $data['record']     =  $this->model_barang->get_one($id)->row_array();
           $data['stok']     =  $this->model_barang->get_stok_barang($id)->row_array();
           //$this->load->view('barang/form_edit',$data);
           $this->template->load('template','barang/stok',$data);
       }
    }

    function laporanstok()
    {
        $data['record'] = $this->model_barang->get_list_stok_barang();
        $this->template->load('template','barang/laporan_stok_barang',$data);
    }
}
