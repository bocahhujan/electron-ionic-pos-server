<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller{

    function __construct() {
        parent::__construct();
        $this->load->model('model_operator');
    }

    function index(){
      $post = json_decode($this->input->raw_input_stream,TRUE);
      if($post['username'] !== '' && $post['password'] !== ''  ){


        if($hasil =  $this->model_operator->loginApi($post['username'],$post['password'] ))
        {
            // update last login
            $this->db->where('username',$hasil['username']);
            $this->db->update('operator',array('last_login'=>date('Y-m-d')));

            $dt['data'] = array('status' => '200' , 'user_id' => $hasil['operator_id'] , 'akses' => $hasil['akses']  );
        }
        else{
          $dt['data'] = array('status' => '404' ,  'error' => 'username / password salah ');
        }

      }else{
        $dt['data'] = array('status' => '400' , 'error' => 'Data Tidak lengkap !');
      }

      $this->load->view('api' , $dt);
    }
}
