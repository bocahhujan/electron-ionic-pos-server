<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller{


    function index(){
        chek_session();
        $this->template->load('template','v_dashboard');
    }
}
