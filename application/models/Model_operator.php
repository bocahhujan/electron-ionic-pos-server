<?php
class Model_operator extends CI_Model{



    function login($username,$password)
    {
        $chek=  $this->db->get_where('operator',array('username'=>$username,'password'=>  md5($password)));
        if($chek->num_rows()>0){
            return 1;
        }
        else{
            return 0;
        }
    }


    function tampildata()
    {
        return $this->db->get('operator');
    }

    function get_one($id)
    {
        $param  =   array('operator_id'=>$id);
        return $this->db->get_where('operator',$param);
    }

    function loginApi($username,$password){
      $chek=  $this->db->get_where('operator',array('username'=>$username,'password'=>  md5($password)));
      if($chek->num_rows()>0){
          return $chek->row_array();
      }
      else{
          return false;
      }
    }
}
