<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Operator extends ci_controller{

   function __construct() {
        parent::__construct();
        $this->load->model('model_operator');
        chek_session();
    }

    function index()
    {
        $data['record']=  $this->model_operator->tampildata();
        //$this->load->view('operator/lihat_data',$data);
        $this->template->load('template','operator/lihat_data',$data);
    }

    function post()
    {
        if(isset($_POST['submit'])){
            // proses data
            $nama       =  $this->input->post('nama',true);
            $username   =  $this->input->post('username',true);
            $password   =  $this->input->post('password',true);
            $akses   =  $this->input->post('akses',true);

            $data       =  array(   'nama_lengkap'=>$nama,
                                    'username'=>$username,
                                    'akses' => $akses ,
                                    'password'=>md5($password));
            $this->db->insert('operator',$data);
            redirect('operator');
        }
        else{
            //$this->load->view('operator/form_input');
            $this->template->load('template','operator/form_input');
        }
    }

    function edit()
    {
        if(isset($_POST['submit'])){
            // proses kategori
            $id         =  $this->input->post('id',true);
            $nama       =  $this->input->post('nama',true);
            $username   =  $this->input->post('username',true);
            $password   =  $this->input->post('password',true);
            $akses   =  $this->input->post('akses',true);

            if(empty($password)){
                 $data  =  array(   'nama_lengkap'=>$nama,
                                    'akses' => $akses ,
                                    'username'=>$username);
            }
            else{
                  $data =  array(   'nama_lengkap'=>$nama,
                                    'username'=>$username,
                                    'akses' => $akses ,
                                    'password'=>md5($password));
            }
             $this->db->where('operator_id',$id);
             $this->db->update('operator',$data);
             redirect('operator');
        }
        else{
            $id=  $this->uri->segment(3);
            $data['record']=  $this->model_operator->get_one($id)->row_array();
            //$this->load->view('operator/form_edit',$data);
            $this->template->load('template','operator/form_edit',$data);
        }
    }


    function delete()
    {
        $id=  $this->uri->segment(3);
        $this->db->where('operator_id',$id);
        $this->db->delete('operator');
        redirect('operator');
    }
}
